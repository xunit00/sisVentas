<?php

namespace App\Http\Controllers;

use App\Ingreso;
use App\DetalleIngreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\IngresoFormRequest;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class IngresoController extends Controller
{
    public function __construct()
    {
    
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $ingresos=DB::table('ingreso as i')
            ->join('persona as p','i.idproveedor','=','p.idpersona')
            ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
            ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra)as total'))
            ->where('i.num_comprobante','LIKE','%'.$query.'%')
            ->orderBy('i.idingreso','desc')
            ->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado')
            ->paginate(5);
            return view('compras.ingresos.index',["ingresos"=>$ingresos,"searchText"=>$query]);  
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personas=DB::table('persona')->where('tipo_persona','=','Proveedor')->get();
        $articulos=DB::table('articulo as art')
        ->select(DB::raw('CONCAT(art.codigo, " " ,art.nombre)as articulo'),'art.idarticulo')
        ->where('art.estado','=','Activo')
        ->get();
        return view("compras.ingresos.create",["personas"=>$personas,"articulos"=>$articulos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IngresoFormRequest $request)
    {
        try {
            DB::beginTransaction();
            $ingreso = new Ingreso;
            $ingreso->idproveedor=$request->get('idproveedor');
            $ingreso->tipo_comprobante=$request->get('tipo_comprobante');
            $ingreso->serie_comprobante=$request->get('serie_comprobante');
            $ingreso->num_comprobante=$request->get('num_comprobante');
            $mytime = Carbon::now('America/Mexico_City');
            $ingreso->fecha_hora = $mytime->toDateTimeString();
            $ingreso->impuesto='18';
            $ingreso->estado='A';
            $ingreso->save();

            $idarticulo=$request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_compra = $request->get('precio_compra');
            $precio_venta = $request->get('precio_venta');

            //recorre los articulos agregados
            $cont = 0;
            while ($cont < count($idarticulo)) {
                # code...
                $detalle = new DetalleIngreso();
                $detalle->idingreso=$ingreso->idingreso;
                $detalle->idarticulo=$idarticulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_compra=$precio_compra[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->save();
                $cont=$cont+1;
            }
            DB::commit();
         } catch (\Exception $e) {
            DB::rollback(); 
        }
           
        return Redirect::to('compras/ingresos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function show($id)
    {
        $ingresos=DB::table('ingreso as i')
        ->join('persona as p','i.idproveedor','=','p.idpersona')
        ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
        ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra)as total'))
        ->where('i.idingreso','=',$id)
        ->first();

        $detalles=DB::table('detalle_ingreso as d')
        ->join('articulo as a','d.idarticulo','=','a.idarticulo')
        ->select('a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta')
        ->where('d.idingreso','=',$id)
        ->get();
        return view("compras.ingresos.show",["ingreso"=>$ingreso,"detalles"=>$detalles]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingreso=Ingreso::findOrFail($id);
        $ingreso->Estado='C';
        $ingreso->update();
        return Redirect::to('compras/ingresos');
    }
}
