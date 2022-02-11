<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Country;
use App\Http\Filters\CountryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CountryRequest;

class CountryController extends Controller
{
    /**
     * CountryController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Country::class, 'country');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Filters\CountryFilter $filter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(CountryFilter $filter)
    {
        $countries = Country::filter($filter)->paginate();

        return view('dashboard.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('dashboard.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\CountryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CountryRequest $request)
    {
        $country = Country::create($request->all());

        flash(trans('countries.messages.created'));

        return redirect()->route('dashboard.countries.show', $country);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Country $country
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Country $country)
    {
        return view('dashboard.countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Country $country
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Country $country)
    {
        return view('dashboard.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\CountryRequest $request
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CountryRequest $request, Country $country)
    {
        $country->update($request->all());

        flash(trans('countries.messages.updated'));

        return redirect()->route('dashboard.countries.edit', $country);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Country $country
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Country $country)
    {
        $country->delete();

        flash(trans('countries.messages.deleted'));

        return redirect()->route('dashboard.countries.index');
    }
}
