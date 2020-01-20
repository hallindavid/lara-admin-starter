@component('mail::message')
# Hi {{ $to_name }},

You have been invited to {{ $org_name }} by {{ $from_name }}

Accept the invitation by logging into the {{ config('app.name') }} platform


@component('mail::button', ['url' => config('app.url')])
Open {{ config('app.name') }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
