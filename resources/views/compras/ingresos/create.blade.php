@extends('layouts.master')
@section('contenido')
<div class="container">
        <h3>Nuevo Proveedor</h3>
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
        {!!Form::open(array('url'=>'compras/proveedor','method'=>'POST','autocomplete'=>'off'))!!}
        @csrf
<div class="container">
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
    </div>

    <div class="form-group">
        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" required value="{{old('direccion')}}" class="form-control" placeholder="Direccion...">
        </div> 
   
    <div class="form-group">
        <label for="documento">Documento</label>
        <select name="tipo_documento" id="" class="form-control">
            <option value="Cedula">Cedula</option>
            <option value="Pasaporte">Pasaporte</option>
        </select>
    </div>

    <div class="form-group">
        <label for="num_documento">Numero Documento</label>
        <input type="text" name="num_documento" required value="{{old('num_documento')}}" class="form-control" placeholder="Numero Documento del cliente...">
    </div>

    <div class="form-group">
        <label for="telefono">Telefono</label>
        <input type="text" name="telefono" required value="{{old('telefono')}}" class="form-control" placeholder="telefono del cliente...">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control"placeholder="email del cliente">
    </div> 
</div>

<div class="container">
    <button class="btn btn-info" type="submit">Guardar</button>
    <button class="btn btn-danger" type="reset">Cancelar</button>
</div> 
{!!Form::close()!!}
@endsection