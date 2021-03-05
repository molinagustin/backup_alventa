@extends('layouts.app')

@section ('tittle', 'Agregar Categoría')

@section ('body-class', 'profile-page sidebar-collapse')

@section ('styles')
<style>
  .inputImage {
    display: inline-block;
    width: 100%;
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
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
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
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{asset('img/ecommerce3.jpg')}}')">

</div>

<div class="main main-raised">


  <div class="container">

    <div class="section ">
      <h2 class="title text-center">Registrar Nueva Categoría</h2>
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
      <form method="post" action="{{url('/admin/categories')}}" enctype="multipart/form-data">
        @csrf

        <div class="row">

          <div class="col-sm-6">
            <div class="form-group label-floating">
              <label class="control-label">Nombre de la Categoría</label>
              <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
          </div>

          <div class="col-sm-6">
            <div class="label-floating">
              <label class="control-label">Imagen de la Categoría</label>
            </div>
            <input type="file" class="inputImage" name="image">
          </div>

        </div>

        <textarea class="form-control" rows="3" name="description" placeholder="Descripción de la Categoría">{{ old('description') }}</textarea>

        <div class="text-center">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <a href="{{ url('admin/categories') }}" class="btn btn-default">Cancelar</a>
        </div>
      </form>

    </div>

  </div>
</div>

@include('includes.footer')

@endsection