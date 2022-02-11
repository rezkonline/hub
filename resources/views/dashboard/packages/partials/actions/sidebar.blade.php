@component('Template::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Package::class])
    @slot('url', route('dashboard.packages.index'))
    @slot('name', trans('packages.plural'))
    @slot('routeActive', '*packages*')
    @slot('icon', 'fas fa-suitcase')
    @slot('tree', [
        [
            'name' => trans('packages.actions.list'),
            'url' => route('dashboard.packages.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Package::class],
            'routeActive' => '*packages.index',
        ],
        [
            'name' => trans('packages.actions.create'),
            'url' => route('dashboard.packages.create'),
            'can' => ['ability' => 'create', 'model' => \App\Models\Package::class],
            'routeActive' => '*packages.create',
        ],
    ])
@endcomponent
