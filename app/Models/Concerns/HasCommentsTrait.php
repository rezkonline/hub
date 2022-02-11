<?php

namespace App\Models\Concerns;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasCommentsTrait
{
    /**
     * Return all comments for this model.
     *
     * @return MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Attach a comment to this model.
     *
     * @param string $comment
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function comment(string $comment)
    {
        return $this->commentAsUser(auth()->user(), $comment);
    }

    /**
     * Attach a comment to this model as a specific user.
     *
     * @param User|null $user
     * @param string $comment
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function commentAsUser(?User $user, string $comment)
    {
        $comment = new Comment([
            'body' => $comment,
            'sender_id' => is_null($user) ? null : $user->id,
            'commentable_id' => $this->getKey(),
            'commentable_type' => get_class(),
        ]);

        return $this->comments()->save($comment);
    }
}
