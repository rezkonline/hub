<?php

namespace App\Models\Scopes;

use App\Models\Message;

trait MessageScopes
{
    /**
     * Get messages.
     *
     * @param $query
     * @return mixed
     */
    public function scopeReplies($query)
    {
        return $query->whereNull('type');
    }

    /**
     * Get notices.
     *
     * @param $query
     * @return mixed
     */
    public function scopeNotices($query)
    {
        return $query->where('type', Message::NOTICE);
    }
}
