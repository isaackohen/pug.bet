<?php namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class BalanceModification implements ShouldBroadcastNow {

    use Dispatchable, InteractsWithSockets, SerializesModels;

    private User $user;
    private string $action;
    private float $value;
    private int $delay;

    public function __construct($user, string $currency, string $action, bool $demo, float $value, int $delay) {
        $this->user = $user;
        $this->currency = $currency;
        $this->action = $action;
        $this->value = $value;
        $this->delay = $delay;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn() {
        return new PrivateChannel('App.User.'.$this->user->id);
    }

    public function broadcastWith() {
        return [
            'diff' => [
                'action' => $this->action,
                'value' => $this->value
            ],
            'balance' => $this->user->balance(),
            'delay' => $this->delay
        ];
    }

}
