<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clienteBD extends Model
{
    use HasFactory;
    protected $table='tbl_clientes';
    protected $primaryKey = 'idcliente';

    protected $fillable = ['idlcliente','nombre','apellido','cedula','telefono','departamento','direccion','email'];
    
    public $timestamps = false;
}
