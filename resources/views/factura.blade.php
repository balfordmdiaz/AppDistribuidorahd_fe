@extends('layout')

@section('title','Factura')

@section('content')
<br>
<br>
<br>

<div id="boton_nuevoFactura">
    <div class="text-center">
         <h5>Nueva Factura</h5>
         <a href="{{ route('factura.insertar') }}"><i class="fa fa-plus fa-3x"></i></a>
         
    </div>
</div>

<div class="text-center">
    <h4>Facturas de Hoy</h4>
</div>

<table id="tablafactura" class="table table-bordered table-hover">
    <thead>
         <tr>
            <th scope="col">Id</th>
            <th scope="col">Fecha</th>
            <th scope="col">Total</th>
            <th scope="col">Acciones</th>
         </tr>
    </thead>

@forelse($factura as $facturaItem)
    
    <tbody>
      <tr>        
         <td id="codigo_fac">{{ $facturaItem->idlfactura }}</td>          
         <td>{{ $facturaItem->fechafactura }}</td>
         <td>{{ $facturaItem->total }}</td>
         <td>
               <div id="padreenlaces">
                <div id="b_editar"><a href="{{ route('factura.edit',$facturaItem->idfactura,'index') }}" >Editar</a></div>|
                <div id="b_detalle"><a href="{{ route('factura.show',$facturaItem->idfactura) }}" >Factura</a></div>
               </div>
        </td> 

      </tr>
         
@empty
      <tr>
        <td colspan="4" class="text-center">
             <p>No hay Factura para mostrar</p>
        </td>
      </tr>
   </tbody>
@endforelse
</table>

<div class="text-center">
    <p>{!! $factura->links() !!}</p>
</div>

@endsection