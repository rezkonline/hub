<button
    type="button"
    id="filter-popover"
    class="btn btn-outline-dark btn-sm">
    <i class="fas fa fa-fw fa-filter"></i>
</button>

<div id="popover-content" class="d-none">
    {{ BsForm::resource('meetings')->get(null) }}
    {{ BsForm::text('name')->value(request('name')) }}
    {{ BsForm::number('perPage')
            ->value(request('perPage', 15))
            ->min(1)
             ->label(trans('meetings.perPage')) }}

    <button type='submit' class='btn btn-primary btn-sm'>
        <i class="fas fa fa-fw fa-filter"></i>
        @lang('meetings.actions.filter')
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
