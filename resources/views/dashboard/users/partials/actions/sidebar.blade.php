@component('Template::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\User::class])
    @slot('url', route('dashboard.users.index'))
    @slot('name', trans('users.plural'))
    @slot('routeActive', '*users*')
    @slot('icon', 'fas fa-users')
    @slot('tree', [
        [
            'name' => trans('admins.actions.list'),
            'url' => route('dashboard.users.index', ['type' => 'admin']),
            'can' => ['ability' => 'viewAny', 'model' => [\App\Models\User::class, 'admin']],
            'urlActive' => route('dashboard.users.index', ['type' => 'admin']),
        ],
        [
            'name' => trans('supervisors.actions.list'),
            'url' => route('dashboard.users.index', ['type' => 'supervisor']),
            'can' => ['ability' => 'viewAny', 'model' => [\App\Models\User::class, 'supervisor']],
            'urlActive' => route('dashboard.users.index', ['type' => 'supervisor']),
        ],
        [
            'name' => trans('employees.actions.list'),
            'url' => route('dashboard.users.index', ['type' => 'employee']),
            'can' => ['ability' => 'viewAny', 'model' => [\App\Models\User::class, 'employee']],
            'urlActive' => route('dashboard.users.index', ['type' => 'employee']),
        ],
        [
            'name' => trans('customers.actions.list'),
            'url' => route('dashboard.users.index', ['type' => 'customer']),
            'can' => ['ability' => 'viewAny', 'model' => [\App\Models\User::class, 'customer']],
            'urlActive' => route('dashboard.users.index', ['type' => 'customer']),
        ],
    ])
@endcomponent
