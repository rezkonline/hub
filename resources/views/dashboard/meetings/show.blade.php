@extends('layouts.dashboard', ['title' => $meeting->name])
@section('content')
    @component('Template::components.page')
        @slot('title', $meeting->name)
        @slot('breadcrumbs', ['dashboard.meetings.show', $meeting])

        <div class="row">
            <div class="col-md-12">
                @component('Template::components.box')
                    @slot('bodyClass', 'p-0')

                    <table class="table table-striped">
                        <tr>
                            <th>@lang('meetings.attributes.name')</th>
                            <td>{{ $meeting->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('meetings.attributes.description')</th>
                            <td>{{ $meeting->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('meetings.attributes.duration')</th>
                            <td>{{ $meeting->duration }}</td>
                        </tr>
                        <tr>
                            <th>@lang('meetings.attributes.start_at')</th>
                            <td>{{ $meeting->start_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    </table>

                    @slot('footer')
                        @include('dashboard.meetings.partials.actions.edit')
                        @include('dashboard.meetings.partials.actions.delete')
                    @endslot
                @endcomponent
            </div>
        </div>

        @component('Template::components.table-box')
            @slot('title', trans('customers.actions.list'))

            <thead>
            <tr>
                <th>@lang('customers.attributes.name')</th>
            </tr>
            </thead>
            <tbody>
            @forelse($meeting->customers as $customer)
                <tr>
                    <td>
                        {{ $customer->name }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" class="text-center">@lang('customers.empty')</td>
                </tr>
            @endforelse
        @endcomponent
    @endcomponent
@endsection
