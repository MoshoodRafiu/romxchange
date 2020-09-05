<?php

namespace App\Events;

use App\Message;
use App\Trade;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    public $trade;
    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Trade $trade, Message $message)
    {
        $this->trade = $trade;
        $this->message = $message;
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
        if ($this->message->user->is_admin == 1 || $this->message->user->is_agent == 1){
            $sender = "agent";
        }
        else{
            $sender = $this->message->user->display_name;
        }
        $data = [
            'id' => $this->message->user->id,
            'type' => $this->message->type,
            'sender' => $sender,
            'message' => $this->message->message,
            'time' => date('h:i A', strtotime($this->message->created_at)),
        ];
        return $data;
    }

    public function broadcastAs(){
        return "message-sent";
    }
}
