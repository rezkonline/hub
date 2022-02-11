@extends('layouts.dashboard', ['title' => trans('reports.plural')])

@section('content')
    @component('Template::components.page')
        @slot('title', trans('reports.plural'))
        @slot('breadcrumbs', ['dashboard.reports.arrears'])

        <div class="row">
            <div class="col-12">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $remaining }} $</h3>
                        <p>@lang('statistics.total_remaining')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money-bill"></i>
                    </div>
                </div>
            </div>
        </div>

        @component('Template::components.table-box')
            @slot('title', trans('customers.actions.list'))
            @slot('tools')
                @include('dashboard.users.partials.actions.filter')
            @endslot

            <thead>
            <tr>
                <th>@lang('customers.attributes.name')</th>
                <th>@lang('customers.attributes.email')</th>
                <th>@lang('customers.total')</th>
                <th style="width: 200px">...</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        <span class="{{ $user->getWallet() > 0 ? 'text-success' : 'text-danger' }}">{{ $user->getWallet() }} $</span>
                    </td>
                    <td>
                        @include('dashboard.users.partials.actions.show')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" class="text-center">@lang('customers.empty')</td>
                </tr>
            @endforelse

            @if($users->hasPages())
                @slot('footer')
                    {{ $users->links() }}
                @endslot
            @endif
        @endcomponent
    @endcomponent
@endsection
