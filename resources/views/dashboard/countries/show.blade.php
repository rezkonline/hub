@extends('layouts.dashboard', ['title' => $country->name])
@section('content')
    @component('Template::components.page')
        @slot('title', $country->name)
        @slot('breadcrumbs', ['dashboard.countries.show', $country])

        <div class="row">
            <div class="col-md-12">
                @component('Template::components.box')
                    @slot('bodyClass', 'p-0')

                    <table class="table table-striped">
                        <tr>
                            <th>@lang('countries.attributes.name')</th>
                            <td>{{ $country->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('countries.attributes.key')</th>
                            <td>{{ $country->key }}</td>
                        </tr>
                    </table>

                    @slot('footer')
                        @include('dashboard.countries.partials.actions.edit')
                        @include('dashboard.countries.partials.actions.delete')
                    @endslot
                @endcomponent
            </div>
        </div>

        @component('Template::components.table-box')
            @slot('title', trans('cities.actions.list'))

            <thead>
            <tr>
                <th>@lang('cities.attributes.name')</th>
                <th style="width: 200px">...</th>
            </tr>
            </thead>
            <tbody>
            @forelse($country->cities as $city)
                <tr>
                    <td>
                        {{ $city->name }}
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

        @endcomponent

    @endcomponent
@endsection
