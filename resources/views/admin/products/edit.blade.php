@extends('layouts.app')

@section ('tittle', 'Modificacion de Producto')

@section ('body-class', 'profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{asset('img/ecommerce2.jpg')}}')">

</div>

<div class="main main-raised">


  <div class="container">

    <div class="section">
      <h2 class="title text-center">Editar Datos del Producto</h2>
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
          <li>
            {{$error}}
          </li>
          @endforeach
        </ul>
      </div>
      @endif
      <form method="post" action="{{url('/admin/products/'.$product->id.'/edit')}}">
        @csrf

        <div class="row">

          <div class="col-sm-6">
            <div class="form-group label-floating">
              <label class="control-label">Nombre del Producto</label>
              <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}" >
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group label-floating">
              <label class="control-label">Precio</label>
              <input type="number" step="0.01" class="form-control" name="price" value="{{ old('price', $product->price) }}" >
            </div>
          </div>

        </div>

        <div class="form-group label-floating">
          <label class="control-label">Breve Descripción del Producto</label>
          <input type="text" class="form-control" name="description" value="{{ old('description', $product->description) }}" >
        </div>

        <textarea class="form-control" rows="3" name="long_description" placeholder="Descripción Completa del Producto">{{ old('long_description', $product->long_description) }}</textarea>
        <div class="text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ url('admin/products') }}" class="btn btn-default">Cancelar</a>
        </div>
      </form>

    </div>

  </div>
</div>

@include('includes.footer')

@endsection