<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Task;
use App\Http\Filters\TaskFilter;
use App\Http\Controllers\Controller;

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
     * @return void
     */
    public function index(TaskFilter $filter)
    {
        if (auth()->user()->isAdmin()) {
            $tasks = Task::orderBy('id', 'DESC')->paginate();
        } else {
            $tasks = Task::filter($filter)->whereIn('customer_id', auth()->user()->customers->pluck('id'))->orderBy('id', 'DESC')->paginate();
        }

        return view('dashboard.tasks.index', compact('tasks'));
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return void
     */
    public function show(Task $task)
    {
        // Leave any impersonation
        auth()->user()->leaveImpersonation();

        // Impersonate this user
        auth()->user()->impersonate($task->customer);

        // Redirect to home page
        return redirect()->to('task-' . $task->id);
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

        flash(trans('tasks.messages.deleted'));

        return redirect()->route('dashboard.tasks.index');
    }
}
