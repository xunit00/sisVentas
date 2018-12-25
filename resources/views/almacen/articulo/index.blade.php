@extends('layouts.master')
@section('contenido')
<h1 class="text-center">Listado Articulos</h1>
<div class="container">
<a class="btn btn-info mb-3"  href="{{route('articulo.create')}}">Agregar Articulos</a>
<div>
@include('almacen.articulo.search')
</div>
<div class="table-responsive">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Codigo</th>
      <th scope="col">Categoria</th>
      <th scope="col">Stock</th>
      <th scope="col">Imagen</th>
      <th scope="col">Estado</th>
      <th scope="col" colspan="2" >Acciones</th>
    </tr>
  </thead>
  <tbody>
  @foreach($articulos as $art)
    <tr>
      <th scope="row">{{$art->idarticulo}}</th>
      <td>{{$art->nombre}}</td>
      <td>{{$art->codigo}}</td>
      <td>{{$art->categoria}}</td>
      <td>{{$art->stock}}</td>
      <td>
        <img src="{{asset('/dist/img/articulos/'.$art->imagen)}}" alt="{{$art->nombre}}" height="50px" width="50px" class="img-thubnail"> 
      </td>
      <td>{{$art->estado}}</td>
      <td>
      <a href="{{ route('articulo.edit', $art->idarticulo) }}">
      <button class="btn-sm btn-info">Editar</button>
      </a>
      </td>
      <td>
      <form action="{{route('articulo.destroy',$art->idarticulo)}}"method="POST">
      @csrf
      @method('DELETE')
     
      <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Quiere borrar este Articulo?')">Eliminar<i class="far fa-trash-alt"></i></button>
    </form>
      </td>
    </tr>
   @endforeach
  </tbody>
{{$articulos->links()}}
</table>
</div>
</div>
@endsection