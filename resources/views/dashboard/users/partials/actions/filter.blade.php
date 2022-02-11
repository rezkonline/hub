@push('styles')
    <style>
        .select2-container--open {
            z-index: 9999999
        }
    </style>
@endpush

<button
    type="button"
   id="filter-popover"
   class="btn btn-outline-dark btn-sm">
    <i class="fas fa fa-fw fa-filter"></i>
</button>

<div id="popover-content" class="d-none">
    {{ BsForm::resource(Str::plural(request()->query('type', 'customer')))->get(null) }}
        {{ BsForm::text('name')->value(request('name')) }}

        @isset($countries)
        {{ BsForm::select('country', $countries)->attribute('class', 'select2bs4 form-control')->attribute('id', 'country')->placeholder(trans('global.select-all'))->label(trans('customers.attributes.country_id')) }}
        @endisset

        @isset($cities)
        {{ BsForm::select('city', $cities)->attribute('class', 'select2bs4 form-control')->attribute('id', 'city')->placeholder(trans('global.select-all'))->label(trans('customers.attributes.city_id')) }}
        @endisset

        @if(request()->query('type', \App\Models\User::CUSTOMER_TYPE) === \App\Models\User::CUSTOMER_TYPE)
            {{ BsForm::select('status', trans('customers.status')) }}
        @endif

        {{ BsForm::text('email')->value(request('email')) }}

        {{ BsForm::number('perPage')
                ->value(request('perPage', 15))
                ->min(1)
                 ->label(trans('users.perPage')) }}

        <button type='submit' class='btn btn-primary btn-sm'>
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('users.actions.filter')
        </button>

    {{ BsForm::close() }}
</div>

@push('scripts')
    <script>
        $('#filter-popover').popover({
            html: true,
            container: 'body',
            content: function () {
                return $("#popover-content").html();
            },
            placement: 'bottom',
            sanitize: false,
        });

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
