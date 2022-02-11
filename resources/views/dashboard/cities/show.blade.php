@extends('layouts.dashboard', ['title' => $city->name])
@section('content')
    @component('Template::components.page')
        @slot('title', $city->name)
        @slot('breadcrumbs', ['dashboard.cities.show', $city])

        <div class="row">
            <div class="col-md-12">
                @component('Template::components.box')
                    @slot('bodyClass', 'p-0')

                    <table class="table table-striped">
                        <tr>
                            <th>@lang('cities.attributes.name')</th>
                            <td>{{ $city->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('cities.attributes.country')</th>
                            <td>{{ $city->country->name }}</td>
                        </tr>
                    </table>

                    @slot('footer')
                        @include('dashboard.cities.partials.actions.edit')
                        @include('dashboard.cities.partials.actions.delete')
                    @endslot
                @endcomponent
            </div>
        </div>

    @endcomponent
@endsection
