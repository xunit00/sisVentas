@extends('layouts.master')
@section('contenido')
<h1 class="text-center">Listado Clientes</h1>
<div class="container">
<a class="btn btn-info mb-3"  href="{{route('cliente.create')}}">Agregar Articulos</a>
<div>
@include('ventas.cliente.search')
</div>
<div class="table-responsive">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Tipo Doc.</th>
      <th scope="col">Numero Doc.</th>
      <th scope="col">Telefono</th>
      <th scope="col">Email</th>
      <th scope="col" colspan="2" >Acciones</th>
    </tr>
  </thead>
  <tbody>
  @foreach($personas as $per)
    <tr>
      <th scope="row">{{$per->idpersona}}</th>
      <td>{{$per->nombre}}</td>
      <td>{{$per->tipo_documento}}</td>
      <td>{{$per->num_documento}}</td>
      <td>{{$per->telefono}}</td>
      <td>{{$per->email}}</td>
      <td>
      <a href="{{route('cliente.edit', $per->idpersona)}}">
      <button class="btn-sm btn-info">Editar</button>
      </a>
      </td>
      <td>
      <form action="{{route('cliente.destroy',$per->idpersona)}}"method="POST">
      @csrf
      @method('DELETE')
     
      <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Quiere borrar este Cliente?')">Eliminar<i class="far fa-trash-alt"></i></button>
    </form>
      </td>
    </tr>
   @endforeach
  </tbody>
{{$personas->links()}}
</table>
</div>
</div>
@endsection