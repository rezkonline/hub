@component('Template::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Meeting::class])
    @slot('url', route('dashboard.meetings.index'))
    @slot('name', trans('meetings.plural'))
    @slot('routeActive', '*meetings*')
    @slot('icon', 'fas fa-handshake')
    @slot('tree', [
        [
            'name' => trans('meetings.actions.list'),
            'url' => route('dashboard.meetings.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Meeting::class],
            'routeActive' => '*meetings.index',
        ],
        [
            'name' => trans('meetings.actions.create'),
            'url' => route('dashboard.meetings.create'),
            'can' => ['ability' => 'create', 'model' => \App\Models\Meeting::class],
            'routeActive' => '*meetings.create',
        ],
    ])
@endcomponent
