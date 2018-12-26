@extends('layouts.master')
@section('contenido')
<h1 class="text-center">Listado Ingesos</h1>
<div class="container">
<a class="btn btn-info mb-3"  href="{{route('ingresos.create')}}">Agregar Ingreso</a>
<div>
@include('compras.ingresos.search')
</div>
<div class="table-responsive">
<table class="table">
  <thead class="thead-dark">
    <tr>

      <th scope="col">Fecha</th>
      <th scope="col">Proveedor</th>
      <th scope="col">Comprobante</th>
      <th scope="col">Impuesto</th>
      <th scope="col">Total</th>
      <th scope="col">Estado</th>
      <th scope="col" colspan="2" >Acciones</th>
    </tr>
  </thead>
  <tbody>
  @foreach($ingresos as $ing)
    <tr>
      <td>{{$ing->fecha_hora}}</td>
      <td>{{$ing->nombre}}</td>
      <td>{{$ing->tipo_comprobante.':'.$ing->serie_comprobante.'-'.$ing->num_comprobante}}</td>
      <td>{{$ing->impuesto}}</td>
      <td>{{$ing->total}}</td>
      <td>{{$ing->estado}}</td>
      <td>
      <a href="{{route('ingresos.show', $ing->idingreso)}}">
      <button class="btn-sm btn-info">Detalles</button>
      </a>
      </td>
      <td>
      <form action="{{route('ingresos.destroy',$ing->idingreso)}}"method="POST">
      @csrf
      @method('DELETE')
     
      <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Quiere Anular este Ingreso?')">Anular<i class="far fa-trash-alt"></i></button>
    </form>
      </td>
    </tr>
   @endforeach
  </tbody>
{{$ingresos->links()}}
</table>
</div>
</div>
@endsection