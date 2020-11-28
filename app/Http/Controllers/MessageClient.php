<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clienteBD;

class MessageClient extends Controller
{
    public function store()
    {

        // Validaciones del formulario

        request()->validate([
            'Idlcliente' => 'required',
            'Nombre'  => 'required',
            'Apellido'  => 'required',
            'Cedula'  => 'required',
            'Telefono'  => 'required',
            'Departamento'  => 'required',
            'Direccion'  => 'required',
            'Email'  => 'required|email'
            
        ]);

        /* Insertar de la manera antigua
        $cliente =new clienteBD();
        $cliente->idlcliente = request('IdLCliente');
        $cliente->nombre = request('Nombre');
        $cliente->apellido = request('Apellido');
        $cliente->cedula = request('Cedula');
        $cliente->telefono = request('Telefono');
        $cliente->departamento = request('Departamento');
        $cliente->direccion = request('Direccion');
        $cliente->email = request('Email');

        $cliente  -> save();
        */ 

        //Insertar con enloquent que es la manera nueva de laravel

        clienteBD::create([
            'idlcliente' => request('Idlcliente'),
            'nombre' => request('Nombre'),
            'apellido' => request('Apellido'),
            'cedula' => request('Cedula'),
            'telefono' => request('Telefono'),
            'departamento' => request('Departamento'),
            'direccion' => request('Direccion'),
            'email' => request('Email'),

        ]);



        //return redirect('/cliente')->with('message', 'Insercion exitosa');
        return redirect()->route("cliente.index");
    }

    public function update($id)
    {

        request()->validate([
            'Idlcliente' => 'required',
            'Nombre'  => 'required',
            'Apellido'  => 'required',
            'Cedula'  => 'required',
            'Telefono'  => 'required',
            'Departamento'  => 'required',
            'Direccion'  => 'required',
            'Email'  => 'required|email'
            
        ]);

         $datoscliente=request()->except(['_token','_method']);
         clienteBD::where('idcliente','=',$id)->update($datoscliente);

         return redirect()->route("cliente.index");
    }


}
