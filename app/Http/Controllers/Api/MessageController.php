<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\MessageSentEvent;
use App\Http\Controllers\Controller;
use App\Http\Filters\Api\MessageFilter;
use App\Http\Resources\MessageResource;
use App\Http\Requests\Api\MessageRequest;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param MessageFilter $filter
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request, MessageFilter $filter)
    {
        $messages = Message::filter($filter)->where('customer_id', auth()->user()->id)->notices()->latest('id')->get();

        return MessageResource::collection($messages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MessageRequest $request)
    {
        $message = Message::create($request->allWithImpersonatorOrAuthId('sender_id'));

        broadcast(new MessageSentEvent($message))->toOthers();

        return response()->json([
            'message' => trans('messages.messages.created'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Message $message
     * @return
     */
    public function update(Request $request, Message $message)
    {
        $message->update([
            'seen_by_customer' => true,
        ]);

        return response()->json([]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param MessageFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function chat(Request $request, MessageFilter $filter)
    {
        return MessageResource::collection($request->user()->messages()->replies()->filter($filter)->latest('created_at')->paginate());
    }

    /**
     * Display last message of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function last(Request $request)
    {
        return new MessageResource($request->user()->messages()->replies()->latest('id')->first());
    }
}