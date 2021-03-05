@extends('layouts.app')

@section ('tittle', 'Tramitación de Orden Pedido')

@section ('body-class', 'profile-page sidebar-collapse')

@section('styles')
<style>
  .itemLista {
  border: 1px solid rgba(0,0,0,.125);
  border-right: 0;
  border-left: 0; 
  border-top:0;
  }

</style>
@endsection

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{asset('img/ecommerce2.jpg')}}')">
</div>

<div class="main main-raised">

  <div class="container">

    <div class="section">
      <h2 class="title text-center">Detalles del Pedido # {{ $order->id }}</h2>
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

      @if (session('notification'))
      <div class="alert alert-success" role="alert">
        {{ session('notification') }}
      </div>
      @endif

      <div class="row">
        <div class="col-sm-6">
          <h4 class="title text-center">Datos del Cliente</h4>
          <ul class="list-group">
            <li class="list-group-item itemLista">Nombre de Usuario: {{ $order->user->name }}</li>
            <li class="list-group-item itemLista">Email: {{ $order->user->email }}</li>
            <li class="list-group-item itemLista">Teléfono: {{ $order->user->phone }}</li>
            <li class="list-group-item itemLista">Dirección: {{ $order->user->address }}</li>
          </ul>
        </div>

        <div class="col-sm-6">
          <h4 class="title text-center">Datos del Pedido</h4>
          <ul class="list-group">
            <li class="list-group-item itemLista">Fecha Pedido: {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y H:i:s') }}</li>
            <li class="list-group-item itemLista">Fecha Entrega: {{ $order->arrived_date ? \Carbon\Carbon::parse($order->arrived_date)->format('d/m/Y H:i:s') : 'Sin Entregar' }}</li>
            <li class="list-group-item itemLista">Última Modificación: {{ \Carbon\Carbon::parse($order->updated_at)->format('d/m/Y H:i:s') }}</li>
            <li class="list-group-item itemLista">Estado: <span @switch($order->status->status)
                @case('Pending')
                style="text-transform: uppercase;color:#e6b11a;"
                @break

                @case('Approved')
                style="text-transform: uppercase;color:#00c700;"
                @break

                @case('Cancelled')
                style="text-transform: uppercase;color:red;"
                @break

                @case('Finished')
                style="text-transform: uppercase;color:#007ec7;"
                @break

                @default
                style="text-transform: uppercase;"
                @endswitch>{{ $order->status->status }}</span></li>
          </ul>
        </div>
      </div>      

      <h4 class="title text-center">Datos de los Productos</h4>

      <form method="post" action="{{url('/admin/orders/'.$order->id.'/edit')}}">
        @csrf

        <div class="row">
          <table class="table">
            <thead>

              <tr>
                <th class="text-center">Imagen</th>
                <th class="col-auto text-center">Nombre</th>
                <th class="text-right">Precio</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Sub Total</th>
                <th class="text-center">Opciones</th>
              </tr>

            </thead>

            <tbody>

              @foreach($order->details as $detail)
              <tr>
                <td class="text-center">
                  <img src="{{$detail->product->featured_image_url}}" width="50" height="50">
                </td>

                <td class="text-center">
                  <a href="{{ url('/products/'. $detail->product->id) }}" target="_blank">{{$detail->product->name}}</a>
                </td>

                <td class="text-right">&dollar; {{$detail->product->price}}</td>

                <td class="text-center">{{ $detail->quantity }}</td>

                <td class="text-center">&dollar; {{ $detail->quantity * $detail->product->price }}</td>

                <td class="td-actions text-center">
                  <a href="{{ url('/products/'. $detail->product->id) }}" target="_blank" rel="tooltip" data-placement="right" title="Ver Detalles" class="btn btn-info btn-simple btn-xs">
                    <i class="fa fa-info-circle"></i>
                  </a>
                </td>
              </tr>
              @endforeach
              <tr>
                <td class="text-right"><b>TOTAL A PAGAR</b></td>
                <td> </td>
                <td></td>
                <td></td>
                <td class="text-center"><b>$ {{ $order->total }}</b></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>

        <hr>

        <!--Hace una comparacion de negacion en un arreglo, verifica que el primer parametro no sea ninguno de los parametros del segundo array-->
        @if(!in_array($order->status->status, ['Cancelled', 'Finished']))
        <div class="row">
          <div class="col-sm-3 offset-3">
            <div class="form-group label-floating">
              <label class="control-label">Estado del Pedido</label>
              <select class="form-control" name="status_id" onChange="mostrarDateTimePicker(this.value);" style="text-transform: uppercase;">
                @foreach ($statuses as $status)
                <option @switch($status->status)
                  @case('Pending')
                  style="color:#e6b11a;"
                  @break

                  @case('Approved')
                  style="color:#00c700;"
                  @break

                  @case('Cancelled')
                  style="color:red;"
                  @break

                  @case('Finished')
                  style="color:#007ec7;"
                  @break
                  @endswitch
                  value="{{$status->id}}" @if ($status->id == old('id', $order->status_id)) selected @endif>{{ $status->status }}
                </option>
                @endforeach
              </select>
            </div>
          </div>         

          <div class="col-sm-3" id="arrived_date_picker" style="display: none;">
            <div class="form-group label-floating">
              <label class="control-label">Fecha de Entrega:</label>
              <input type="datetime-local" class="form-control" name="arrived_date">
            </div>
          </div>
        </div>

        <textarea class="form-control" rows="2" name="observation" placeholder="Observaciones">{{ old('observation', $order->observations) }}</textarea>

        <div class="text-center">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <a href="{{ url('admin/orders') }}" class="btn btn-default">Cancelar</a>
        </div>
      </form>

      @else
      <textarea readonly class="form-control" rows="2" name="observation" placeholder="Observaciones">{{ old('observation', $order->observations) }}</textarea>

      <div class="text-center">
        <a href="{{ url('admin/orders') }}" class="btn btn-default">Volver</a>
      </div>
      @endif

    </div>

  </div>
</div>

@include('includes.footer')

<script>
  function mostrarDateTimePicker(status) {
    if (status == "5")
      $("#arrived_date_picker").show();
    else
      $("#arrived_date_picker").hide();
  }
</script>
@endsection