@extends('layouts.master')
@section('contenido')
<div class="container">
    <div>
        <h3>Editar Articulo: {{$articulo->nombre}}<h3>
       @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
        @endif
        {!!Form::model($articulo,['method'=>'PATCH','route'=>['articulo.update',$articulo->idarticulo],'file'=>'true'])!!}
        @csrf
        <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required value="{{$articulo->nombre}}" class="form-control">
    </div>

    <div class="form-group">
        <label for="nombre">Categoria</label>
            <select name="idcategoria" class="form-control">
            @foreach($categorias as $cat)
            @if($cat->idcategoria==$articulo->idcategoria)
            <option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
            @else
            <option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
            @endif
            @endforeach
            </select>
        </div> 
   
    <div class="form-group">
        <label for="codigo">Codigo</label>
        <input type="text" name="codigo" required value="{{$articulo->codigo}}" class="form-control">
    </div>

    <div class="form-group">
        <label for="stock">Stock</label>
        <input type="text" name="stock" required value="{{$articulo->stock}}" class="form-control">
    </div>

    <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" required value="{{$articulo->descripcion }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" class="form-control">
        @if(($articulo->imagen)!="")
        <img src="{{asset('dist/img/articulos/'.$articulo->imagen)}}" height="100px" widt="100px">
        @endif
    </div> 
</div>

<div class="container">
    <button class="btn btn-primary" type="submit">Guardar</button>
    <button class="btn btn-danger" type="reset">Cancelar</button>
</div> 
        {!!Form::close()!!}
    </div>
</div>
@endsection