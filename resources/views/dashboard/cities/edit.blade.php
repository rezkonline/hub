@extends('layouts.dashboard', ['title' => $city->name])
@section('content')
    @component('Template::components.page')
        @slot('title', $city->name)
        @slot('breadcrumbs', ['dashboard.cities.edit', $city])

        {{ BsForm::resource('cities')->putModel($city, route('dashboard.cities.update', $city)) }}
        @component('Template::components.box')
            @slot('title', trans('cities.actions.edit'))

            @include('dashboard.cities.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('cities.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
