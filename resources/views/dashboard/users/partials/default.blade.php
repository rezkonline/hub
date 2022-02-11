<div class="row">
    <div class="col-md-12">
        @component('Template::components.box')
            @slot('bodyClass', 'p-0')

            <table class="table table-striped">
                <tr>
                    <th>@lang($resource.'.attributes.name')</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>@lang($resource.'.attributes.email')</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>@lang($resource.'.attributes.avatar')</th>
                    <td>
                        <img src="{{ $user->getAvatar() }}" alt="{{ $user->name }}">
                    </td>
                </tr>
            </table>

            @slot('footer')
                @include('dashboard.users.partials.actions.edit')
                @include('dashboard.users.partials.actions.delete')
            @endslot
        @endcomponent
    </div>
    @if($user->isSupervisor() || $user->isEmployee())
        <div class="col-md-12">
            @component('Template::components.table-box')
                @slot('title', trans('customers.actions.list'))
                @slot('tools')
                    @include('dashboard.users.partials.actions.filter')
                @endslot

                <thead>
                <tr>
                    <th>@lang('customers.attributes.name')</th>
                    <th class="d-none d-md-table-cell">@lang('customers.attributes.email')</th>
                    <th style="width: 160px">...</th>
                </tr>
                </thead>
                <tbody>
                @forelse($customers as $user)
                    <tr>
                        <td>
                            <a href="{{ route('dashboard.users.show', $user) }}"
                               class="text-decoration-none text-ellipsis">
                            <span class="index-flag">
                            @include('dashboard.users.partials.flags.svg')
                            </span>
                                <img src="{{ $user->getAvatar() }}"
                                     alt="{{ $user->name }}"
                                     class="img-circle img-size-32 mr-2">
                                {{ $user->name }}
                            </a>
                        </td>
                        <td class="d-none d-md-table-cell">
                            {{ $user->email }}
                        </td>
                        <td style="width: 160px">
                            @include('dashboard.users.partials.actions.show')
                            @include('dashboard.users.partials.actions.impersonate')
                            @include('dashboard.users.partials.actions.notice')
                            @include('dashboard.users.partials.actions.message')
                            @include('dashboard.users.partials.actions.edit')
                            @include('dashboard.users.partials.actions.delete')
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100" class="text-center">@lang($resource.'.empty')</td>
                    </tr>
                @endforelse

                @if($customers->hasPages())
                    @slot('footer')
                        {{ $customers->append(request()->except('page'))->links() }}
                    @endslot
                @endif
            @endcomponent
        </div>
    @endif
</div>
