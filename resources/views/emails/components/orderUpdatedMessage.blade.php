@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

<div align="center">
<img src="'{{ asset('img\alventa_logo.png') }}'" style="padding-left: 6.5em;">
</div>

# El estado de tu pedido fue actualizado
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

@endcomponent