@extends('layouts.master')
@section('contenido')
<h1 class="text-center">Listado Categorias</h1>
<div class="container">
<a class="btn btn-info mb-3"  href="{{route('categoria.create')}}">Agregar Categoria</a>
<div>
@include('almacen.categoria.search')
</div>
<div class="table-responsive">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Descripcion</th>
      <th scope="col" colspan="2" >Acciones</th>
    </tr>
  </thead>
  <tbody>
  @foreach($categorias as $cat)
    <tr>
      <th scope="row">{{$cat->idcategoria}}</th>
      <td>{{$cat->nombre}}</td>
      <td>{{$cat->descripcion}}</td>
      <td>
      <a href="{{ route('categoria.edit', $cat->idcategoria) }}">
      <button class="btn-sm btn-info">Editar</button>
      </a>
      </td>
      <td>
      <form action="{{route('categoria.destroy',$cat->idcategoria)}}"method="POST">
      @csrf
      @method('DELETE')
     
      <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Quiere borrar esta Categoria?')">Eliminar<i class="far fa-trash-alt"></i></button>
    </form>
      </td>
    </tr>
   @endforeach
  </tbody>
{{$categorias->links()}}
</table>
</div>
</div>
@endsection