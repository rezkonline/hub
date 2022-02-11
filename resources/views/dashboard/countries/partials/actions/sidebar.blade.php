@component('Template::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Country::class])
    @slot('url', route('dashboard.countries.index'))
    @slot('name', trans('countries.plural'))
    @slot('routeActive', '*countries*')
    @slot('icon', 'fas fa-globe')
    @slot('tree', [
        [
            'name' => trans('countries.actions.list'),
            'url' => route('dashboard.countries.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Country::class],
            'routeActive' => '*countries.index',
        ],
        [
            'name' => trans('countries.actions.create'),
            'url' => route('dashboard.countries.create'),
            'can' => ['ability' => 'create', 'model' => \App\Models\Country::class],
            'routeActive' => '*countries.create',
        ],
    ])
@endcomponent
