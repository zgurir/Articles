<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class NewPostCreated extends Notification
{
    public $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        // seulement database
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'post_id' => $this->post->id,
        ];
    }
}
