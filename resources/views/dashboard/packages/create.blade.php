@extends('layouts.dashboard', ['title' => trans('packages.actions.create')])
@section('content')
    @component('Template::components.page')
        @slot('title', trans('packages.plural'))
        @slot('breadcrumbs', ['dashboard.packages.create'])

        {{ BsForm::resource('packages')->post(route('dashboard.packages.store')) }}
        @component('Template::components.box')
            @slot('title', trans('packages.actions.create'))

            @include('dashboard.packages.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('packages.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
