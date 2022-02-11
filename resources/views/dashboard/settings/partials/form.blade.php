{{ BsForm::text('title', Settings::get('title')) }}
{{ BsForm::text('copyright', Settings::get('copyright')) }}
{{ BsForm::text('facebook', Settings::get('facebook')) }}
{{ BsForm::text('twitter', Settings::get('twitter')) }}
{{ BsForm::text('instagram', Settings::get('instagram')) }}
{{ BsForm::text('youtube', Settings::get('youtube')) }}
{{ BsForm::text('contact_us_link', Settings::get('contact_us_link')) }}

<div class="row">
    <div class="col-md-6">
        {{ BsForm::image('logo')->collection('logo')->files(optional(Settings::instance('logo'))->getMediaResource('logo')) }}
    </div>
    <div class="col-md-6">
        {{ BsForm::image('favicon')->collection('favicon')->files(optional(Settings::instance('favicon'))->getMediaResource('favicon')) }}
    </div>
</div>