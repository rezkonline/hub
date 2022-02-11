@extends('layouts.dashboard', ['title' => trans('campaigns.plural')])

@section('content')
    @component('Template::components.page')
        @slot('title', trans('campaigns.plural'))
        @slot('breadcrumbs', ['dashboard.campaigns.index'])

        @component('Template::components.table-box')
            @slot('title', trans('campaigns.actions.list'))
            @slot('tools')
                @include('dashboard.campaigns.partials.actions.filter')
            @endslot

            <thead>
            <tr>
                <th>@lang('campaigns.attributes.name')</th>
                <th>@lang('campaigns.attributes.customer_id')</th>
                <th>@lang('campaigns.attributes.status')</th>
                <th>@lang('campaigns.attributes.created_at')</th>
                <th style="width: 200px">...</th>
            </tr>
            </thead>
            <tbody>
            @forelse($campaigns as $campaign)
                <tr>
                    <td>
                        {{ $campaign->name }}
                    </td>
                    <td>
                        <a href="{{ route('dashboard.users.show', $campaign->customer) }}">{{ $campaign->customer->name }}</a>
                    </td>
                    <td>
                        @lang('campaigns.types.'.$campaign->status)
                    </td>
                    <td>
                        {{ $campaign->created_at->diffForHumans() }}
                    </td>
                    <td>
                        @include('dashboard.campaigns.partials.actions.show')
                        @include('dashboard.campaigns.partials.actions.delete')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" class="text-center">@lang('campaigns.empty')</td>
                </tr>
            @endforelse

            @if($campaigns->hasPages())
                @slot('footer')
                    {{ $campaigns->links() }}
                @endslot
            @endif
        @endcomponent

    @endcomponent
@endsection
