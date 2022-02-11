@extends('layouts.dashboard', ['title' => trans('cities.plural')])

@section('content')
    @component('Template::components.page')
        @slot('title', trans('cities.plural'))
        @slot('breadcrumbs', ['dashboard.cities.index'])

        @component('Template::components.table-box')
            @slot('title', trans('cities.actions.list'))
            @slot('tools')
                @include('dashboard.cities.partials.actions.filter')
                @include('dashboard.cities.partials.actions.create')
            @endslot

            <thead>
            <tr>
                <th>@lang('cities.attributes.name')</th>
                <th>@lang('cities.attributes.country')</th>
                <th style="width: 160px">...</th>
            </tr>
            </thead>
            <tbody>
            @forelse($cities as $city)
                <tr>
                    <td>
                        {{ $city->name }}
                    </td>
                    <td>
                        {{ $city->country->name }}
                    </td>
                    <td>
                        @include('dashboard.cities.partials.actions.show')
                        @include('dashboard.cities.partials.actions.edit')
                        @include('dashboard.cities.partials.actions.delete')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" class="text-center">@lang('cities.empty')</td>
                </tr>
            @endforelse

            @if($cities->hasPages())
                @slot('footer')
                    {{ $cities->links() }}
                @endslot
            @endif
        @endcomponent

    @endcomponent
@endsection
