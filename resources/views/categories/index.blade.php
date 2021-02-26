@extends('layouts.app')

@section ('tittle', 'AlVenta | Categorías Disponibles')

@section ('body-class', 'profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{asset('img/ecommerce2.jpg')}}')">

</div>

<div class="main main-raised">
    <div class="container">
        <div class="section text-center">


            <h2 class="title">Categorías Disponibles</h2>
            <br>

            <div class="col-md-4 offset-4">
                <form method="get" action="{{ url('/search') }}" target="_blank">

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">search</i>
                        </span>
                        <input type="text" class="form-control text-center" placeholder="¿Qué producto es el que buscas?" name="query" id="search">
                        <button type="submit" class="btn btn_ctm btn-primary">Buscar</button>
                    </div>

                </form>
            </div>

            <div class="team">
                <div class="row">
                    @foreach($categories as $category)

                    <div class="col-md-4">
                        <div class="team-player">
                            <div class="card card-plain">
                                <div class="col-md-6 ml-auto mr-auto">
                                    <img src="{{ asset($category->featured_image_url) }}" alt="Imagen representativa de la categoría {{ $category->name }}" class="img-raised rounded-circle img-fluid">
                                </div>
                                <h4 class="card-title">
                                    <a href="{{ url('/categories/'.$category->id) }}">{{$category -> name}}</a>
                                </h4>
                                <div class="card-body">
                                    <p class="card-description">{{$category -> description}}</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>


@include('includes.footer')

@endsection