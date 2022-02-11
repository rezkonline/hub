@extends('layouts.dashboard', ['title' => trans('countries.actions.create')])
@section('content')
    @component('Template::components.page')
        @slot('title', trans('countries.plural'))
        @slot('breadcrumbs', ['dashboard.countries.create'])

        {{ BsForm::resource('countries')->post(route('dashboard.countries.store')) }}
        @component('Template::components.box')
            @slot('title', trans('countries.actions.create'))

            @include('dashboard.countries.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('countries.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
