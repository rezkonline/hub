@extends('layouts.dashboard', ['title' => $package->name])
@section('content')
    @component('Template::components.page')
        @slot('title', $package->name)
        @slot('breadcrumbs', ['dashboard.packages.edit', $package])

        {{ BsForm::resource('packages')->putModel($package, route('dashboard.packages.update', $package)) }}
        @component('Template::components.box')
            @slot('title', trans('packages.actions.edit'))

            @include('dashboard.packages.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('packages.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
