@can('view', $package)
    <a href="{{ route('dashboard.packages.show', $package) }}" class="btn btn-outline-dark btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </a>
@endcan
