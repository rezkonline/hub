@extends('layouts.dashboard', ['title' => $user->name])
@section('content')
    @component('Template::components.page')
        @slot('title', $user->name)
        @slot('breadcrumbs', ['dashboard.users.edit', $user, $resource])

        {{ BsForm::resource($resource)->putModel($user, route('dashboard.users.update', $user), ['files' => true]) }}
        @component('Template::components.box')
            @slot('title', trans($resource.'.actions.edit'))

            @include('dashboard.users.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans($resource.'.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
