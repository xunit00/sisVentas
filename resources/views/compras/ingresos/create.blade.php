@extends('layouts.master')
@section('contenido')
<div class="container">
        <h3>Nuevo Ingreso</h3>
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
        {!!Form::open(array('url'=>'compras/ingresos','method'=>'POST','autocomplete'=>'off'))!!}
        @csrf
<div class="container">
    <div class="form-group">
        <label for="proveedor">Proveedor</label>
        <select name="idproveedor" id="idproveedor" class="form-control">
        @foreach($personas as $persona)
        <option value="{{$persona->idpersona}}">{{$persona->nombre}}</option>
        @endforeach
        </select>
    </div>
   
    <div class="form-group">
        <label for="tipo_comprobante">Tipo Comprobante</label>
        <select name="tipo_comprobante" id="" class="form-control">
            <option value="Factura">Factura</option>
            <option value="Boleta">Boleta</option>
            <option value="Tiquet">Tiquet</option>
        </select>
    </div>

    <div class="form-group">
        <label for="serie_comprobante">Serie Comprobante</label>
        <input type="text" name="serie_comprobante" required value="{{old('serie_comprobante')}}" class="form-control" placeholder="Serie Comprobante...">
    </div>

    <div class="form-group">
        <label for="numero_comprobante">Numero Comprobante</label>
        <input type="text" name="numero_comprobante" required value="{{old('numero_comprobante')}}" class="form-control" placeholder="Numero Comprobante...">
    </div>

</div>

<div class="row">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="form-group">
<label for="">Articulo</label>
<select name="pidarticulo" id="pidarticulo"class="form-control">
@foreach($articulos as $articulo)
<option value="{{$articulo->idarticulo}}">{{$articulo->articulo}}</option>
@endforeach
</select>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <button class="btn btn-info" type="submit">Guardar</button>
    <button class="btn btn-danger" type="reset">Cancelar</button>
</div> 
{!!Form::close()!!}
@endsection