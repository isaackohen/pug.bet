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

class UserNotification implements ShouldBroadcastNow {

    use Dispatchable, InteractsWithSockets, SerializesModels;

    private User $user;
    private string $message;
    private string $icon;
    private string $title;


    public function __construct($user, string $title, string $message, string $icon) {
        $this->title = $title;
        $this->user = $user;
        $this->icon = $icon;
        $this->message = $message;
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
          return ['title'=> $this->title, 'message'=> $this->message, 'icon' => $this->icon];
    }

}
