@extends('layouts.dashboard')

@section('content')
    @component('Template::components.page')
        @slot('title', trans('dashboard.home'))
        @slot('breadcrumbs', ['dashboard.home'])

        @if(auth()->user()->isSupervisor() || auth()->user()->isEmployee())
            @include('dashboard.statistics.supervisor')
        @else
            @include('dashboard.statistics.admin')
        @endif
    @endcomponent
@endsection

