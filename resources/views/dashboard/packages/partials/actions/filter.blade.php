<button
    type="button"
    id="filter-popover"
    class="btn btn-outline-dark btn-sm">
    <i class="fas fa fa-fw fa-filter"></i>
</button>

<div id="popover-content" class="d-none">
    {{ BsForm::resource('packages')->get(null) }}
    {{ BsForm::text('name')->value(request('name')) }}
    {{ BsForm::text('price')->value(request('price')) }}
    {{ BsForm::number('perPage')
            ->value(request('perPage', 15))
            ->min(1)
             ->label(trans('packages.perPage')) }}

    <button type='submit' class='btn btn-primary btn-sm'>
        <i class="fas fa fa-fw fa-filter"></i>
        @lang('packages.actions.filter')
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
    </script>
@endpush
