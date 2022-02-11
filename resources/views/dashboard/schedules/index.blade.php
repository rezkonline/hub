@extends('layouts.dashboard', ['title' => trans('schedules.plural')])

@section('content')
    @component('Template::components.page')
        @slot('title', trans('schedules.plural'))
        @slot('breadcrumbs', ['dashboard.schedules.index'])

        @component('Template::components.table-box')
            @slot('title', trans('schedules.actions.list'))
            @slot('tools')
                @include('dashboard.schedules.partials.actions.filter')
            @endslot

            <thead>
            <tr>
                <th>@lang('schedules.attributes.name')</th>
                <th>@lang('schedules.attributes.customer_id')</th>
                <th>@lang('schedules.attributes.status')</th>
                <th>@lang('schedules.attributes.created_at')</th>
                <th style="width: 200px">...</th>
            </tr>
            </thead>
            <tbody>
            @forelse($schedules as $schedule)
                <tr>
                    <td>
                        {{ $schedule->name }}
                    </td>
                    <td>
                        <a href="{{ route('dashboard.users.show', $schedule->customer) }}">{{ $schedule->customer->name }}</a>
                    </td>
                    <td>
                        @lang('schedules.types.'.$schedule->status)
                    </td>
                    <td>
                        {{ $schedule->created_at->diffForHumans() }}
                    </td>
                    <td>
                        @include('dashboard.schedules.partials.actions.show')
                        @include('dashboard.schedules.partials.actions.delete')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" class="text-center">@lang('schedules.empty')</td>
                </tr>
            @endforelse

            @if($schedules->hasPages())
                @slot('footer')
                    {{ $schedules->links() }}
                @endslot
            @endif
        @endcomponent

    @endcomponent
@endsection
