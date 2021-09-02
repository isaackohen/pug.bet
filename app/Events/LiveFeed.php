<?php namespace App\Events;

use App\Models\GameHistory;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
 
class LiveFeed implements ShouldBroadcastNow {

    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $game;
	private $delay;

    public function __construct(GameHistory $game, $delay) {
        $this->game = $game;
		$this->delay = $delay;
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
  
        return [
            'gameid' => $this->game->gameid,
			'name' => \App\Models\Slotslist::findGameName($this->game->gameid),
			'provider' => \App\Models\Slotslist::findProvider($this->game->gameid),
			'username' => \App\Models\User::findUsername($this->game->u),
			'bet' => $this->game->bet / 100,
			'win' => $this->game->win / 100,
			'delay' => $this->delay
        ];
    }

}
