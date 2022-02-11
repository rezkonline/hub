@can('create', [\App\Models\Achievement::class, $user])
    {{ BsForm::resource('achievements')->post(route('dashboard.users.achievements.store', $user)) }}
    @component('Template::components.box')
        @slot('title', trans('achievements.actions.create'))

        @include('dashboard.achievements.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('achievements.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
@endcan
