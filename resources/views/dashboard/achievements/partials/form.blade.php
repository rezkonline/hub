{{ BsForm::text('title') }}
{{ BsForm::number('value') }}
<input value="{{ is_object($user) ? $user->id : $user }}" type="hidden" name="customer_id">
