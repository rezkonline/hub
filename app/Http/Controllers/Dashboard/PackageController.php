<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Filters\PackageFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PackageRequest;

class PackageController extends Controller
{
    /**
     * PackageController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Package::class, 'package');
    }

    /**
     * Display a listing of the resource.
     *
     * @param PackageFilter $filter
     * @return \Illuminate\Http\Response
     */
    public function index(PackageFilter $filter)
    {
        $packages = Package::filter($filter)->paginate();

        return view('dashboard.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PackageRequest $request
     * @return void
     */
    public function store(PackageRequest $request)
    {
        $package = Package::create($request->all());

        flash(trans('packages.messages.created'));

        return redirect()->route('dashboard.packages.show', $package);
    }

    /**
     * Display the specified resource.
     *
     * @param Package $package
     * @return void
     */
    public function show(Package $package)
    {
        return view('dashboard.packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Package $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        return view('dashboard.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PackageRequest $request
     * @param Package $package
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request, Package $package)
    {
        $package->update($request->all());

        flash(trans('packages.messages.updated'));

        return redirect()->route('dashboard.packages.show', $package);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Package $package
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->delete();

        flash(trans('packages.messages.deleted'));

        return redirect()->route('dashboard.packages.index');
    }
}
