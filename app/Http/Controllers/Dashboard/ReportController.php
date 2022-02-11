<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Filters\UserFilter;
use App\Models\City;
use App\Models\Country;
use function foo\func;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Filters\TransactionFilter;

class ReportController extends Controller
{
    /**
     * ReportController constructor.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __construct()
    {
        $this->middleware('can:show-reports');
    }

    /**
     * Display financial reports.
     *
     * @param TransactionFilter $filter
     * @return string
     */
    public function financial(TransactionFilter $filter)
    {
        $purchases = Transaction::filter($filter)->packages()->sum('amount') * -1;
        $payments  = Transaction::filter($filter)->whereNull('type')->sum('amount') * 1;

        return view('dashboard.reports.financial', compact('purchases', 'payments'));
    }

    /**
     * Display arrears reports.
     */
    public function arrears()
    {
        $users = Customer::whereHas('transactions', function ($query) {
            $query->havingRaw('SUM(amount) < 0')->groupBy('id');
        });

        $remaining = Transaction::whereHas('customer', function ($query) use ($users) {
            $query->whereIn('id', $users->pluck('id'));
        })->sum('amount') * -1;

        $users = $users->paginate();

        return view('dashboard.reports.arrears', compact('users', 'remaining'));
    }

    /**
     * Customer report
     */
    public function customers(UserFilter $filter)
    {
        $customers = Customer::filter($filter)->count();
        $countries = Country::listsTranslations('name')->pluck('name', 'id');
        $cities = [];

        if (! empty(request()->query('city', '')) || ! empty(request()->query('country', ''))) {
            $cities = City::where('country_id', request()->query('country'))->listsTranslations('name')->pluck('name', 'id');
        }

        return view('dashboard.reports.customers', compact('customers', 'countries', 'cities'));
    }

    /**
     * Transactions filter
     *
     * @param TransactionFilter $filter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function transactions(TransactionFilter $filter)
    {
        $transactions = Transaction::filter($filter)->orderByDesc('id')->paginate();

        return view('dashboard.reports.transactions', compact('transactions'));
    }
}
