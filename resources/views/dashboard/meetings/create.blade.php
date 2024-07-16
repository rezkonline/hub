@extends('layouts.dashboard', ['title' => trans('meetings.actions.create')])
@section('content')
    @component('Template::components.page')
        @slot('title', trans('meetings.plural'))
        @slot('breadcrumbs', ['dashboard.meetings.create'])

        {{ BsForm::resource('meetings')->post(route('dashboard.meetings.store')) }}
        @component('Template::components.box')
            @slot('title', trans('meetings.actions.create'))

            @include('dashboard.meetings.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('meetings.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
