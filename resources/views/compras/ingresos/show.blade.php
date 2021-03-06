@extends('layouts.master')
@section('contenido')

<div class="container">
    <div class="form-group">
        <label for="proveedor">Proveedor</label>
       <p>{{$ingreso->nombre}}</p>
    </div>
    
<div class="col">
    <div class="form-group">
        <label for="tipo_comprobante">Tipo Comprobante</label>
        <p>{{$ingreso->tipo_comprobante}}</p>
    </div>
</div>

<div class="col">
    <div class="form-group">
        <label for="serie_comprobante">Serie Comprobante</label>
        <p>{{$ingreso->serie_comprobante}}</p>
    </div>
</div>

<div class="col">
    <div class="form-group">
        <label for="num_comprobante">Numero Comprobante</label>
        <p>{{$ingreso->num_comprobante}}</p>
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
<th>P.compra</th>
<th>P.venta</th>
<th>Subtotal</th>
        </thead>
        <tfoot>
<th></th>
<th></th>
<th></th>
<th></th>
<th><h4>{{$ingreso->total}}</h4></th>
        </tfoot>
            <tbody>
            @foreach($detalles as $det)
            <tr>
            <td>{{$det->articulo}}</td>
            <td>{{$det->cantidad}}</td>
            <td>{{$det->precio_compra}}</td>
            <td>{{$det->precio_venta}}</td>
            <td>{{$det->cantidad*$det->precio_compra}}</td>
            </tr>
            endforeach
            </tbody>
   </table>
</div>
</div>
</div>
@endsection


