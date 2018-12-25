@extends('layouts.master')
@section('contenido')
<div class="container">
        <h3>Nuevo Articulos</h3>
            @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
        @endif
</div>
        {!!Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
        @csrf
<div class="container">
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
    </div>

    <div class="form-group">
        <label for="nombre">Categoria</label>
            <select name="idcategoria" id="" class="form-control">
            @foreach($categorias as $cat)
            <option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
            @endforeach
            </select>
        </div> 
   
    <div class="form-group">
        <label for="codigo">Codigo</label>
        <input type="text" name="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Codigo del articulo...">
    </div>

    <div class="form-group">
        <label for="stock">Stock</label>
        <input type="text" name="stock" required value="{{old('stock')}}" class="form-control" placeholder="stock del articulo...">
    </div>

    <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" required value="{{old('descripcion')}}" class="form-control" placeholder="descripcion del articulo...">
    </div>

    <div class="form-group">
        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" class="form-control-file">
    </div> 
</div>

<div class="container">
    <button class="btn btn-info" type="submit">Guardar</button>
    <button class="btn btn-danger" type="reset">Cancelar</button>
</div> 
{!!Form::close()!!}
@endsection