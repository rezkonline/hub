@extends('layouts.dashboard', ['title' => $meeting->name])
@section('content')
    @component('Template::components.page')
        @slot('title', $meeting->name)
        @slot('breadcrumbs', ['dashboard.meetings.edit', $meeting])

        {{ BsForm::resource('meetings')->putModel($meeting, route('dashboard.meetings.update', $meeting)) }}
        @component('Template::components.box')
            @slot('title', trans('meetings.actions.edit'))

            @include('dashboard.meetings.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('meetings.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
