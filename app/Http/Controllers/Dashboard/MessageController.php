<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Message;
use App\Events\MessageSentEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MessageRequest;
use App\Http\Resources\MessageResource;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $this->authorize('viewAny', [Message::class, $user]);

        if (request()->ajax()) {
            $messages = Message::where('customer_id', $user->id)->replies()->latest('created_at')->paginate();

            return MessageResource::collection($messages);
        }

        return view('dashboard.messages.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(User $user)
    {
        return view('dashboard.messages.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\CountryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MessageRequest $request, User $user)
    {
        $message = Message::create([
            'manager_id' => auth()->user()->id,
            'customer_id' => $user->id,
            'sender_id' => auth()->user()->id,
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'type' => $request->input('type'),
        ]);

        broadcast(new MessageSentEvent($message))->toOthers();

        if (request()->ajax()) {
            return response()->json([
                'data' => [
                    'id' => $message->id,
                ]
            ]);
        }

        if (Message::NOTICE === $request->input('type')) {
            return redirect()->route('dashboard.users.index');
        }

        flash(trans('messages.messages.created'));

        return redirect()->route('dashboard.users.messages.index', $user);
    }
}
