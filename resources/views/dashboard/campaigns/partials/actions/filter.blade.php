<button
    type="button"
    id="filter-popover"
    class="btn btn-outline-dark btn-sm">
    <i class="fas fa fa-fw fa-filter"></i>
</button>

<div id="popover-content" class="d-none">
    {{ BsForm::resource('campaigns')->get(null) }}
    {{ BsForm::text('name')->value(request('name')) }}
    {{ BsForm::select('customer_id', auth()->user()->isAdmin() ? \App\Models\Customer::pluck('name', 'id') : auth()->user()->customers->pluck('name', 'id'))->value(request('customer_id')) }}
    {{ BsForm::text('status', trans('campaigns.types'))->value(request('status')) }}
    {{ BsForm::number('perPage')
            ->value(request('perPage', 15))
            ->min(1)
             ->label(trans('campaigns.perPage')) }}

    <button type='submit' class='btn btn-primary btn-sm'>
        <i class="fas fa fa-fw fa-filter"></i>
        @lang('campaigns.actions.filter')
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
