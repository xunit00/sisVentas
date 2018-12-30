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
        {!!Form::open(array('url'=>'ventas/venta','method'=>'POST','autocomplete'=>'off'))!!}
        @csrf
<div class="container">
    <div class="form-group">
        <label for="cliente">Cliente</label>
        <select name="idcliente" id="idcliente" class="form-control selectpicker"data-live-search="true">
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
<label for="pidarticulo">Articulo</label>
<select name="pidarticulo" id="pidarticulo"class="form-control selectpicker" data-live-search="true">
@foreach($articulos as $articulo)
<option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->precio_promedio}}">{{$articulo->articulo}}</option>
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
        <label for="pstock">Stock</label>
        <input type="number" name="pstock" id="pstock" class="form-control" disabled placeholder="Stock">
    </div>
</div>


<div class="col">
    <div class="form-group">
    <label for="precio_venta">P.Venta</label>
        <input type="number" name="pprecio_venta" id="pprecio_venta" disabled class="form-control" placeholder="P.venta">
    </div>
</div>

<div class="col">
    <div class="form-group">
        <label for="pdescuento">Descuento</label>
        <input type="number" name="pdescuento" id="pdescuento" class="form-control" placeholder="Descuento">
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
<th>P.venta</th>
<th>Descuento</th>
<th>Subtotal</th>
        </thead>
        <tfoot>
<th>Total</th>
<th></th>
<th></th>
<th></th>
<th></th>
<th><h4 id="total">$/ . 0.00</h4><input type="hidden" name="total_venta"id="total_venta "></th>
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
 $("#pidarticulo").change(mostrarValores);

function mostrarValores()
  {
   datosArticulos=document.getElementById('pidarticulo').value.split('_');
   $("#pprecio_venta").val(datosArticulos[2]);
   $("#pstock").val(datosArticulos[1]);
  }

function agregar()
{
    datosArticulos=document.getElementById('pidarticulo').value.split('_');

    idarticulo=datosArticulos[0];
    articulo=$("#pidarticulo option:selected").text();
    cantidad=parseInt( $("#pcantidad").val());
    descuento=$("#pdescuento").val();
    precio_venta=$("#pprecio_venta").val();
    stock=$("#pstock").val();

    if(idarticulo!="" && cantidad!="" && cantidad>0 && descuento!="" && precio_venta!="")
    {
        if(stock>=cantidad)
        {
            subtotal[cont]=(cantidad*precio_venta-descuento);
            total=total+subtotal[cont];

        var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td><input type="number" name="descuento[]" value="'+descuento+'"></td><td>'+subtotal[cont]+'</td></tr>';
        cont++;
        limpiar();
        $('#total').html("$/ " + total);
        $('#total_venta').val(total);
        evaluar();
        $('#detalles').append(fila);
        }
        else
        {
            alert('La cantidad a vender supera el stock');
        }
        
    }
    else
    {
        alert("Error al ingresar el detalle de ingreso, revise los datos del articulo");
    }
}

function limpiar()
{
    $("#pcantidad").val("");
    $("#pdescuento").val("");
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
    total=total - subtotal[index];
    $("#total").html("S./ " + total);
    $("#total_venta").val(total);
    $("#fila" + index).remove();
    evaluar();
}

</script>
@endpush
@endsection