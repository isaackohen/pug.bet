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

class PublicNotification implements ShouldBroadcastNow {

    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $message;
    private string $icon;
    private string $title;
    private string $sound;

    public function __construct(string $title, string $message, string $icon, string $sound) {
        $this->title = $title;
        $this->icon = $icon;
        $this->message = $message;
        $this->sound = $sound;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn() {
        return new Channel('Everyone');
    }

    public function broadcastWith() {
          return ['title'=> $this->title, 'message'=> $this->message, 'icon' => $this->icon, 'sound' => $this->sound];
    }

}
