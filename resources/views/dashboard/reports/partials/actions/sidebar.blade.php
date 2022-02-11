@component('Template::components.sidebarItem')
    @slot('can', ['ability' => 'show-reports', 'model' => auth()->user()])
    @slot('url', route('dashboard.reports.financial'))
    @slot('name', trans('reports.plural'))
    @slot('routeActive', '*reports*')
    @slot('icon', 'fas fa-chart-bar')
    @slot('tree', [
        [
            'name' => trans('reports.actions.financial'),
            'url' => route('dashboard.reports.financial'),
            'can' => ['ability' => 'show-reports', 'model' => auth()->user()],
            'routeActive' => '*reports.financial',
        ],
        [
            'name' => trans('reports.actions.arrears'),
            'url' => route('dashboard.reports.arrears'),
            'can' => ['ability' => 'show-reports', 'model' => auth()->user()],
            'routeActive' => '*reports.arrears',
        ],
        [
            'name' => trans('reports.actions.customers'),
            'url' => route('dashboard.reports.customers'),
            'can' => ['ability' => 'show-reports', 'model' => auth()->user()],
            'routeActive' => '*reports.customers',
        ],
        [
            'name' => trans('reports.actions.transactions'),
            'url' => route('dashboard.reports.transactions'),
            'can' => ['ability' => 'show-reports', 'model' => auth()->user()],
            'routeActive' => '*reports.transactions',
        ],
    ])
@endcomponent
