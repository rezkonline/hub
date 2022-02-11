<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\User;
use App\Models\Country;
use App\Models\Package;
use App\Models\Employee;
use App\Models\Supervisor;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRequest;
use App\Http\Requests\Dashboard\PackageUserRequest;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Filters\UserFilter $filter
     * @return \Illuminate\Http\Response
     */
    public function index(UserFilter $filter)
    {
        $resource = Str::plural(request()->query('type', User::CUSTOMER_TYPE));

        if (auth()->user()->isAdmin()) {
            $users = User::filter($filter)->paginate();
        } else {
            $users = auth()->user()->customers()->filter($filter)->paginate();
        }

        $countries = Country::listsTranslations('name')->pluck('name', 'id');
        $cities = [];

        if (! empty(request()->query('city', '')) || ! empty(request()->query('country', ''))) {
            $cities = City::where('country_id', request()->query('country'))->listsTranslations('name')->pluck('name', 'id');
        }

        return view('dashboard.users.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resource = Str::plural(request()->query('type', User::CUSTOMER_TYPE));

        return view('dashboard.users.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->allWithHashedPassword());

        $user->addAllMediaFromTokens();
        $user->setType($request->input('type'));

        if ($request->input('type') === User::CUSTOMER_TYPE) {
            $user->employees()->attach($request->input('employee_id'));
        }

        if ($request->has('attachments')) {
            $user->clearMediaCollection('attachments');
            $user->addMultipleMediaFromRequest(['attachments'])
                ->each(function ($media) {
                    $media->toMediaCollection('attachments');
                });
        }

        $resource = Str::plural($user->type);

        flash(trans($resource.'.messages.created'));

        return redirect()->route('dashboard.users.show', $user);
    }

    /**
     * Attach package to customer.
     *
     * @param PackageUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function attachPackage(PackageUserRequest $request, User $user)
    {
        \DB::transaction(function () use ($request, $user) {
            $user->packages()->attach($request->input('id'));

            $package = Package::find($request->input('id'));

            Transaction::create([
                'amount' => $package->price * -1,
                'customer_id' => $user->id,
                'actor_id' => auth()->id(),
                'payment_type' => trans('frontend.nothing'),
                'type' => Transaction::PACKAGE_TYPE,
                'notes' => trans('packages.actions.subscription'),
            ]);
        });

        $resource = Str::plural($user->type);

        flash(trans($resource.'.messages.updated'));

        return redirect()->route('dashboard.users.show', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $resource = Str::plural($user->type);
        $packages = Package::all()->pluck('name', 'id');

        if ($user->isSupervisor() || $user->isEmployee()) {
            $customers = $user->customers()->paginate();

            $countries = Country::listsTranslations('name')->pluck('name', 'id');
            $cities = [];

            if (! empty(request()->query('city', '')) || ! empty(request()->query('country', ''))) {
                $cities = City::where('country_id', request()->query('country'))->listsTranslations('name')->pluck('name', 'id');
            }
        }

        return view('dashboard.users.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $resource = Str::plural($user->type);
        $countries = Country::listsTranslations('name')->pluck('name', 'id');
        $cities = City::where('country_id', $user->country_id)->listsTranslations('name')->pluck('name', 'id');
        $managers = Supervisor::pluck('name', 'id');
        $employees = Employee::pluck('name', 'id');

        return view('dashboard.users.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\UserRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $resource = Str::plural($user->type);

        $user->update($request->allWithHashedPassword());
        $user->addAllMediaFromTokens();

        if ($user->type === User::CUSTOMER_TYPE) {
            $user->employees()->sync($request->input('employee_id'));
        }

        if ($request->has('attachments')) {
            $user->clearMediaCollection('attachments');
            $user->addMultipleMediaFromRequest(['attachments'])
                ->each(function ($media) {
                    $media->toMediaCollection('attachments');
                });
        }

        if ($request->has('settings')) {
            $user->removeSettings();
            foreach ($request->input('settings') as $setting) {
                $user->setSetting($setting, true);
            }
            $user->save();
        }

        flash(trans($resource.'.messages.updated'));

        return redirect()->route('dashboard.users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('dashboard.users.index');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function activate(User $user)
    {
        $this->authorize('activate', $user);

        $user->activate();

        flash(trans('customers.messages.activated'));

        return redirect()->route('dashboard.users.show', $user);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function deactivate(User $user)
    {
        $this->authorize('deactivate', $user);

        $user->deactivate();

        flash(trans('customers.messages.deactivated'));

        return redirect()->route('dashboard.users.show', $user);
    }
}
