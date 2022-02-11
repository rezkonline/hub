<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user() && auth()->user()->canAccessDashboard()) {
            return redirect(RouteServiceProvider::DASHBOARD);
        }
        return view('home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lang($localeCode)
    {
        session()->put('locale', $localeCode);

        return redirect()->route('welcome');
    }
}
