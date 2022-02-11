@can('create', [\App\Models\Transaction::class, $user])
    {{ BsForm::resource('transactions')->post(route('dashboard.users.transactions.store', $user), ['files' => true]) }}
    @component('Template::components.box')
        @slot('title', trans('transactions.actions.create'))

        @include('dashboard.transactions.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('transactions.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
@endcan
