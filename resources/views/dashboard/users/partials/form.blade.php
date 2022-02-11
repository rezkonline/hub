{{ BsForm::image('avatar')->collection('avatar')->files(isset($user) ? $user->getMediaResource('avatar') : null) }}
{{ BsForm::text('name') }}
{{ BsForm::email('email') }}
{{ BsForm::text('phone') }}
{{ BsForm::password('password') }}
{{ BsForm::password('password_confirmation') }}

@if($resource == Str::plural(\App\Models\User::CUSTOMER_TYPE))
    @if(auth()->user()->isAdmin())
        {{ BsForm::select('settings[]', trans('customers.settings'))->attribute('class', 'select2bs4 form-control')->multiple()->value(isset($user) ? $user->getActiveSettings() : '') }}
    @endif
    <div class="additional" data-type="{{ \App\Models\User::CUSTOMER_TYPE }}">
        <select2
            name="country_id"
            id="country_id"
            value="{{ old('country_id', isset($user) ? $user->country_id : null) }}"
            label="@lang('countries.singular')"
            remote-url="{{ route('api.countries.select') }}"></select2>
        <select2
            name="city_id"
            id="city_id"
            value="{{ old('city_id', isset($user) ? $user->city_id : null) }}"
            label="@lang('cities.singular')"
            remote-url="{{ route('api.cities.select') }}"></select2>
        <select2
            name="manager_id"
            id="manager_id"
            value="{{ old('manager_id', isset($user) ? $user->manager_id : null) }}"
            label="@lang('supervisors.singular')"
            remote-url="{{ route('api.supervisors.select') }}"></select2>
        <select2
            name="employee_id[]"
            id="employee_id"
            :multiple="true"
            :value="{{ json_encode(old('employee_id', isset($user) ? $user->employees->pluck('id')->toArray() : [])) }}"
            label="@lang('employees.plural')"
            remote-url="{{ route('api.employees.select') }}"></select2>
    </div>
@endif
<input type="hidden" name="type" value="{{ request()->query('type', 'customer') }}">