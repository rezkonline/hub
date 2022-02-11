@component('Template::components.table-box')
    @slot('title', trans('transactions.actions.list'))

    <thead>
    <tr>
        <th>@lang('transactions.attributes.amount')</th>
        <th>@lang('transactions.attributes.payment_type')</th>
        <th>@lang('transactions.attributes.actor_id')</th>
        <th>@lang('transactions.attributes.note')</th>
        <th>@lang('transactions.attributes.receipt')</th>
        <th>@lang('transactions.attributes.date')</th>
    </tr>
    </thead>
    <tbody>
    @forelse($user->transactions()->orderBy('id', 'DESC')->get() as $transaction)
        <tr>
            <td class="d-none d-md-table-cell">
                <span class="{{ $transaction->amount > 0 ? 'text-success' : 'text-danger' }}">{{ $transaction->amount }} $</span>
            </td>
            <td class="d-none d-md-table-cell">
                {{ $transaction->payment_type }}
            </td>
            <td class="d-none d-md-table-cell">
                {{ $transaction->actor->name }}
            </td>
            <td class="d-none d-md-table-cell">
                {{ !is_null($transaction->note) ? $transaction->note : trans('transactions.empty_note') }}
            </td>
            <td class="d-none d-md-table-cell">
                @if(!empty($transaction->getReceipt()))
                    <a href="{{ $transaction->getReceipt() }}">@lang('transactions.attributes.receipt')</a>
                @else
                    @lang('transactions.receipt_empty')
                @endif
            </td>
            <td class="d-none d-md-table-cell">
                {{ $transaction->created_at->diffForHumans() }}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="100" class="text-center">@lang('transactions.empty')</td>
        </tr>
    @endforelse
@endcomponent
