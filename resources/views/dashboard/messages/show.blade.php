@extends('layouts.dashboard', ['title' => trans('messages.actions.list')])
@section('content')
    @component('Template::components.page')
        @slot('title', trans('messages.actions.list'))

        <admin-chat-component
            auth-id="{{ auth()->user()->id }}"
            auth-name="{{ auth()->user()->name }}"
            auth-avatar="{{ auth()->user()->getAvatar() }}"></admin-chat-component>
    @endcomponent
@endsection