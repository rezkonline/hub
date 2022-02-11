@extends('layouts.dashboard', ['title' => trans('tasks.plural')])

@section('content')
    @component('Template::components.page')
        @slot('title', trans('tasks.plural'))
        @slot('breadcrumbs', ['dashboard.tasks.index'])

        @component('Template::components.table-box')
            @slot('title', trans('tasks.actions.list'))
            @slot('tools')
                @include('dashboard.tasks.partials.actions.filter')
            @endslot

            <thead>
            <tr>
                <th>@lang('tasks.attributes.name')</th>
                <th>@lang('tasks.attributes.customer_id')</th>
                <th>@lang('tasks.attributes.status')</th>
                <th>@lang('tasks.attributes.created_at')</th>
                <th style="width: 200px">...</th>
            </tr>
            </thead>
            <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>
                        {{ $task->name }}
                    </td>
                    <td>
                        <a href="{{ route('dashboard.users.show', $task->customer) }}">{{ $task->customer->name }}</a>
                    </td>
                    <td>
                        @lang('tasks.types.'.$task->status)
                    </td>
                    <td>
                        {{ $task->created_at->diffForHumans() }}
                    </td>
                    <td>
                        @include('dashboard.tasks.partials.actions.show')
                        @include('dashboard.tasks.partials.actions.delete')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" class="text-center">@lang('tasks.empty')</td>
                </tr>
            @endforelse

            @if($tasks->hasPages())
                @slot('footer')
                    {{ $tasks->links() }}
                @endslot
            @endif
        @endcomponent

    @endcomponent
@endsection
