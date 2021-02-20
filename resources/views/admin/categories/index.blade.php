@extends('layouts.app')

@section ('tittle', 'Listado de Categorías')

@section ('body-class', 'profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{asset('img/ecommerce4.jpg')}}')">
</div>

<div class="main main-raised">

  <div class="container">

    <div class="section text-center">
      <h2 class="title">Listado de Categorías</h2>

      <div class="team">

        <div>
          <!--Por medio del objeto que viene con los datos de la base de datos, generamos los links para las paginas-->
          {{ $categories -> links()}}
        </div>

        <a href="{{url('/admin/categories/create')}}" class="btn btn-primary btn-round">Agregar Categoría</a>

        <div class="row">
          <table class="table">
            <thead>

              <tr>
                <th class="text-center">#</th>
                <th class="col-auto">Nombre</th>
                <th class="col-auto">Descripción</th>
                <th class="text-center">Opciones</th>
              </tr>

            </thead>

            <tbody>
              @foreach ($categories as $category)
              <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->description}}</td>
                <td class="td-actions text-center">

                  <form method="post" action="{{ url('/admin/categories/'.$category->id) }}">
                    @csrf
                    @method('DELETE')
                    <!--<input type="hidden" name="_method" value="DELETE">
                    el @method('DELETE') es equivalente al INPUT HIDDEN-->

                    <a href="" rel="tooltip" data-placement="right" title="Ver Detalles" class="btn btn-info btn-simple btn-xs">
                      <i class="fa fa-info-circle"></i>
                    </a>
                    <a href="{{ url('/admin/categories/'.$category->id.'/edit') }}" rel="tooltip" data-placement="right" title="Editar Categoría" class="btn btn-success btn-simple btn-xs">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{ url('/admin/categories/'.$category->id.'/images') }}" rel="tooltip" data-placement="right" title="Imágenes para la Categoría" class="btn btn-warning btn-simple btn-xs">
                      <i class="fa fa-image"></i>
                    </a>

                    <button type="submit" rel="tooltip" data-placement="right" title="Eliminar Categoría" class="btn btn-danger btn-simple btn-xs">
                      <i class="fa fa-times"></i>
                    </button>
                  </form>
                  
                </td>
              </tr>
              @endforeach
            </tbody>

          </table>

        </div>

        <div>
          <!--Por medio del objeto que viene con los datos de la base de datos, generamos los links para las paginas-->
          {{ $categories -> links()}}
        </div>

      </div>
    </div>

  </div>


</div>


@include('includes.footer')

@endsection