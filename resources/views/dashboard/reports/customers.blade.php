@extends('layouts.dashboard', ['title' => trans('reports.plural')])

@section('content')
    @component('Template::components.page')
        @slot('title', trans('reports.plural'))
        @slot('breadcrumbs', ['dashboard.reports.customers'])

        <div class="row">
            <div class="col-md-12">
                {{ BsForm::resource('customers')->get(null) }}
                    <div class="row">
                        <div class="col-md-3">
                            {{ BsForm::select('country', $countries)->placeholder(trans('global.select-all'))->attribute('class', 'select2bs4 form-control w-100')->attribute('id', 'country') }}
                        </div>
                        <div class="col-md-3">
                            {{ BsForm::select('city', $cities)->attribute('class', 'select2bs4 form-control w-100')->attribute('id', 'city')->placeholder(trans('global.select-all')) }}
                        </div>
                        <div class="col-md-3">
                            {{ BsForm::select('status', trans('customers.status'))->label('') }}
                        </div>
                        <div class="col-md-3">
                            <button type='submit' class='btn btn-primary'>
                                <i class="fas fa fa-fw fa-filter"></i>
                                @lang('users.actions.filter')
                            </button>
                        </div>
                    </div>
                {{ BsForm::close() }}
            </div>
            <div class="col-12">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $customers }}</h3>
                        <p>@lang('statistics.customers')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

    @endcomponent
@endsection

@push('scripts')
    <script>
        // Dependent dropdown
        (function ($) {
            'use strict';
            $("#city").depdrop({
                url: "{{ route('api.cities.index') }}",
                depends: ["country"],
                loadingText: "{{ trans('frontend.loading') }}",
            });
        })(jQuery);
    </script>
@endpush
