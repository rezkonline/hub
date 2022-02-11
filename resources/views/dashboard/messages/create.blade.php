@extends('layouts.dashboard', ['title' => trans('messages.actions.create')])
@section('content')
    @component('Template::components.page')
        @slot('title', trans('messages.plural'))

        {{ BsForm::resource('messages')->post(route('dashboard.users.messages.store', $user)) }}
        @component('Template::components.box')
            @slot('title', trans('messages.actions.create'))

            @include('dashboard.messages.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('messages.actions.send')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
