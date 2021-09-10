<div>

    <style>
           .progress-bar {
                height: 10px;
                background: url(/img/vipBars.svg);
        }
    .progress-modal {
        height: 10px;
        text-shadow: 1px 1px white;

 
    }

</style>
<div wire:poll>

            <div class="progress-modal mt-1" style="background: #0000005e; width: 60px;">
                <div class="progress-bar" role="progressbar" style="width: {{ auth()->user()->vipPercent()  }}%;"></div>
            </div>
</div>

</div>
 