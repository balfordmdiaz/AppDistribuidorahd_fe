<?php

namespace App\Http\Controllers;

use App\Models\clienteBD;
use App\Models\articuloBD;
use App\Models\facturaBD;
use App\Models\empleadoBD;
use App\Models\factdetalleDB;

use DateTime;
use DateTimeZone;

use Illuminate\Http\Request;

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
        $factura=facturaBD::latest('idfactura')->first();
        $empleado=empleadoBD::where('idempleado',auth()->user()->idempleado)->get();
        if(!$factura)
        {
            $factura=new facturaBD();
            $factura->idfactura=0;
        }
        return view('project.insertarfact',compact('factura','cliente','empleado'));
    }

}
