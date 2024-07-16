@extends('Template::app')

@section('sidebar')

    @component('Template::components.sidebarItem')
        @slot('url', route('dashboard.home'))
        @slot('name', trans('dashboard.home'))
        @slot('icon', 'fas fa-tachometer-alt')
        @slot('routeActive', 'dashboard.home')
    @endcomponent

    @include('dashboard.users.partials.actions.sidebar')
    @include('dashboard.countries.partials.actions.sidebar')
    @include('dashboard.packages.partials.actions.sidebar')
    @include('dashboard.meetings.partials.actions.sidebar')
    @include('dashboard.tasks.partials.actions.sidebar')
    @include('dashboard.campaigns.partials.actions.sidebar')
    @include('dashboard.schedules.partials.actions.sidebar')
    @include('dashboard.reports.partials.actions.sidebar')
    @include('dashboard.settings.partials.actions.sidebar')

@endsection

