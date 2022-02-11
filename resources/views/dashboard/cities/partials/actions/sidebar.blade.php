@component('Template::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\City::class])
    @slot('url', route('dashboard.cities.index'))
    @slot('name', trans('cities.plural'))
    @slot('routeActive', '*cities*')
    @slot('icon', 'fas fa-flag')
    @slot('tree', [
        [
            'name' => trans('cities.actions.list'),
            'url' => route('dashboard.cities.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\City::class],
            'routeActive' => '*cities.index',
        ],
        [
            'name' => trans('cities.actions.create'),
            'url' => route('dashboard.cities.create'),
            'can' => ['ability' => 'create', 'model' => \App\Models\City::class],
            'routeActive' => '*cities.create',
        ],
    ])
@endcomponent
