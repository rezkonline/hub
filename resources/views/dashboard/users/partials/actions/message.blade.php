@can('viewAny', [\App\Models\Message::class, $user])
    <a href="{{ route('dashboard.users.messages.index', $user) }}" class="btn btn-outline-dark btn-sm">
        <i class="fas fa fa-fw fa-comments"></i>
    </a>
@endcan
