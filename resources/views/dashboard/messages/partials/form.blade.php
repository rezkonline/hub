{{ BsForm::text('title') }}
{{ BsForm::textarea('body') }}
<input type="hidden" name="type" value="{{ \App\Models\Message::NOTICE }}">
