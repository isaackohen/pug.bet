<div>

    <style>
           .progress-bar {
                height: 25px;
                background: url(/img/vipBar2345.svg);
        }
    .progress-modal {
        height: 25px;
        border-radius: 3px;
        text-shadow: 1px 1px black;
        margin: 2px;


 
    }

    .vipProgress {
        display: flex;
        flex-direction: row;
        margin-top: 10px;
        margin-bottom: 20px;

        div {
            display: inline-flex;
            position: relative;
            svg {
                width: 17px;
                height: 17px;
                position: absolute;
                margin-left: -20px;
                top: 50%;
                transform: translateY(-50%);
            }
        }

        div:last-child {
            margin-left: auto;
        }
    }
</style>
                                <div wire:poll>
    Current time: {{ now() }}
<div wire:poll>

            <div class="progress-modal" style="background: #2f3542;">
                <div class="progress-bar fill-current text-green-600" role="progressbar" style="width: {{ auth()->user()->vipPercent()  }}%;"></div>
            </div>

</div>

</div>
