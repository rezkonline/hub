@bsMultilangualFormTabs
{{ BsForm::text('name')->required()->maxLength(255) }}
@endBsMultilangualFormTabs

<select2
    name="country_id"
    id="country_id"
    value="{{ old('country_id', isset($city) ? $city->country_id : null) }}"
    label="@lang('countries.singular')"
    remote-url="{{ route('api.countries.select') }}"></select2>
