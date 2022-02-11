@extends('layouts.dashboard', ['title' => trans('countries.plural')])

@section('content')
    @component('Template::components.page')
        @slot('title', trans('countries.plural'))
        @slot('breadcrumbs', ['dashboard.countries.index'])

        @component('Template::components.table-box')
            @slot('title', trans('countries.actions.list'))
            @slot('tools')
                @include('dashboard.countries.partials.actions.filter')
                @include('dashboard.countries.partials.actions.create')
            @endslot

            <thead>
            <tr>
                <th>@lang('countries.attributes.name')</th>
                <th>@lang('countries.attributes.key')</th>
                <th style="width: 200px">...</th>
            </tr>
            </thead>
            <tbody>
            @forelse($countries as $country)
                <tr>
                    <td>
                        {{ $country->name }}
                    </td>
                    <td>
                        {{ $country->key }}
                    </td>
                    <td>
                        @include('dashboard.countries.partials.actions.show')
                        @include('dashboard.countries.partials.actions.edit')
                        @include('dashboard.countries.partials.actions.delete')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" class="text-center">@lang('countries.empty')</td>
                </tr>
            @endforelse

            @if($countries->hasPages())
                @slot('footer')
                    {{ $countries->links() }}
                @endslot
            @endif
        @endcomponent

    @endcomponent
@endsection
