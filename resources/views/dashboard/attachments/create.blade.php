@can('storeAttachment', $user)
    {{ BsForm::resource('attachments')->post(route('dashboard.users.attachments.store', $user), ['files' => true]) }}
    @component('Template::components.box')
        @slot('title', trans('attachments.actions.create'))

        @include('dashboard.attachments.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('attachments.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
@endcan
