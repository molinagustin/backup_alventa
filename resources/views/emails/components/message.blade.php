@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

<div align="center">
<img src="public\img\alventa_logo.png" style="padding-left: 6.5em;">
<!--Para colocar imagenes. El primer parametro es por si no se visualiza y el segundo es la ruta hacia la imagen-->
<!--![Logo AlVenta][Logo]-->
</div>

# ¡Gracias por registrate!
{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('Todos los derechos reservados.')<br>

Para no recibir más correos de éste sitio, puedes configurarlo a través del siguiente [enlace][link].

[link]: {{ url(config('app.url') . '/home/settings') }}

@endcomponent
@endslot

<!--[Logo]: {{ asset('img\alventa_logo.png') }}-->
@endcomponent