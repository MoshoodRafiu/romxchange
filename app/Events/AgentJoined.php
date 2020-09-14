<?php

namespace App\Events;

use App\Message;
use App\Trade;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AgentJoined implements ShouldBroadcast
{
    public $trade;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Trade $trade)
    {
        $this->trade = $trade;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('trade.'.$this->trade->id);
    }

    public function broadcastWith(){
        return $data = ['message' => 'Agent joined chat'];
    }

    public function broadcastAs(){
        return "agent-joined";
    }
}
