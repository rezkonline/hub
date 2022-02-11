<div class="row mb-3">
    <div class="col-md-4 text-right float-right">
        <form action="" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" name="dates" value="{{ request('dates') }}">
                <span class="input-group-append">
                    <button type="submit" class="btn btn-outline-primary btn-sm" id="search">@lang('reports.actions.filter')</button>
                </span>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        (function ($) {
            'use strict';

            var $input = $('input[name="dates"]');

            $input.daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: '{{ trans('reports.actions.cancel') }}',
                    applyLabel: '{{ trans('reports.actions.filter') }}'
                }
            });

            $input.on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ',' + picker.endDate.format('YYYY-MM-DD'));
                $("#search").click();
            });
        })(jQuery);
    </script>
@endpush
