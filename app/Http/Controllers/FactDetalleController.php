<?php

namespace App\Http\Controllers;

use App\Models\factdetalleDB;
use App\Models\facturaBD;
use App\Models\articuloBD;
use App\Models\ArticuloStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class FactDetalleController extends Controller
{
    public function index($id)
    {    
        return view('project.vistafactura',[
            'facturabd'=> facturaBD::findOrFail($id)
        ]);
    }

    public function facturador($id)
    {
        return view('facturar.facturapdf',[
            'facturabd'=> facturaBD::findOrFail($id)
        ]);
    }

    public function descargar($id)
    {
        $pdf=PDF::loadview('facturar.facturapdf',[
            'facturabd'=> facturaBD::findOrFail($id)
        ]);   

        $nombre = facturaBD::where('idfactura', $id)->first();
        //$pdf->render();
        return $pdf->download($nombre->idlfactura.".pdf");
    }

    public function store()
    {
        $aux=request('idlfactura');
        $aux_articulo=request('idarticulo');
        $factura = facturaBD::where('idlfactura', $aux)->first();
        $cantidad_disponible=articuloBD::where('idarticulov', $aux_articulo)->first();//obtengo articulo seleccionado


        switch (request()->input('action')) {
            case 'agregar':

                   request()->validate([
                         'cantidad' => 'required|numeric|gt:0',
                         'total' => 'required|numeric|gt:0',
                   ]);

                   $aux_disponible=$cantidad_disponible->cantidad;//obtener cantida disponible
                   $aux_talla=$cantidad_disponible->talla;//obtener talla
                   $aux_color=$cantidad_disponible->color;//obtener color
                   $aux_cantidad=request('cantidad');//obtener cantidad solicitada por usuario
                   
                    //si la cantidad disponible supera a la solicitada que inserte
                   if($aux_disponible>$aux_cantidad)
                   {      
                     //se inserta en detalle factura
                     factdetalleDB::create([
             
                         'cantidad' => request('cantidad'),
                         'precio' => request('precio'),
                         'monto' => request('monto'),
                         'idarticulov' => request('idarticulo'),
                         'idfactura' => $factura->idfactura,
             
                     ]);

                     $ivabd=$factura->iva;
                     $descuentobd=$factura->descuento;

                     $subtotalbd = $factura->subtotal;
                     $totalbd = $factura->total;

                     $montoform = request('monto');
                     $totalform = request('total');

                     $subtotalbd = $subtotalbd+$montoform;
                     $totalbd = $totalbd+$totalform;


                     if($ivabd>0) //si tiene iva lo tiene que actualizar
                     {
                        $ivabd=$subtotalbd*0.15;
                        facturaBD::where('idfactura', $factura->idfactura)
                        ->update([
                            'iva' => $ivabd,

                        ]);
                     }

                     $totalbd=($subtotalbd+$ivabd)-$descuentobd; //calculo total

                     //se actualiza la factura
                     facturaBD::where('idfactura', $factura->idfactura)
                     ->update([
                         'subtotal' => $subtotalbd,
                         'total' => $totalbd,
                         
                     ]);

                     //se realiza el cambio en stock
                     $cantidad_nueva=$aux_disponible-$aux_cantidad;
                     articuloBD::where('idarticulov', $cantidad_disponible->idarticulov)
                     ->update([
                         'cantidad' => $cantidad_nueva,
                     ]);

                     return back()->with('mensaje'," Articulo Agregado Correctamente");

                    }
                    else
                    {
                       $nombre_art=ArticuloStock::where('idarticulos',request('idarticulos'))->first();
                       $mensaje=" Cantidad excede a la disponible en el inventario-".$nombre_art->nombrearticulo." ".$aux_talla." ".$aux_color." cantidad actual:".$aux_disponible;
                       return back()->with('flash',$mensaje);
                    }

                break;
    
            case 'descuento':
                     $subtotalbd = $factura->subtotal;
                     $descuentobd = request('descuento');
                     $ivabd=$factura->iva;
                     
                     if($subtotalbd>$descuentobd) //si el descuento es igual o mayor al subtotal que no haga cambios
                     {
                        $totalbd=($subtotalbd+$ivabd)-$descuentobd;
                     
                        facturaBD::where('idfactura', $factura->idfactura)
                        ->update([
                            'descuento' => $descuentobd,
                            'total' => $totalbd,
                            
                        ]);

                        return back()->with('mensaje_descuento'," Descuento actualizado correctamente");
                     }
                     else
                     {
                        return back()->with('flash'," Descuento no puede ser mayor o igual al Total");
                     }

                     
                break;

            case 'iva':
                     $subtotalbd = $factura->subtotal;
                     $ivabd = request('Iva');
                     $descuentobd=$factura->descuento;
                    
                     $totalbd = ($subtotalbd+$ivabd)-$descuentobd;

                     facturaBD::where('idfactura', $factura->idfactura)
                     ->update([
                         'iva' => $ivabd,
                         'total' => $totalbd,
                         
                     ]);

                     return back()->with('mensaje_iva'," Iva actualizado correctamente");
               break;

            case 'facturar':
                     $cantidad_registrada=factdetalleDB::where('idfactura', $factura->idfactura)->exists();
                     if($cantidad_registrada)
                     {
                        return redirect()->route('factura.facturar',$factura->idfactura);
                     }
                     else
                     {
                        return back()->with('flash'," No hay articulos en la factura");
                     }        
                break;
            case 'final':
                return redirect()->route('factura.index');
            break;
    

        }

    }

    public function gettalla(Request $request)
    {
           if($request->ajax()){
              $idarticulov=articuloBD::select('talla')->distinct()->where('idarticulos',$request->idarticulos)->get();
              $count=1;
              foreach($idarticulov as $articulo){
                  $articuloarray[$count] = $articulo->talla;
                  $count=$count+1;
              }
              return response()->json($articuloarray);
           }
    }

    public function getcolor(Request $request)
    {
        if($request->ajax()){
            $idarticulov=articuloBD::where('idarticulos','=',$request->idarticulos)->where('talla','LIKE',$request->talla)->get();      
            foreach($idarticulov as $articulo){
                
                $articuloarray[$articulo->idarticulov] = $articulo->color;
            }
            return response()->json($articuloarray);
         }
         

    }

    public function getprecio(Request $request)
    {     
        if($request->ajax()){
            $idarticulov=articuloBD::where('idarticulov',$request->idarticulov)->get();      
            foreach($idarticulov as $articulo){
                
                $articuloarray[$articulo->idarticulov] = $articulo->precio;
            }
            return response()->json($articuloarray);
         }    

    }
}
