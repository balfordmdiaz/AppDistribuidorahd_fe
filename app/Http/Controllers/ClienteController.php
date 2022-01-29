<?php

namespace App\Http\Controllers;

use App\Models\clienteBD;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function index()
    {

        //$cliente = DB::table('tbl_clientes')->paginate(5);
        //return view('cliente', ['cliente' => $cliente]);

        $cliente=clienteBD::orderBy('idcliente','DESC')->paginate(5);
        return view('/cliente',compact('cliente'));
    }

     public function show($id)
    {

       return view('project.show',[
            'clientebd'=> clienteBD::findOrFail($id)
        ]);

    }

    public function edit($id)
    {
        return view('project.edit',[
            'clientebd'=> clienteBD::findOrFail($id)
        ]);
    }

    public function insertar()
    {
        $cliente=clienteBD::latest('idcliente')->pluck('idcliente')->first();
        if(!$cliente)
        {
            $cliente=new clienteBD();
            $cliente->idcliente=0;
        }

        //Autoincrementador de id cliente
        $incrementId = $cliente + 1;
        if($incrementId > 0 && $incrementId < 10){
            $client_id = 'CLI'.'000'.$incrementId;
        }
        elseif ($incrementId >= 10 && $incrementId < 100){
            $client_id = 'CLI'.'00'.$incrementId;
        }
        elseif ($incrementId >= 100 && $incrementId < 1000){
            $client_id = 'CLI'.'0'.$incrementId;
        }
        elseif ($incrementId >= 1000){
            $client_id = 'CLI'.$incrementId;
        }

        return view('project.insertar',compact('client_id'));
    }



}
