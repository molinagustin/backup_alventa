<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Nuevo Pedido</title>
</head>

<body>
    <p>Se ha realizado un nuevo pedido!</p>
    <p>Estos son los datos del cliente:</p>
    <ul>
        <li>
            <strong>Nombre:</strong>
            {{ $user->name }}
        </li>
        <li><strong>Correo Electrónico:</strong>
            {{ $user->email }}
        </li>
        <li><strong>Fecha del Pedido:</strong>
            {{ $cart->order_date }}
        </li>
    </ul>

    <hr>
    <p>Detalles del pedido:</p>
    <ul>
        @foreach($cart->details as $detail)
        <li>
        <strong>{{ $detail->product->name }}</strong> x {{ $detail->quantity }} = <strong> ($ {{ $detail->quantity * $detail->product->price }})</strong>
        </li>
        @endforeach
    </ul>

    <p>
    <strong>El importe total a pagar es: </strong> $ {{ $cart->total }}
    </p>
    <hr>

    <!--Por medio del enlace llevamos al administrador a las ordenes particulares que posee ese carro de compras-->
    <p> <a href=" {{ url('/admin/orders/' . $cart->id) }}">Haz click aquí</a> para ver mas información sobre el pedido.</p>
</body>

</html>