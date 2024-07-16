@extends('layouts.dashboard', ['title' => trans('meetings.plural')])

@section('content')
    @component('Template::components.page')
        @slot('title', trans('meetings.plural'))
        @slot('breadcrumbs', ['dashboard.meetings.index'])

        @component('Template::components.table-box')
            @slot('title', trans('meetings.actions.list'))
            @slot('tools')
                @include('dashboard.meetings.partials.actions.filter')
                @include('dashboard.meetings.partials.actions.create')
            @endslot

            <thead>
            <tr>
                <th>@lang('meetings.attributes.name')</th>
                <th>@lang('meetings.attributes.duration')</th>
                <th>@lang('meetings.attributes.start_at')</th>
                <th>@lang('meetings.attributes.customers_count')</th>
                <th style="width: 200px">...</th>
            </tr>
            </thead>
            <tbody>
            @forelse($meetings as $meeting)
                <tr>
                    <td>
                        {{ $meeting->name }}
                    </td>
                    <td>
                        {{ $meeting->duration }}
                    </td>
                    <td>
                        {{ $meeting->start_at->format('Y-m-d H:i') }}
                    </td>
                    <td>
                        {{ $meeting->customers()->count() }}
                    </td>
                    <td>
                        @include('dashboard.meetings.partials.actions.show')
                        @include('dashboard.meetings.partials.actions.edit')
                        @include('dashboard.meetings.partials.actions.delete')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" class="text-center">@lang('meetings.empty')</td>
                </tr>
            @endforelse

            @if($meetings->hasPages())
                @slot('footer')
                    {{ $meetings->links() }}
                @endslot
            @endif
        @endcomponent

    @endcomponent
@endsection
