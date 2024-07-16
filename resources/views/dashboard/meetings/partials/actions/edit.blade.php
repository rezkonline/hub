@can('update', $meeting)
    <a href="{{ route('dashboard.meetings.edit', $meeting) }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa fa-fw fa-edit"></i>
    </a>
@endcan
