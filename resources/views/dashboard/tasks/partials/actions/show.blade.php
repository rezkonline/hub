@can('view', $task)
    <a href="{{ route('dashboard.tasks.show', $task) }}" class="btn btn-outline-dark btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </a>
@endcan
