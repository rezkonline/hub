@extends('layouts.dashboard', ['title' => $achievement->name])
@section('content')
    @component('Template::components.page')
        @slot('title', $achievement->name)

        {{ BsForm::resource('achievements')->putModel($achievement, route('dashboard.users.achievements.update', [$user, $achievement])) }}
        @component('Template::components.box')
            @slot('title', trans('achievements.actions.edit'))

            @include('dashboard.achievements.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('achievements.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
