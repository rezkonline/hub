@extends('layouts.dashboard', ['title' => trans('cities.actions.create')])
@section('content')
    @component('Template::components.page')
        @slot('title', trans('cities.plural'))
        @slot('breadcrumbs', ['dashboard.cities.create'])

        {{ BsForm::resource('cities')->post(route('dashboard.cities.store')) }}
        @component('Template::components.box')
            @slot('title', trans('cities.actions.create'))

            @include('dashboard.cities.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('cities.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
