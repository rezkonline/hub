@can('create', [\App\Models\Message::class, $user])
    <a href="{{ route('dashboard.users.messages.create', $user) }}" class="btn btn-outline-warning btn-sm">
        <i class="fas fa fa-exclamation-triangle"></i>
    </a>
@endcan
