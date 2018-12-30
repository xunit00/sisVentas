@extends('layouts.master')
@section('contenido')

<div class="container">
    <div class="form-group">
        <label for="cliente">Cliente</label>
       <p>{{$venta->nombre}}</p>
    </div>
    
<div class="col">
    <div class="form-group">
        <label for="tipo_comprobante">Tipo Comprobante</label>
        <p>{{$venta->tipo_comprobante}}</p>
    </div>
</div>

<div class="col">
    <div class="form-group">
        <label for="serie_comprobante">Serie Comprobante</label>
        <p>{{$venta->serie_comprobante}}</p>
    </div>
</div>

<div class="col">
    <div class="form-group">
        <label for="num_comprobante">Numero Comprobante</label>
        <p>{{$venta->num_comprobante}}</p>
    </div>
</div>

</div>




    <div class="panel panel-primary">
        <div class="panel-body">
            
<div class="col">
   <table id="detalles" class="table table-striped table-hover">
        <thead>
<th>Articulos</th>
<th>Cantidad</th>
<th>P.venta</th>
<th>Descuento</th>
<th>Subtotal</th>
        </thead>
        <tfoot>
<th></th>
<th></th>
<th></th>
<th></th>
<th><h4>{{$venta->total_venta}}</h4></th>
        </tfoot>
            <tbody>
            @foreach($detalles as $det)
            <tr>
            <td>{{$det->articulo}}</td>
            <td>{{$det->cantidad}}</td>
            <td>{{$det->precio_venta}}</td>
            <td>{{$det->descuento}}</td>
            <td>{{$det->cantidad*$det->precio_venta-$det->descuento}}</td>
            </tr>
            endforeach
            </tbody>
   </table>
</div>
</div>
</div>
@endsection


