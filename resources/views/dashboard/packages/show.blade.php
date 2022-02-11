@extends('layouts.dashboard', ['title' => $package->name])
@section('content')
    @component('Template::components.page')
        @slot('title', $package->name)
        @slot('breadcrumbs', ['dashboard.packages.show', $package])

        <div class="row">
            <div class="col-md-12">
                @component('Template::components.box')
                    @slot('bodyClass', 'p-0')

                    <table class="table table-striped">
                        <tr>
                            <th>@lang('packages.attributes.name')</th>
                            <td>{{ $package->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('packages.attributes.price')</th>
                            <td>{{ $package->price }}</td>
                        </tr>
                    </table>

                    @slot('footer')
                        @include('dashboard.packages.partials.actions.edit')
                        @include('dashboard.packages.partials.actions.delete')
                    @endslot
                @endcomponent
            </div>
        </div>

        @component('Template::components.table-box')
            @slot('title', trans('customers.actions.list'))

            <thead>
            <tr>
                <th>@lang('customers.attributes.name')</th>
            </tr>
            </thead>
            <tbody>
            @forelse($package->users as $customer)
                <tr>
                    <td>
                        {{ $customer->name }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" class="text-center">@lang('customers.empty')</td>
                </tr>
            @endforelse

        @endcomponent

    @endcomponent
@endsection
