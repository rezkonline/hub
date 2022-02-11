<?php

namespace App\Events;

use App\Models\Task;
use App\Models\Campaign;
use App\Models\Schedule;
use Illuminate\Support\Str;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use App\Http\Resources\CommentResource;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CommentCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Store the comment instance.
     *
     * @var CommentResource
     */
    public $comment = null;

    /**
     * Create a new event instance.
     *
     * @param null $model
     */
    public function __construct($model = null)
    {
        $this->comment = new CommentResource($model->comments->last());
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $channel = Str::plural(strtolower(class_basename($this->comment->commentable_type)));
        $channel = $channel . '.' . $this->comment->commentable_id;

        return new PrivateChannel($channel);
    }
}
