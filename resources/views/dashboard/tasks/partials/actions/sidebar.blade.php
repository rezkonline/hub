@component('Template::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Task::class])
    @slot('url', route('dashboard.tasks.index'))
    @slot('name', trans('tasks.plural'))
    @slot('routeActive', '*tasks*')
    @slot('icon', 'fas fa-file')
    @slot('tree', [
        [
            'name' => trans('tasks.actions.list'),
            'url' => route('dashboard.tasks.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Task::class],
            'routeActive' => '*tasks.index',
        ],
    ])
@endcomponent
