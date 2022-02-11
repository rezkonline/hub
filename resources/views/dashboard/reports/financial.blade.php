@extends('layouts.dashboard', ['title' => trans('reports.plural')])

@section('content')
    @component('Template::components.page')
        @slot('title', trans('reports.plural'))
        @slot('breadcrumbs', ['dashboard.reports.financial'])
        @include('dashboard.reports.partials.actions.filter')

        <div class="row">
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $purchases }} $</h3>
                        <p>@lang('statistics.total_remaining')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money-bill"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $payments }} $</h3>
                        <p>@lang('statistics.total_payed')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money-bill"></i>
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
@endsection
