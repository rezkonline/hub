<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\MeetingCreatedEvent;
use App\Models\Meeting;
use App\Http\Filters\MeetingFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MeetingRequest;

class MeetingController extends Controller
{
    /**
     * MeetingController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Meeting::class, 'meeting');
    }

    /**
     * Display a listing of the resource.
     *
     * @param MeetingFilter $filter
     * @return \Illuminate\Http\Response
     */
    public function index(MeetingFilter $filter)
    {
        $meetings = Meeting::filter($filter)->latest()->paginate();

        return view('dashboard.meetings.index', compact('meetings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.meetings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MeetingRequest $request
     * @return void
     */
    public function store(MeetingRequest $request)
    {
        $meeting = Meeting::create($request->validated());

        if ($request->has('customers')) {
            $meeting->customers()->attach($request->input('customers', []));
        }

        event(new MeetingCreatedEvent($meeting));

        flash(trans('meetings.messages.created'));

        return redirect()->route('dashboard.meetings.show', $meeting);
    }

    /**
     * Display the specified resource.
     *
     * @param Meeting $meeting
     * @return void
     */
    public function show(Meeting $meeting)
    {
        return view('dashboard.meetings.show', compact('meeting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Meeting $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        return view('dashboard.meetings.edit', compact('meeting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MeetingRequest $request
     * @param Meeting $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(MeetingRequest $request, Meeting $meeting)
    {
        $meeting->update($request->validated());

        if ($request->has('customers')) {
            $meeting->customers()->syncWithoutDetaching($request->input('customers', []));
        }

        flash(trans('meetings.messages.updated'));

        return redirect()->route('dashboard.meetings.show', $meeting);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Meeting $meeting
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();

        flash(trans('meetings.messages.deleted'));

        return redirect()->route('dashboard.meetings.index');
    }
}
