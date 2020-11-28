<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\facturaBD;
use App\Models\factdetalleDB;
use Illuminate\Support\Facades\DB;

use DateTime;
use DateTimeZone;


class Messagefactura extends Controller
{
    public function store()
    {
        
        $aux=request('idlfactura');
        $auxiva=0.00;
        $auxdescuento=0.00;
        $auxsubtotal=0.00;
        $auxtotal=0.00;

        request()->validate([
            'idlfactura' => 'required',
            
        ]);

        $dt = new DateTime("now", new DateTimeZone('America/Managua'));
        

        
        facturaBD::create([
            'idlfactura' => request('idlfactura'),
            'fechafactura' => $dt->format('Y/m/d, H:i:s'),
            'iva' => $auxiva,
            'descuento' => $auxdescuento,
            'subtotal' => $auxsubtotal,
            'total' => $auxtotal,
            'idcliente' => request('idlcliente'),
            'idempleado' => request('idlempleado'),

        ]);

        $factura = facturaBD::where('idlfactura', $aux)->first();

        return redirect()->route('factura.vistafactura',$factura->idfactura);
        
        
    }

}
