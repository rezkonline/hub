@can('view', $meeting)
    <a href="{{ route('dashboard.meetings.show', $meeting) }}" class="btn btn-outline-dark btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </a>
@endcan
