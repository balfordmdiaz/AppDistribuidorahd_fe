<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Models\clienteBD;
use App\Models\facturaBD;
use App\Models\empleadoBD;
use DateTime;
use DateTimeZone;

class FacturaController extends Controller
{
    public function index()
    {
        $dt = new DateTime("now", new DateTimeZone('America/Managua'));
        $aux= $dt->format('Y-m-d');
        $fecha=$aux.'%';
        $factura=facturaBD::where('fechafactura', 'like', $fecha)->orderBy('idfactura','DESC')->paginate(5);
        return view('factura',compact('factura'));
    }   


    public function insertar()
    {
        $cliente=clienteBD::get();
        $factura=facturaBD::latest('idfactura')->pluck('idfactura')->first();
        $empleado=empleadoBD::where('idempleado',auth()->user()->idempleado)->first();
        if(!$factura)
        {
            $factura=new facturaBD();
            $factura->idfactura=0;
        }

        //Autoincrementador de id factura
        $numfact = $factura + 1;
        if($numfact > 0 && $numfact < 10){
            $fact_id = 'FAC'.'00000'.$numfact;
        }
        elseif ($numfact >= 10 && $numfact < 100){
            $fact_id = 'FAC'.'0000'.$numfact;
        }
        elseif ($numfact >= 100 && $numfact < 1000){
            $fact_id = 'FAC'.'000'.$numfact;
        }
        elseif ($numfact >= 1000 && $numfact < 10000){
            $fact_id = 'FAC'.'00'.$numfact;
        }
        elseif ($numfact >= 10000 && $numfact < 100000){
            $fact_id = 'FAC'.'0'.$numfact;
        }
        elseif ($numfact >= 100000 && $numfact < 1000000){
            $fact_id = 'FAC'.$numfact;
        }

        //print($fact_id);

        return view('project.insertarfact',compact('fact_id','cliente','empleado'));
    }

    public function show($id)
    {

       return view('Facturar.facturapdf',[
            'facturabd'=> facturaBD::findOrFail($id)
        ]);

    }

    public function edit($id)
    {
        return view('project.vistafactura',[
            'facturabd'=> facturaBD::findOrFail($id)
        ]);
    }

}