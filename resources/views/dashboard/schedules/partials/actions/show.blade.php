@can('view', $schedule)
    <a href="{{ route('dashboard.schedules.show', $schedule) }}" class="btn btn-outline-dark btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </a>
@endcan
