@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    trans('backpack::crud.admin') => backpack_url('dashboard'),
    $crud->entity_name_plural => url($crud->route),
    trans('backpack::crud.edit') => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
	<section class="container-fluid">
	  <h2>
        <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name !!}</span>
        <small>{!! $crud->getSubheading() ?? trans('backpack::crud.edit').' '.$crud->entity_name !!}.</small>

        @if ($crud->hasAccess('list'))
          <small><a href="{{ url($crud->route) }}" class="d-print-none font-sm"><i class="la la-angle-double-{{ config('backpack.base.html_direction') == 'rtl' ? 'right' : 'left' }}"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a></small>
        @endif
	  </h2>
	</section>
@endsection

@section('content')
<div class="row">
	<div class="{{ $crud->getEditContentClass() }}">
		<!-- Default box -->

		@include('crud::inc.grouped_errors')

		  <form method="post"
		  		action="{{ url($crud->route.'/'.$entry->getKey()) }}"
				@if ($crud->hasUploadFields('update', $entry->getKey()))
				enctype="multipart/form-data"
				@endif
		  		>
		  {!! csrf_field() !!}
		  {!! method_field('PUT') !!}

		  	@if ($crud->model->translationEnabled())
		    <div class="mb-2 text-right">
		    	<!-- Single button -->
				<div class="btn-group">
				  <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    {{trans('backpack::crud.language')}}: {{ $crud->model->getAvailableLocales()[request()->input('locale')?request()->input('locale'):App::getLocale()] }} &nbsp; <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
				  	@foreach ($crud->model->getAvailableLocales() as $key => $locale)
					  	<a class="dropdown-item" href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}?locale={{ $key }}">{{ $locale }}</a>
				  	@endforeach
				  </ul>
				</div>
		    </div>
		    @endif
		      <!-- load the view from the application if it exists, otherwise load the one in the package -->
		      @if(view()->exists('vendor.backpack.crud.form_content'))
		      	@include('vendor.backpack.crud.form_content', ['fields' => $crud->fields(), 'action' => 'edit'])
		      @else
		      	@include('crud::form_content', ['fields' => $crud->fields(), 'action' => 'edit'])
		      @endif

            @include('crud::inc.form_save_buttons')
		  </form>
 @if($crud->route === 'admin/users')
<hr>
<br>
	  <h2><span class="text-capitalize">Player's Statistics</span>
        <small>Download Player complete <a href="#">transactional log</a> in Excel format.</small></h2>
 <div class="row">
	<div class="{{ $crud->getEditContentClass() }}">

        <div class="tab-content p-0 ">

                <!-- load the view from type and view_namespace attribute if set -->
    
    <!-- text input -->
		@php
			$getUserStats = \App\Models\UserStatistics::where('u', '=', $crud->entry->_id)->first();
			$getBonusHistory = \App\Models\BonusHistory::where('u', '=', $crud->entry->_id)->first();
		@endphp


		@if($getUserStats)
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">Tot. Wager ($)</th>
		   		<th scope="col">Tot. Win ($)</th>
		      <th scope="col">Tot. Games</th>
		      <th scope="col">Tot. VIP Wager ($)</th>
		      <th scope="col">Current VIP Wager</th>
		      <th scope="col">Latest Game</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <td>{{ $getUserStats->usd_wager ?? null}}$</th>
		      <td>{{ $getUserStats->usd_win ?? '-'}}$</td>
		      <td>{{ $getUserStats->usd_games ?? '-'}}</td>
		      <td>{{ $getUserStats->vip_wager_tot ?? '-' }}$</td>
		      <td>{{ $getUserStats->vip_wager ?? '-' }}$</td>
		      <td>{{ $getUserStats->updated_at ?? '-' }}</td>
		    </tr>
		 
		  </tbody>
		</table>
		@endif
		@if($getBonusHistory)
			<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">Rake Balance</th>
		      <th scope="col">Rake Cashed</th>
		      <th scope="col">Faucet Cashed</th>
		      <th scope="col">Promo Cashed</th>
		      <th scope="col">Promo Free Spins</th>
		      <th scope="col">Promo Today Used</th>
			 </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <td>{{(round($crud->entry->rake / 100, 2)).'$' ??  '-'}}</td>
		      <td>{{ $getBonusHistory->rakeback_total.'$' ?? '-'}}</th>
		      <td>{{ $getBonusHistory->faucet_total.'$' ?? '-'}}</td>
		      <td>{{ $getBonusHistory->promocode_total.'$' ?? '-' }}</td>
		      <td>{{ $getBonusHistory->promocode_freespins.'FS' ?? '-' }}</td>
		      <td>{{ $getBonusHistory->promocode_usedtoday.'$' ?? '-' }}</td>
		    </tr>
		   </tbody>
		</table>
				@endif

		</div>
		</div>


		@endif

	</div>
</div>
@endsection

