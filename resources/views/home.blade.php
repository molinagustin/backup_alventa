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
                    <a class="nav-link active" href="#dashboard" role="tab" data-toggle="tab">
                        <i class="material-icons">dashboard</i>
                        Resumen
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#shopping_cart" role="tab" data-toggle="tab">
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
                <div class="tab-pane active" id="dashboard">

                </div>

                <div class="tab-pane" id="shopping_cart">
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
                    @endif

                    <form method="post" action="{{ url('/order') }}">
                        @csrf
                        <div class="text-center">
                            <button class="btn btn-primary btn-round">
                                <i class="material-icons">local_shipping</i> Realizar Pedido
                            </button>
                        </div>
                    </form>

                </div>

                <div class="tab-pane" id="orders">

                </div>

            </div>

        </div>

    </div>
</div>

@include('includes.footer')

@endsection