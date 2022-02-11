@extends('layouts.dashboard', ['title' => $country->name])
@section('content')
    @component('Template::components.page')
        @slot('title', $country->name)
        @slot('breadcrumbs', ['dashboard.countries.edit', $country])

        {{ BsForm::resource('countries')->putModel($country, route('dashboard.countries.update', $country)) }}
        @component('Template::components.box')
            @slot('title', trans('countries.actions.edit'))

            @include('dashboard.countries.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('countries.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
