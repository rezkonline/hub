<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\CommentCreatedEvent;
use App\Events\TaskStatusEvent;
use App\Events\TaskCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Filters\Api\TaskFilter;
use App\Http\Requests\Api\TaskRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\ActivityResource;
use App\Http\Requests\Api\CommentRequest;
use App\Http\Resources\AttachmentResource;
use App\Http\Resources\TaskResource as TaskResource;

class TaskController extends Controller
{
    /**
     * TaskController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    /**
     * Display a listing of the resource.
     *
     * @param TaskFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request, TaskFilter $filter)
    {
        if (! $request->user()->isCustomer()) {
            $tasks = Task::filter($filter)->orderBy('id', 'DESC')->paginate();
        } else {
            $tasks = $request->user()->tasks()->filter($filter)->orderBy('id', 'DESC')->paginate();
        }

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @return void
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create($request->allWithAuthId('customer_id'));

        if ($request->hasFile('attachments')) {
            $task->addOrUpdateMultipleMediaFromRequest('attachments', 'attachments');
        }

        event(new TaskCreatedEvent($task));

        return response()->json([
            'message' => trans('tasks.messages.created'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return TaskResource
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TaskRequest  $request
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->all());

        event(new TaskStatusEvent($task));

        return response()->json([
            'message' => trans('tasks.messages.updated'),
        ]);
    }

    /**
     * Get all comments.
     *
     * @param Task $task
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function comments(Task $task)
    {
        return CommentResource::collection($task->comments()->orderBy('id', 'DESC')->get());
    }

    /**
     * Get all attachments.
     *
     * @param Task $task
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function attachments(Task $task)
    {
        return AttachmentResource::collection($task->getMedia('attachments'));
    }

    /**
     * Get all logs.
     *
     * @param Task $task
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function logs(Task $task)
    {
        return ActivityResource::collection($task->activities()->orderBy('id', 'DESC')->get());
    }

    /**
     * Add comment to the specified resource in storage.
     *
     * @param CommentRequest $request
     * @param Task $task
     * @return TaskResource
     */
    public function comment(CommentRequest $request, Task $task)
    {
        if (app('impersonate')->getImpersonatorId()) {
            $user = User::find(app('impersonate')->getImpersonatorId());
        } else {
            $user = $request->user();
        }

        $task->commentAsUser($user, $request->input('body'));

        broadcast(new CommentCreatedEvent($task))->toOthers();

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'message' => trans('tasks.messages.deleted'),
        ]);
    }
}
