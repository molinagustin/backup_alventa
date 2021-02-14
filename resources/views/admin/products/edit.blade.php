@extends('layouts.app')

@section ('tittle', 'Modificacion de Producto')

@section ('body-class', 'profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{asset('img/ecommerce2.jpg')}}')">

</div>

<div class="main main-raised">


  <div class="container">

    <div class="section text-center">
      <h2 class="title">Editar Datos del Producto</h2>

      <form method="post" action="{{url('/admin/products/'.$product->id.'/edit')}}">
        @csrf

        <div class="row">

          <div class="col-sm-6">
            <div class="form-group label-floating">
              <label class="control-label">Nombre del Producto</label>
              <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group label-floating">
              <label class="control-label">Precio</label>
              <input type="number" step="0.01" class="form-control" name="price" value="{{ $product->price }}" required>
            </div>
          </div>

        </div>

        <div class="form-group label-floating">
          <label class="control-label">Breve Descripción del Producto</label>
          <input type="text" class="form-control" name="description" value="{{ $product->description }}" required>
        </div>

        <textarea class="form-control" rows="3" name="long_description" placeholder="Descripción Completa del Producto">{{ $product->long_description }}</textarea>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ url('admin/products') }}" class="btn btn-default">Cancelar</a>
      </form>

    </div>

  </div>
</div>


<footer class="footer footer-default">
  <div class="container">
    <nav class="float-left">
      <ul>
        <li>
          <a href="https://www.creative-tim.com/">
            Creative Tim
          </a>
        </li>
        <li>
          <a href="https://www.creative-tim.com/presentation">
            About Us
          </a>
        </li>
        <li>
          <a href="https://www.creative-tim.com/blog">
            Blog
          </a>
        </li>
        <li>
          <a href="https://www.creative-tim.com/license">
            Licenses
          </a>
        </li>
      </ul>
    </nav>
    <div class="copyright float-right">
      &copy;
      <script>
        document.write(new Date().getFullYear())
      </script>, made with <i class="material-icons">favorite</i> by
      <a href="https://www.creative-tim.com/" target="_blank">Creative Tim</a> for a better web.
    </div>
  </div>
</footer>
@endsection