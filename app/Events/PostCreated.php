<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

class PostCreated implements ShouldBroadcast
{
    use Dispatchable;

    public $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function broadcastOn()
    {
        // canal public global
        return new Channel('new-posts');
    }

    public function broadcastAs()
    {
        return 'post.created'; // nom de l’event côté JS
    }
}
