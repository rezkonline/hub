@extends('layouts.dashboard', ['title' => $user->name])
@section('content')
    @component('Template::components.page')
        @slot('title', $user->name)
        @slot('breadcrumbs', ['dashboard.users.show', $user, $resource])

        @if($user->isCustomer())
            @include('dashboard.users.partials.customer')
        @else
            @include('dashboard.users.partials.default')
        @endif
    @endcomponent
@endsection
