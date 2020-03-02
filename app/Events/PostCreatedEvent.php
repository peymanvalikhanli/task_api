<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $data;
    public $post ;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct (array $post)
    {
        //
        $this->data = array(
            'power'=> '10'
        );

        $this->post=$post; 

        // $this->activity=$a;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channel-demo');
        // return ['channel'];
    }

    // public function broadcastwith(){
    //     return[
    //         'name'=> $this->post['name ']
    //     ]; 
    // }
}
