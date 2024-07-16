@bsMultilangualFormTabs
    {{ BsForm::text('name') }}
    {{ BsForm::textarea('description') }}
@endBsMultilangualFormTabs

{{ BsForm::number('duration') }}

<label>@lang('meetings.attributes.start_at')</label>
<flat-pickr
    placeholder="@lang('meetings.attributes.start_at')"
    :config="{{ json_encode(['enableTime' => true]) }}"
    value="{{ old('start_at', isset($meeting) ? $meeting->start_at->format('Y-m-d H:i') : null) }}"
    name="start_at"
    class="form-control"
></flat-pickr>

<select2
    name="customers[]"
    id="customers"
    :multiple="true"
    :value="{{ json_encode(old('customers', isset($user) ? $user->customers->pluck('id')->toArray() : [])) }}"
    label="@lang('customers.plural')"
    remote-url="{{ route('api.customers.select') }}">
</select2>
