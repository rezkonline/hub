@component('Template::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Campaign::class])
    @slot('url', route('dashboard.campaigns.index'))
    @slot('name', trans('campaigns.plural'))
    @slot('routeActive', '*campaigns*')
    @slot('icon', 'fas fa-file')
    @slot('tree', [
        [
            'name' => trans('campaigns.actions.list'),
            'url' => route('dashboard.campaigns.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Campaign::class],
            'routeActive' => '*campaigns.index',
        ],
    ])
@endcomponent
