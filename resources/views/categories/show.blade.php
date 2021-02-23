@extends('layouts.app')

@section ('tittle', 'AlVenta | Productos por Categoría')

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
                            <img src="{{ $category->featured_image_url }}" alt="Imagen representativa de la categoría {{ $category->name }}" class="img-raised rounded-circle img-fluid">
                        </div>
                        <div class="name">
                            <h3 class="title">{{ $category->name }}</h3>
                            <a href="#pablo" class="btn btn-just-icon btn-link btn-dribbble"><i class="fa fa-dribbble"></i></a>
                            <a href="#pablo" class="btn btn-just-icon btn-link btn-twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#pablo" class="btn btn-just-icon btn-link btn-pinterest"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="description text-center">
                <p>{{ $category->description }}</p>
            </div>

            @if (session('notification'))
            <div class="alert alert-success" role="alert">
                {{ session('notification') }}
            </div>
            @endif

            <div class="section text-center">
                <div class="team">
                    <div class="row">
                        @foreach($products as $product)

                        <div class="col-md-4">
                            <div class="team-player">
                                <div class="card card-plain">
                                    <div class="col-md-6 ml-auto mr-auto">
                                        <img src="{{ asset($product->featured_image_url) }}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
                                    </div>
                                    <h4 class="card-title">
                                        <a href="{{ url('/products/'.$product->id) }}">{{$product -> name}}</a>
                                    </h4>
                                    <div class="card-body">
                                        <p class="card-description">{{$product -> description}}</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>

                    <div class="links-paginate">
                        <!--Tambien se puede aplicar el estilo text-center solamente ya que no es necesario el row, pero lo dejo para ocular la seccion STYLE de la parte superior-->
                        {{ $products->links() }}
                    </div>

                </div>


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
                    <input type="number" name="quantity" value="1" min="1">
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