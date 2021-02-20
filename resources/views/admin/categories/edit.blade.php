@extends('layouts.app')

@section ('tittle', 'Editar Categoría')

@section ('body-class', 'profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{asset('img/ecommerce3.jpg')}}')">

</div>

<div class="main main-raised">


  <div class="container">

    <div class="section">
      <h2 class="title text-center">Editar Datos de la Categoría</h2>
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
      <form method="post" action="{{url('/admin/categories/'.$category->id.'/edit')}}">
        @csrf

        <div class="row">

          <div class="col-sm-6">
            <div class="form-group label-floating">
              <label class="control-label">Nombre de la Categoría</label>
              <input type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}">
            </div>
          </div>

        </div>

        <textarea class="form-control" rows="3" name="description" placeholder="Descripción de la Categoría">{{ old('description', $category->description) }}</textarea>

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