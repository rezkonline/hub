<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\PackageResource;
use App\Http\Resources\MessageResource;
use App\Http\Resources\AchievementResource;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource as UserResource;

class UserController extends Controller
{
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Fetch logged in user data.
     *
     * @param Request $request
     * @return UserResource
     */
    public function index(Request $request)
    {
        return new UserResource($request->user());
    }

    /**
     * Update the data for logged in user.
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function update(UserRequest $request)
    {
        if ($request->input('email') != auth()->user()->email) {
            auth()->user()->update([
                'email_verified_at' => null,
            ]);
            auth()->user()->sendEmailVerificationNotification();
        }
        
        auth()->user()->update($request->except(['old_password', 'password', 'password_confirmation']));

        if ($request->has('avatar')) {
            auth()->user()->addOrUpdateMediaFromRequest('avatar', 'avatar');
        }

        if ($request->has('old_password') && Hash::make($request->input('old_password')) == auth()->user()->password) {
            auth()->user()->update([
                'password' => Hash::make($request->input('password')),
            ]);
        }

        return new UserResource(auth()->user());
    }

    /**
     * Fetch the manager of the logged in user.
     *
     * @param Request $request
     * @return UserResource
     */
    public function manager(Request $request)
    {
        return new UserResource($request->user()->manager);
    }

    /**
     * Fetch the messages for the logged in user.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function messages(Request $request)
    {
        return MessageResource::collection($request->user()->messages()->orderBy('seen_by_customer')->get());
    }

    /**
     * Fetch the achievements for the logged in user.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function achievements(Request $request)
    {
        return AchievementResource::collection($request->user()->achievements()->paginate());
    }

    /**
     * Fetch the transactions for the logged in user.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function transactions(Request $request)
    {
        return TransactionResource::collection($request->user()->transactions()->latest()->paginate());
    }

    /**
     * Fetch the packages for the logged in user.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function packages(Request $request)
    {
        return PackageResource::collection($request->user()->packages()->latest()->withPivot(['created_at'])->paginate());
    }

    /**
     * Update notification to mark it as read.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function markNotificationAsRead(Request $request)
    {
        $notification = $request->user()->notifications->find($request->input('id'));

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json([]);
    }

    /**
     * Update notification to mark it all as read.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function markNotificationsAsRead(Request $request)
    {
        $request->user()->notifications->each->markAsRead();

        return response()->json([]);
    }

    /**
     * Leave impersonating.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function leaveImpersonating(Request $request)
    {
        if (app('impersonate')->getImpersonatorId()) {
            auth()->user()->leaveImpersonation();
        }

        return response()->json([]);
    }
}
