@extends('layouts.dashboard', ['title' => trans('packages.plural')])

@section('content')
    @component('Template::components.page')
        @slot('title', trans('packages.plural'))
        @slot('breadcrumbs', ['dashboard.packages.index'])

        @component('Template::components.table-box')
            @slot('title', trans('packages.actions.list'))
            @slot('tools')
                @include('dashboard.packages.partials.actions.filter')
                @include('dashboard.packages.partials.actions.create')
            @endslot

            <thead>
            <tr>
                <th>@lang('packages.attributes.name')</th>
                <th>@lang('packages.attributes.price')</th>
                <th style="width: 200px">...</th>
            </tr>
            </thead>
            <tbody>
            @forelse($packages as $package)
                <tr>
                    <td>
                        {{ $package->name }}
                    </td>
                    <td>
                        {{ $package->price }} $
                    </td>
                    <td>
                        @include('dashboard.packages.partials.actions.show')
                        @include('dashboard.packages.partials.actions.edit')
                        @include('dashboard.packages.partials.actions.delete')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" class="text-center">@lang('packages.empty')</td>
                </tr>
            @endforelse

            @if($packages->hasPages())
                @slot('footer')
                    {{ $packages->links() }}
                @endslot
            @endif
        @endcomponent

    @endcomponent
@endsection
