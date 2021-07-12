@component('mail::message')
# Benvenuto nel servizio di mailing e autenticazione!

Prova body message.

@component('mail::button', ['url' => 'https://laravel.com/docs/8.x/installation'])
Visita il sito
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
