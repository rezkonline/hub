<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Country;
use App\Models\Package;
use App\Models\Employee;
use App\Models\Supervisor;
use App\Http\Filters\SelectFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\SelectResource;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param   \App\Http\Filters\SelectFilter  $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function countries(SelectFilter $filter)
    {
        $countries = Country::filter($filter)->paginate();

        return SelectResource::collection($countries);
    }

    /**
     * Display a listing of the resource.
     *
     * @param   \App\Http\Filters\SelectFilter  $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function cities(SelectFilter $filter)
    {
        $cities = City::filter($filter)->paginate();

        return SelectResource::collection($cities);
    }

    /**
     * Display a listing of the resource.
     *
     * @param   \App\Http\Filters\SelectFilter  $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function supervisors(SelectFilter $filter)
    {
        $supervisors = Supervisor::filter($filter)->paginate();

        return SelectResource::collection($supervisors);
    }

    /**
     * Display a listing of the resource.
     *
     * @param   \App\Http\Filters\SelectFilter  $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function employees(SelectFilter $filter)
    {
        $employees = Employee::filter($filter)->paginate();

        return SelectResource::collection($employees);
    }

    /**
     * Display a listing of the resource.
     *
     * @param   \App\Http\Filters\SelectFilter  $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function packages(SelectFilter $filter)
    {
        $packages = Package::filter($filter)->paginate();

        return SelectResource::collection($packages);
    }
}
