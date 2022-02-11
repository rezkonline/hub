@component('Template::components.table-box')
    @slot('title', trans('attachments.actions.list'))
    <thead>
    <tr>
        <th>@lang('attachments.attributes.name')</th>
        <th style="width: 200px">...</th>
    </tr>
    </thead>
    <tbody>
    @forelse($user->getMedia('attachments') as $attachment)
        <tr>
            <td>
                <a href="{{ $attachment->getFullUrl() }}">{{ $attachment->name }}</a>
            </td>
            <td>
                @include('dashboard.attachments.partials.actions.show')
                @include('dashboard.attachments.partials.actions.delete')
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="100" class="text-center">@lang('attachments.empty')</td>
        </tr>
    @endforelse
@endcomponent