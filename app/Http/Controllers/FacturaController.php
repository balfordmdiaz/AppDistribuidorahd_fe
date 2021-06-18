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
        $factura=facturaBD::latest('idfactura')->first();
        $empleado=empleadoBD::where('idempleado',auth()->user()->idempleado)->first();
        if(!$factura)
        {
            $factura=new facturaBD();
            $factura->idfactura=0;
        }
        return view('project.insertarfact',compact('factura','cliente','empleado'));
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