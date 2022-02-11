@extends('layouts.dashboard', ['title' => trans($resource.'.plural')])

@section('content')
    @component('Template::components.page')
        @slot('title', trans($resource.'.plural'))
        @slot('breadcrumbs', ['dashboard.users.index', $resource])

        @component('Template::components.table-box')
            @slot('title', trans($resource.'.actions.list'))
            @slot('tools')
                @include('dashboard.users.partials.actions.filter')
                @include('dashboard.users.partials.actions.create')
            @endslot

            <thead>
            <tr>
                <th>@lang($resource.'.attributes.name')</th>
                <th class="d-none d-md-table-cell">@lang($resource.'.attributes.email')</th>
                @if(request()->query('type', \App\Models\User::CUSTOMER_TYPE) === \App\Models\User::CUSTOMER_TYPE)
                    <th class="d-none d-md-table-cell">@lang('supervisors.singular')</th>
                    <th class="d-none d-md-table-cell">@lang('employees.plural')</th>
                    <th class="d-none d-md-table-cell">@lang('customers.attributes.status')</th>
                @endif
                <th style="width: 160px">...</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
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
                    @if(request()->query('type', \App\Models\User::CUSTOMER_TYPE) == \App\Models\User::CUSTOMER_TYPE)
                        <td class="d-none d-md-table-cell">
                            {{ $user->manager->name }}
                        </td>
                        <td class="d-none d-md-table-cell">
                            {{ $user->employees->implode('name', ', ') }}
                        </td>
                        <td class="d-none d-md-table-cell">
                            {{ $user->isActivated() ? trans('customers.status.activated') : trans('customers.status.deactivated') }}
                        </td>
                    @endif
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

            @if($users->hasPages())
                @slot('footer')
                    {{ $users->append(request()->except('page'))->links() }}
                @endslot
            @endif
        @endcomponent

    @endcomponent
@endsection
