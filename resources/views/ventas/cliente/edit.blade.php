@extends('layouts.master')
@section('contenido')
<div class="container">
 
        <h3>Editar Clientes: {{$persona->nombre}}<h3>
       @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
        @endif
        {!!Form::model($persona,['method'=>'PATCH','route'=>['cliente.update',$persona->idpersona]])!!}
        @csrf
        <div class="container">
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required value="{{$persona->nombre}}" class="form-control" >
    </div>

    <div class="form-group">
        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" required value="{{$persona->direccion}}" class="form-control">
        </div> 
   
    <div class="form-group">
        <label for="documento">Documento</label>
        <select name="tipo_documento" id="" class="form-control">
        @if($persona->tipo_documento=='Cedula')
            <option value="Cedula" selected>Cedula</option>
            <option value="Pasaporte">Pasaporte</option>
            @else
            <option value="Cedula" >Cedula</option>
            <option value="Pasaporte"selected>Pasaporte</option>
            @endif
        </select>
    </div>

    <div class="form-group">
        <label for="num_documento">Numero Documento</label>
        <input type="text" name="num_documento" required value="{{$persona->num_documento}}" class="form-control">
    </div>

    <div class="form-group">
        <label for="telefono">Telefono</label>
        <input type="text" name="telefono" required value="{{$persona->telefono}}" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control"value="{{$persona->email}}">
    </div> 

<div class="container">
    <button class="btn btn-info" type="submit">Guardar</button>
    <button class="btn btn-danger" type="reset">Cancelar</button>
</div> 
        {!!Form::close()!!}
</div>
@endsection