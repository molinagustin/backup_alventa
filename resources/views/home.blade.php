@extends('layouts.app')

@section ('tittle', 'AlVenta | Dashboard')

@section ('body-class', 'profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{asset('img/ecommerce.jpg')}}')">

</div>

<div class="main main-raised">


    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Dashboard</h2>

            @if (session('notification'))
            <div class="alert alert-success" role="alert">
                {{ session('notification') }}
            </div>
            @endif

            <ul class="nav nav-pills nav-pills-success nav-pills-icons" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $cart ? '' : 'active' }}" href="#dashboard" role="tab" data-toggle="tab">
                        <i class="material-icons">dashboard</i>
                        Resumen
                    </a>
                </li>
                <li class="nav-item">

                    <a class="nav-link {{ $cart ? 'active' : '' }}" href="#shopping_cart" role="tab" data-toggle="tab">
                        <i class="material-icons">shopping_cart</i>
                        Carro de Compras
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#orders" role="tab" data-toggle="tab">
                        <i class="material-icons">list</i>
                        Pedidos Realizados
                    </a>
                </li>
            </ul>
            <div class="tab-content tab-space">
                <div class="tab-pane {{ $cart ? '' : 'active' }}" id="dashboard">

                </div>

                <div class="tab-pane {{ $cart ? 'active' : '' }}" id="shopping_cart">
                    <hr>
                    <p>Tienes <b>{{ auth()->user()->cart->details->count() }}</b> productos en tu carro de compras.</p>
                    <table class="table">
                        <thead>

                            <tr>
                                <th class="text-center">Imagen</th>
                                <th class="col-auto text-center">Nombre</th>
                                <th class="text-right">Precio</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Sub Total</th>
                                <th class="text-center">Opciones</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach(auth()->user()->cart->details as $detail)
                            <tr>
                                <td class="text-center">
                                    <img src="{{$detail->product->featured_image_url}}" width="50" height="50">
                                </td>

                                <td class="text-center">
                                    <a href="{{ url('/products/'. $detail->product->id) }}" target="_blank">{{$detail->product->name}}</a>
                                </td>

                                <td class="text-right">&dollar; {{$detail->product->price}}</td>

                                <td class="text-center">{{ $detail->quantity }}</td>

                                <td class="text-center">&dollar; {{ $detail->quantity * $detail->product->price }}</td>

                                <td class="td-actions text-center">

                                    <form method="post" action="{{ url('/cart') }}">
                                        @csrf
                                        @method('DELETE')
                                        <!--<input type="hidden" name="_method" value="DELETE">
                    el @method('DELETE') es equivalente al INPUT HIDDEN-->

                                        <input type="hidden" name="cart_detail_id" value="{{ $detail->id }}">

                                        <a href="{{ url('/products/'. $detail->product->id) }}" target="_blank" rel="tooltip" data-placement="right" title="Ver Detalles" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-info-circle"></i>
                                        </a>

                                        <button type="submit" rel="tooltip" data-placement="right" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                    @if(auth()->user()->cart->total > 0)
                    <p><b>Importe total a pagar: </b> $ {{ auth()->user()->cart->total }}</p>

                    <form method="post" action="{{ url('/order') }}">
                        @csrf
                        <div class="text-center">
                            <button class="btn btn-primary btn-round">
                                <i class="material-icons">local_shipping</i> Realizar Pedido
                            </button>
                        </div>
                    </form>
                    @endif

                </div>

                <div class="tab-pane" id="orders">
                    <h3 class="title">Compras</h3>

                    <div class="row">
                        @foreach($carts as $cart)
                        @foreach($cart->details as $detail)
                        <div class="col-md-4">
                            <div class="card" style="width: 28rem; margin-top:30px;">
                                <img class="card-img-top" src="{{ $detail->product->featured_image_url }}" alt="Imagen de Producto Comprado" height="400px" >
                                <div class="card-body text-center" style="min-height: 150px;">
                                    <h5 class="card-title">{{ $detail->product->name }}</h5>
                                    <p class="card-text">{{ $detail->product->description }}</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <li class="list-group-item">N° de Orden:</li>
                                            <li class="list-group-item">Cantidad Comprada:</li>
                                            <li class="list-group-item">Precio por Unidad:</li>
                                            <li class="list-group-item">Fecha de Pedido:</li>
                                            <li class="list-group-item">Estado:</li>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <b>
                                                <li class="list-group-item">{{ $cart->id }}</li>
                                                <li class="list-group-item">{{ $detail->quantity }} {{ $detail->quantity > 1 ? 'Unidades' : 'Unidad' }}</li>
                                                <li class="list-group-item">$ {{ $detail->product->price }}</li>
                                                <li class="list-group-item">{{ \Carbon\Carbon::parse($cart->order_date)->format('d/m/Y H:i:s') }}</li>
                                                <li class="list-group-item" style="text-transform: uppercase;">{{ $cart->status->status }}</li>
                                            </b>
                                        </div>
                                    </div>

                                </ul>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 text-center"><a href="{{ url('/products/' . $detail->product->id) }}" target="_blank" class="card-link" style="color: #3c8486d6; font-weight:bold;"> VER PRODUCTO </a></div>

                                        <div class="col-sm-6 text-center"><a href="{{ url('#') }}" class="card-link" style="color: #3c8486d6; font-weight:bold;"> CONTACTAR ADMIN </a></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endforeach
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

@include('includes.footer')

@endsection