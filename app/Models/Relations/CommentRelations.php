<?php

namespace App\Models\Relations;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CommentRelations
{
    /**
     * Get sender of the comment.
     *
     * @return BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * @return MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
