<?php

namespace App\Events;

use \App\User;
use \App\Post;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;

    public $author;

        public function getPost():Post
        {
        return $this->post;
        }
        public function setPost(Post $post)
        {
        $this->post = $post;
        }

        public function getUser():User
        {
        return $this->user;
        }
        public function setUser(User $user)
        {
        $this->user = $user;
        }

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post , User $author)
    {
        $this->setPost($post);
         $this->setUser($author);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
