@can('view', $campaign)
    <a href="{{ route('dashboard.campaigns.show', $campaign) }}" class="btn btn-outline-dark btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </a>
@endcan
