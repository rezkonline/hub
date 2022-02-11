<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Schedule;
use App\Http\Controllers\Controller;
use App\Http\Filters\ScheduleFilter;

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
     * @return void
     */
    public function index(ScheduleFilter $filter)
    {
        if (auth()->user()->isAdmin()) {
            $schedules = Schedule::orderBy('id', 'DESC')->paginate();
        } else {
            $schedules = Schedule::filter($filter)->whereIn('customer_id', auth()->user()->customers->pluck('id'))->orderBy('id', 'DESC')->paginate();
        }

        return view('dashboard.schedules.index', compact('schedules'));
    }

    /**
     * Display the specified resource.
     *
     * @param Schedule $schedule
     * @return void
     */
    public function show(Schedule $schedule)
    {
        // Leave any impersonation
        auth()->user()->leaveImpersonation();

        // Impersonate this user
        auth()->user()->impersonate($schedule->customer);

        // Redirect to home page
        return redirect()->to('schedule-' . $schedule->id);
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

        flash(trans('schedules.messages.deleted'));

        return redirect()->route('dashboard.schedules.index');
    }
}
