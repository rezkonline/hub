<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Events\CommentCreatedEvent;
use App\Events\ScheduleStatusEvent;
use App\Events\ScheduleCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Resources\CommentResource;
use App\Http\Filters\Api\ScheduleFilter;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ScheduleResource;
use App\Http\Requests\Api\CommentRequest;
use App\Http\Requests\Api\ScheduleRequest;
use App\Http\Resources\AttachmentResource;

class ScheduleController extends Controller
{
    /**
     * ScheduleController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Schedule::class, 'schedule');
    }

    /**
     * Display a listing of the resource.
     *
     * @param ScheduleFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request, ScheduleFilter $filter)
    {
        return ScheduleResource::collection($request->user()->schedules()->filter($filter)->latest('id')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ScheduleRequest $request
     * @return void
     */
    public function store(ScheduleRequest $request)
    {
        $schedule = Schedule::create($request->allWithAuthId('customer_id'));

        if ($request->hasFile('attachments')) {
            $schedule->addOrUpdateMultipleMediaFromRequest('attachments', 'attachments');
        }

        event(new ScheduleCreatedEvent($schedule));

        return response()->json([
            'message' => trans('schedules.messages.created'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Schedule $schedule
     * @return ScheduleResource
     */
    public function show(Schedule $schedule)
    {
        return new ScheduleResource($schedule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ScheduleRequest  $request
     * @param  Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleRequest $request, Schedule $schedule)
    {
        $schedule->update($request->all());

        event(new ScheduleStatusEvent($schedule));

        return response()->json([
            'message' => trans('schedules.messages.updated'),
        ]);
    }

    /**
     * Get all comments.
     *
     * @param Schedule $schedule
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function comments(Schedule $schedule)
    {
        return CommentResource::collection($schedule->comments()->latest('id')->get());
    }

    /**
     * Get all logs.
     *
     * @param Schedule $schedule
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function logs(Schedule $schedule)
    {
        return ActivityResource::collection($schedule->activities()->latest('id')->get());
    }

    /**
     * Get all attachments.
     *
     * @param Schedule $schedule
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function attachments(Schedule $schedule)
    {
        return AttachmentResource::collection($schedule->getMedia('attachments'));
    }

    /**
     * Add comment to the specified resource in storage.
     *
     * @param CommentRequest $request
     * @param Schedule $schedule
     * @return ScheduleResource
     */
    public function comment(CommentRequest $request, Schedule $schedule)
    {
        if (app('impersonate')->getImpersonatorId()) {
            $user = User::find(app('impersonate')->getImpersonatorId());
        } else {
            $user = $request->user();
        }

        $schedule->commentAsUser($user, $request->input('body'));

        broadcast(new CommentCreatedEvent($schedule))->toOthers();

        return new ScheduleResource($schedule);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Schedule $schedule
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return response()->json([
            'message' => trans('schedules.messages.deleted'),
        ]);
    }
}
