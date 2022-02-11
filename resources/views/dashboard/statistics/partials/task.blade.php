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
    @forelse($tasks->take(10)->get() as $task)
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

@endcomponent
