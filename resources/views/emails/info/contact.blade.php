@component('emails.components.contactMessage')

@component('mail::panel')
De parte de **{{ $name }}**:<br>
{{ $message }}
@endcomponent

@endcomponent
