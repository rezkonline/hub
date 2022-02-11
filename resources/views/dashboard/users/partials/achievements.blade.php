@component('Template::components.table-box')
    @slot('title', trans('achievements.actions.list'))

    <thead>
    <tr>
        <th>@lang('achievements.attributes.title')</th>
        <th>@lang('achievements.attributes.value')</th>
        <th style="width: 200px">...</th>
    </tr>
    </thead>
    <tbody>
    @forelse($user->achievements as $achievement)
        <tr>
            <td>
                {{ $achievement->title }}
            </td>
            <td>
                {{ $achievement->value }}
            </td>
            <td>
                @include('dashboard.achievements.partials.actions.edit')
                @include('dashboard.achievements.partials.actions.delete')
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="100" class="text-center">@lang('achievements.empty')</td>
        </tr>
    @endforelse
@endcomponent
