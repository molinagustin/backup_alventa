@extends('layouts.app')

@section ('tittle', 'Bienvenido a ' . config('app.name'))

@section ('body-class', 'landing-page sidebar-collapse')

@section ('styles')
<!--Para las veces que haga falta podemos cargar estilos desde una seccion y se aplicaran en APP.blade-->
<style>
  .links-paginate {
    display: inline-block;
  }

  .btn_ctm {
    padding: 5px 5px;
  }

  .tt-query {
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  }

  .tt-hint {
    color: #999
  }

  .tt-menu {
    /* used to be tt-dropdown-menu in older versions */
    width: 422px;
    margin-top: 4px;
    padding: 4px 0;
    background-color: #fff;
    border: 1px solid #ccc;
    border: 1px solid rgba(0, 0, 0, 0.2);
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
  }

  .tt-suggestion {
    padding: 3px 20px;
    line-height: 24px;
  }

  .tt-suggestion.tt-cursor,
  .tt-suggestion:hover {
    color: #fff;
    background-color: #0097cf;

  }

  .tt-suggestion p {
    margin: 0;
  }
</style>
@endsection

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{asset('img/ecommerce2.jpg')}}')">


  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1 class="title">{{ config('app.name') }}</h1>
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

@section('scripts')
<!--	Plugin para el buscador predictivo -->
<script src="{{asset('js\plugins\typeahead.bundle.min.js')}}" type="text/javascript"></script>

<!--Ahora hay que inicializar el script sobre el INPUT con ID search-->
<script>
  $(function() {

    //Se debe inicializar el elemento que se pasa como parametro PRODUCTS que viene a ser la fuente SOURCE (CODIGO COPIADO DESDE EL EJEMPLO PORQUE UTILIZA EL MOTOR DE BUSQUEDA)
    var products = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.whitespace,
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      //Se define un arreglo si queremos una busqueda acotada en determinados elementos
      //local: ['hola', 'prueba1', 'prueba2', 'abcdwq']

      //Como se quiere utilizar una lista de productos que va a cambiar constantemente, se define un objeto JSON y se usa el atributo PREFETCH.
      //Como usamos una base de datos, vamos a generar un objeto JSON a partir de los productos registrados. Es una ruta VER WEB.PHP
      prefetch: '{{ url("/products/json") }}'
    });

    //Se selecciona el objeto con ID SEARCH y se le pasan 2 objetos por parametro.
    $('#search').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
    }, {
      name: 'products',
      source: products
    });
  });
</script>
@endsection