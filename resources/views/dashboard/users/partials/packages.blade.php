@component('Template::components.table-box')
    @slot('title', trans('packages.actions.list'))

    <thead>
    <tr>
        <th>@lang('packages.attributes.name')</th>
        <th>@lang('packages.attributes.price')</th>
    </tr>
    </thead>
    <tbody>
    @forelse($user->packages as $package)
        <tr>
            <td class="d-none d-md-table-cell">
                {{ $package->name }}
            </td>
            <td class="d-none d-md-table-cell">
                {{ $package->price }}$
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="100" class="text-center">@lang('packages.empty')</td>
        </tr>
    @endforelse
@endcomponent
