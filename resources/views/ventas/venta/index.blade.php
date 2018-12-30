@extends('layouts.master')
@section('contenido')
<h1 class="text-center">Listado Ventas</h1>
<div class="container">
<a class="btn btn-info mb-3"  href="{{route('venta.create')}}">Agregar Venta</a>
<div>
@include('ventas.venta.search')
</div>
<div class="table-responsive">
<table class="table">
  <thead class="thead-dark">
    <tr>

      <th scope="col">Fecha</th>
      <th scope="col">Cliente</th>
      <th scope="col">Comprobante</th>
      <th scope="col">Impuesto</th>
      <th scope="col">Total</th>
      <th scope="col">Estado</th>
      <th scope="col" colspan="2" >Acciones</th>
    </tr>
  </thead>
  <tbody>
  @foreach($ventas as $ven)
    <tr>
      <td>{{$ven->fecha_hora}}</td>
      <td>{{$ven->nombre}}</td>
      <td>{{$ven->tipo_comprobante.':'.$ven->serie_comprobante.'-'.$ven->num_comprobante}}</td>
      <td>{{$ven->impuesto}}</td>
      <td>{{$ven->total_venta}}</td>
      <td>{{$ven->estado}}</td>
      <td>
      <a href="{{route('venta.show', $ven->idventa)}}">
      <button class="btn-sm btn-info">Detalles</button>
      </a>
      </td>
      <td>
      <form action="{{route('venta.destroy',$ven->idventa)}}"method="POST">
      @csrf
      @method('DELETE')
     
      <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Quiere Anular esta Venta?')">Anular<i class="far fa-trash-alt"></i></button>
    </form>
      </td>
    </tr>
   @endforeach
  </tbody>
{{$ventas->links()}}
</table>
</div>
</div>
@endsection