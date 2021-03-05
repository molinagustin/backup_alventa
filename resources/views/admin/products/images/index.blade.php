@extends('layouts.app')

@section ('tittle', 'Imágenes del Producto')

@section ('body-class', 'profile-page sidebar-collapse')

@section ('styles')
<style>
  .inputImage {
    display: inline-block;
    width: 40%;
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    appearance: none;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    font-family: inherit;
  }

  .inputImage[type=file]:not(:disabled):not([readonly]) {
    cursor: pointer;
  }

  .inputImage[type=file] {
    overflow: hidden;
  }
</style>
@endsection

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{asset('img/ecommerce2.jpg')}}')">
</div>

<div class="main main-raised">


  <div class="container">

    <div class="section text-center">
      <h2 class="title">Imágenes de {{ $product->name }}</h2>

      <div class="row">
        @foreach($images as $image)
        <div class="col-md-4" style="padding-bottom: 20px; padding-top: 20px;">
          <div class="panel panel-default">
            <div class="panel-body">
              <!--url es un campo calculado, que se definio en el modelo de ProductImage a traves de getUrlAttribute-->
              <img src="{{ $image->url }}" width="250" height="250">
              <br>
              <form method="post" action="">
                @csrf
                @method('DELETE')
                <!--Se crea un input hidden para guardar y enviar el valor del ID de la imagen seleccionada-->
                <input type="hidden" name="image_id" value="{{ $image->id }}">
                @if ($image->featured)
                <button type="button" class="btn btn-info btn-round" rel="tooltip" title="Imagen Destacada">
                  <i class="material-icons">favorite</i>
                </button>
                @else
                <a href="{{ url('/admin/products/'. $product->id .'/images/select/'.$image->id) }}" class="btn btn-primary btn-fab btn-round">
                  <i class="material-icons">favorite</i>
                </a>
                @endif
                <button type="submit" class="btn btn-danger btn-fab btn-round"><i class="fa fa-times"></i></button>
              </form>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <hr>

      <!--Por defecto un ACTION vacio utiliza la misma ruta donde se encuentra el form. En este caso admin/products/{$id}/images-->
      <form method="post" action="" enctype="multipart/form-data">
        <!--En el formulario para subir imagenes debe tener ese atributo ENCTYPE para habilitarlo-->
        @csrf

        <div class="mb-3">
          <input type="file" class="inputImage" name="photo" required>
        </div>
        <button type="submit" class="btn btn-primary btn-round">Subir Imágen</button>
        <a href="{{url('/admin/products')}}" class="btn btn-default btn-round">Volver</a>
      </form>

    </div>

    <!--Muestro si surge algun error-->
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    <br>
    @endif

  </div>


</div>


@include('includes.footer')

@endsection