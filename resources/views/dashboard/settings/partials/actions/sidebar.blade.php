@component('Template::components.sidebarItem')
    @slot('can', ['ability' => 'edit-settings', 'model' => auth()->user()])
    @slot('name', trans('settings.plural'))
    @slot('icon', 'fa fa-cog')
    @slot('tree', [
        [
            'name' => trans('settings.actions.list'),
            'url' => route('dashboard.settings.index'),
            'can' => ['ability' => 'edit-settings', 'model' => auth()->user()],
            'urlActive' => route('dashboard.settings.index'),
        ],
    ])
@endcomponent
