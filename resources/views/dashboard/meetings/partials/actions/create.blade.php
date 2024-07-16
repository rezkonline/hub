@can('create', \App\Models\Meeting::class)
    <a href="{{ route('dashboard.meetings.create') }}" class="btn btn-outline-success btn-sm">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('meetings.actions.create')
    </a>
@endcan
