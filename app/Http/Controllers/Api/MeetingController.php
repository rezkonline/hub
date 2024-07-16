<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MeetingResource;
use App\Models\Meeting;

class MeetingController extends Controller
{
    public function show()
    {
        $meeting = Meeting::whereHas(
            'customers',
            fn ($query) => $query->where('user_id', auth()->id())
        )->whereDate('created_at', '<=', now())->latest()->first();

        return (new MeetingResource($meeting))->additional([
            'token' => 'ddd'
        ]);
    }
}
