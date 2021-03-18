@extends('layouts.app')

@section ('tittle', 'AlVenta | Detalles Producto')

@section ('body-class', 'profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{asset('img/ecommerce.jpg')}}')">
</div>

<div class="main main-raised">
    <div class="profile-content">
        <div class="container">

            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="profile">
                        <div class="avatar">
                            <img src="{{ $product->featured_image_url }}" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                        </div>
                        <div class="name">
                            <h3 class="title">{{ $product->name }}</h3>
                            <h3 class="title">$ {{ $product->price }}</h3>
                            <h6>{{ $product->category->name }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="description text-center">
                <p>{{ $product->long_description }}</p>
            </div>

            @if (session('notification'))
            <div class="alert alert-success" role="alert">
                {{ session('notification') }}
            </div>
            @endif

            <div class="tab-content tab-space">

                <div class="tab-pane active text-center gallery">
                    <div class="row">
                        <div class="col-md-3 ml-auto">
                            @foreach($imagesLeft as $image)
                            <img src="{{ $image->url }}" class="rounded" width="250" height="250">
                            @endforeach
                        </div>
                        <div class="col-md-3 mr-auto">
                            @foreach($imagesRight as $image)
                            <img src="{{ $image->url }}" class="rounded" width="250" height="250">
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-center">
                <!-- data-toggle y data-target son lo que enlazan el boton con el div modal -->
                <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#modalAddToCart"><i class="material-icons">add_shopping_cart</i>Agregar al Carro</button>
                <a href="{{url('/categories/' . $product->category->id)}}" class="btn btn-default btn-round">Volver</a>
            </div>

            <div class="card-footer justify-content-center text-center">
                <a href="#" class="btn btn-link btn-just-icon"><i class="fa fa-twitter"></i></a>
                <a href="#" class="btn btn-link btn-just-icon"><i class="fa fa-instagram"></i></a>
                <a href="#" class="btn btn-link btn-just-icon"><i class="fa fa-facebook-square"></i></a>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAddToCart" tabindex="-1" role="dialog" aria-labelledby="modalAddToCartHeader" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalAddToCartHeader">Seleccione la cantidad a comprar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="{{ url('/cart') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="modal-body">
                    <h6>Cantidad</h6>
                    <input type="number" name="quantity" value="1" min="1" step="1" oninput="validity.valid||(value='1');" onpress="isNumber(event);" required>
                    <button type="submit" class="btn btn-success">Añadir</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>

                <!-- <div class="modal-footer">
                </div> -->
            </form>

        </div>
    </div>
</div>

@include('includes.footer')

@endsection
@section('js_scripts')
<script>
    // this prevents from typing non-number text, including "e".
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        let charCode = (evt.which) ? evt.which : evt.keyCode;
        if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
            evt.preventDefault();
        } else {
            return true;
        }
    }
</script>
@endsection