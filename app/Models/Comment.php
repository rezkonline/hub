<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasCommentsTrait;
use App\Models\Relations\CommentRelations;

class Comment extends Model
{
    use HasCommentsTrait,
        CommentRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_id',
        'body',
        'commentable_type',
        'commentable_id',
    ];
}
