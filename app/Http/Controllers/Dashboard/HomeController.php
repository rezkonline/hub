<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Task;
use App\Models\Campaign;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Supervisor;
use App\Models\Transaction;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->isSupervisor() || auth()->user()->isEmployee()) {
            $customerIds = auth()->user()->customers()->pluck('users.id');

            $tasks = Task::whereIn('customer_id', $customerIds)->orderBy('id', 'DESC');
            $campaigns = Campaign::whereIn('customer_id', $customerIds)->orderBy('id', 'DESC');
            $schedules = Schedule::whereIn('customer_id', $customerIds)->orderBy('id', 'DESC');
        } else {
            $customers = Customer::count();
            $supervisors = Supervisor::count();
            $employees = Employee::count();
            $tasks = Task::orderBy('id', 'DESC');
            $campaigns = Campaign::orderBy('id', 'DESC');
            $schedules = Schedule::orderBy('id', 'DESC');

            $payed = Transaction::select(['amount'])->where('amount', '>', 0)->sum('amount') * 1;
            $remaining = Transaction::select(['amount'])->where('amount', '<', 0)->sum('amount') * -1;
        }

        return view('dashboard.home', get_defined_vars());
    }
}
