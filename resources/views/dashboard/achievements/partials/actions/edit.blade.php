@can('update', $achievement)
    <a href="{{ route('dashboard.users.achievements.edit', [$user, $achievement]) }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa fa-fw fa-edit"></i>
    </a>
@endcan
