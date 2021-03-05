@component('emails.components.message')

@component('mail::panel')
Hola {{ $user->name }}, bienvenido/a a **AlVenta**, el sitio que hará tus compras y ventas mucho mas fáciles. Cualquier duda que tenga, nuestro personal está a su disposición en todo momento, no dude en consultarnos.

Por el momento necesitamos que **confirme su dirección de correo electrónico** a través del siguiente enlace:
@endcomponent

@component('mail::button', ['url' => $email_confirmation_url])
Confirmar Email
@endcomponent

<div align="center">
Sin más, lo saludamos muy atentamente desde <b>{{ config('app.name') }}</b>
</div>
@endcomponent
