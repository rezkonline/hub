@component('Template::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Schedule::class])
    @slot('url', route('dashboard.schedules.index'))
    @slot('name', trans('schedules.plural'))
    @slot('routeActive', '*schedules*')
    @slot('icon', 'fas fa-file')
    @slot('tree', [
        [
            'name' => trans('schedules.actions.list'),
            'url' => route('dashboard.schedules.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Schedule::class],
            'routeActive' => '*schedules.index',
        ],
    ])
@endcomponent
