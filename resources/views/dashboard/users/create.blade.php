@extends('layouts.dashboard', ['title' => trans($resource.'.actions.create')])
@section('content')
    @component('Template::components.page')
        @slot('title', trans($resource.'.plural'))
        @slot('breadcrumbs', ['dashboard.users.create', $resource])

        {{ BsForm::resource($resource)->post(route('dashboard.users.store'), ['files' => true]) }}
        @component('Template::components.box')
            @slot('title', trans($resource.'.actions.create'))

            @include('dashboard.users.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans($resource.'.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
