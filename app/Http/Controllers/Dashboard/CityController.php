<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\Country;
use App\Http\Filters\CityFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CityRequest;

class CityController extends Controller
{
    /**
     * CityController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(City::class, 'city');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Filters\CityFilter $filter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(CityFilter $filter)
    {
        return view('dashboard.cities.index', compact('cities', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('dashboard.cities.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\CityRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CityRequest $request)
    {
        $city = City::create($request->all());

        flash(trans('cities.messages.created'));

        return redirect()->route('dashboard.cities.show', $city);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\City $city
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(City $city)
    {
        return view('dashboard.cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\City $city
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(City $city)
    {
        return view('dashboard.cities.edit', compact('city', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\CityRequest $request
     * @param \App\Models\City $city
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CityRequest $request, City $city)
    {
        $city->update($request->all());

        flash(trans('cities.messages.updated'));

        return redirect()->route('dashboard.cities.edit', $city);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\City $city
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(City $city)
    {
        $city->delete();

        flash(trans('cities.messages.deleted'));

        return redirect()->route('dashboard.cities.index');
    }
}
