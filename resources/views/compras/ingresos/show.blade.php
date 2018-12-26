@extends('layouts.master')
@section('contenido')

<div class="container">
    <div class="form-group">
        <label for="proveedor">Proveedor</label>
        <select name="idproveedor" id="idproveedor" class="form-control selectpicker"data-live-search="true">
        @foreach($personas as $persona)
        <option value="{{$persona->idpersona}}">{{$persona->nombre}}</option>
        @endforeach
        </select>
    </div>
    
<div class="col">
    <div class="form-group">
        <label for="tipo_comprobante">Tipo Comprobante</label>
        <select name="tipo_comprobante" id="" class="form-control">
            <option value="Factura">Factura</option>
            <option value="Boleta">Boleta</option>
            <option value="Tiquet">Tiquet</option>
        </select>
    </div>
</div>

<div class="col">
    <div class="form-group">
        <label for="serie_comprobante">Serie Comprobante</label>
        <input type="text" name="serie_comprobante" required value="{{old('serie_comprobante')}}" class="form-control" placeholder="Serie Comprobante...">
    </div>
</div>

<div class="col">
    <div class="form-group">
        <label for="num_comprobante">Numero Comprobante</label>
        <input type="text" name="num_comprobante" required value="{{old('num_comprobante')}}" class="form-control" placeholder="Numero Comprobante...">
    </div>
    </div>
</div>

<div class="row">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="form-group">
<label for="">Articulo</label>
<select name="pidarticulo" id="pidarticulo"class="form-control selectpicker" data-live-search="true">
@foreach($articulos as $articulo)
<option value="{{$articulo->idarticulo}}">{{$articulo->articulo}}</option>
@endforeach
</select>
            </div>
        </div>
    </div>

<div class="col">
    <div class="form-group">
        <label for="cantidad">Cantidad</label>
        <input type="text" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cant">
    </div>
</div>

<div class="col">
    <div class="form-group">
        <label for="precio_compra">P.Compra</label>
        <input type="number" name="pprecio_compra" id="pprecio_compra" class="form-control" placeholder="P.compra">
    </div>
</div>

<div class="col">
    <div class="form-group">
    <label for="precio_venta">P.Venta</label>
        <input type="number" name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="P.venta">
    </div>
</div>


<div class="col">
    <div class="form-group">
        <label for="precio_venta">Agregar</label>
        <BUTTON TYPE="button" id="bt_add" class="btn btn-info">+</BUTTON>
    </div>
</div>


<div>
   <table id="detalles" class="table table-striped table-hover">
        <thead>
<th>Opciones</th>
<th>Articulos</th>
<th>Cantidad</th>
<th>P.compra</th>
<th>P.venta</th>
<th>Subtotal</th>
        </thead>
        <tfoot>
<th>Total</th>
<th></th>
<th></th>
<th></th>
<th></th>
<th><h4 id="total">$/ . 0.00</h4></th>
        </tfoot>
            <tbody>
            </tbody>
   </table>
</div>

</div>

<div class="container" id="guardar">
    <button class="btn btn-info" type="submit">Guardar</button>
    <button class="btn btn-danger" type="reset">Cancelar</button>
</div> 
{!!Form::close()!!}
@push('scripts')
<script>
$(document).ready(function(){
    $('#bt_add').click(function(){
        agregar();
    });
});

var cont=0;
total=0;
subtotal=[];
$("guardar").hide();

function agregar()
{
    idarticulo=$("#pidarticulo").val();
    articulo=$("#pidarticulo option:selected").text();
    cantidad=$("#pcantidad").val();
    precio_compra=$("#pprecio_compra").val();
    precio_venta=$("#pprecio_venta").val();

    if(idarticulo!="" && cantidad!="" && cantidad>0 && precio_compra!="" && precio_venta!="")
    {
        subtotal[cont]=(cantidad*precio_compra);
        total=total+subtotal[cont];

        var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td>'+subtotal[cont]+'</td></tr>';
        cont++;
        limpiar();
        $('#total').html("$/ " + total);
        evaluar();
        $('#detalles').append(fila);
    }
    else
    {
        alert("Error al ingresar el detalle de ingreso, revise los datos del articulo");
    }
}

function limpiar()
{
    $("#pcantidad").val("");
    $("#pprecio_compra").val("");
    $("#pprecio_venta").val("");
}


function evaluar()
{
    if(total>0)
    {
        $("#guardar").show();
    }
    else
    {
        $("#guardar").hide();
    }
}

function eliminar(index)
{
  total=total-subtotal[index]; 
    $("#total").html("$/. " + total);   
    $("#fila" + index).remove();
    evaluar();
 }

</script>
@endpush
@endsection