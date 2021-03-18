@component('emails.components.orderRequestedMessage')
Hola <b>{{$user->name}}</b>, ya recibimos tu pedido #<b>{{$cart->id}}</b> y nuestro equipo está preparandolo para que lo recibas lo antes posible.

Tú orden fue de los siguientes productos:

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cart->details as $detail)
        <tr>
            <td>
                <img src="{{$detail->product->featured_image_url_email}}" width="50" height="50">
            </td>
            <td>
                <a href="{{ url('/products/'. $detail->product->id) }}" target="_blank">{{$detail->product->name}}</a>
            </td>
            <td style="text-align:right;">$ {{$detail->product->price}}</td>
            <td style="text-align:center;">{{ $detail->quantity }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<p>Importe total a pagar: <b>$ {{ $cart->total }}</b><br>
Los mismos serán enviados a: <b>{{ $user->address }}</b></p>



Si hay algún error en el pedido realizado, por favor [contáctanos][link] lo antes posible.

Gracias por confiar en **{{ config('app.name') }}**.

[link]: {{ url(config('app.url') . '/contact') }}
@endcomponent