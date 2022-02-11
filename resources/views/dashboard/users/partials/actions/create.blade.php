@can('create', \App\Models\User::class)
    <a href="{{ route('dashboard.users.create', ['type' => request()->query('type', 'customer')]) }}" class="btn btn-outline-success btn-sm">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang($resource.'.actions.create')
    </a>
@endcan
