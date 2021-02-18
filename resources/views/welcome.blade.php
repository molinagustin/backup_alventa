@extends('layouts.app')

@section ('tittle', 'Bienvenido a AlVenta')

@section ('body-class', 'landing-page sidebar-collapse')

@section ('styles')
<!--Para las veces que haga falta podemos cargar estilos desde una seccion y se aplicaran en APP.blade-->
  <style>
    .links-paginate{
      display: inline-block;
    }
  </style>
@endsection

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{asset('img/ecommerce2.jpg')}}')">


  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1 class="title">AlVENTA</h1>
        <h4>Compra Venta de nuevos y usados en General Alvear</h4>
        <br>
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" class="btn btn-danger btn-raised btn-lg">
          <i class="fa fa-play"></i> ¿Cómo Funciona?
        </a>
      </div>
    </div>
  </div>


</div>

<div class="main main-raised">


  <div class="container">
    <div class="section text-center">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <h2 class="title">¿Por qué AlVenta?</h2>

          <h5 class="description">Porque facilita tus compras a los comercios locales, unificando en un solo sitio todo aquello que quieres vender, comprar u ofrecer, dejando de
            visitar cientos de grupos distintos. </h5>
        </div>
      </div>
      <div class="features">
        <div class="row">
          <div class="col-md-4">
            <div class="info">
              <div class="icon icon-info">
                <i class="material-icons">chat</i>
              </div>
              <h4 class="info-title">Pregúntanos</h4>
              <p>Cualquier duda que tengas, está disponible nuestro chat o formulario de contacto. Nuestros agentes están disponibles las 24 horas.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="info">
              <div class="icon icon-success">
                <i class="material-icons">verified_user</i>
              </div>
              <h4 class="info-title">Pago Seguro</h4>
              <p>Usamos Mercado Pago como plataforma de pago, por lo que tus transacciones cuentan con un alto nivel de seguridad y respaldo. Si no
                confías en los pagos online, puedes acordar con el vendedor y pagar al momento de recibir el producto.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="info">
              <div class="icon icon-danger">
                <i class="material-icons">fingerprint</i>
              </div>
              <h4 class="info-title">Información Privada</h4>
              <p>Los pedidos que realices solo los conocerás tú y tu vendedor. Nadie más tiene acceso a esta información.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section text-center">
      <h2 class="title">Productos Disponíbles</h2>
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
                  <br>
                  <small class="card-description text-muted">{{$product->category->name}}</small>
                </h4>
                <div class="card-body">
                  <p class="card-description">{{$product -> description}}</p>
                </div>
               
              </div>
            </div>
          </div>

          @endforeach
        </div>

        <div class="row links-paginate"> <!--Tambien se puede aplicar el estilo text-center solamente ya que no es necesario el row, pero lo dejo para ocular la seccion STYLE de la parte superior-->
          {{ $products->links() }}
        </div>

      </div>
    </div>
    <div class="section section-contacts">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <h2 class="text-center title">¿Dudas? Contáctanos</h2>
          <h4 class="text-center description">No hace falta que cuentes con un usuario para preguntarnos, pero si te registras podrás acceder al chat en línea con uno de nuestros agentes.</h4>
          <form class="contact-form">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Nombre</label>
                  <input type="email" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Correo Electrónico</label>
                  <input type="email" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleMessage" class="bmd-label-floating">Tu Mensaje</label>
              <textarea type="email" class="form-control" rows="4" id="exampleMessage"></textarea>
            </div>
            <div class="row">
              <div class="col-md-4 ml-auto mr-auto text-center">
                <button class="btn btn-primary btn-raised">
                  Enviar Mensaje
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


</div>

@include('includes.footer')

@endsection