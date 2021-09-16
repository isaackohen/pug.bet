@extends(backpack_view('blank'))

@php
    $widgets['before_content'][] = [
        'type'        => 'jumbotron',
        'heading'     => 'Hi '.auth()->user()->name.',',
        'content'     => 'Make sure to create a <a href="/admin/backup">backup</a> before editing important settings.',
        'button_link' => backpack_url('logout'),
        'button_text' => trans('backpack::base.logout'),
    ];
@endphp


@section('content')
@endsection