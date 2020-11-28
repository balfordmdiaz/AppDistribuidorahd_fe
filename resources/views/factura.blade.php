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
    <h4>Lista de Factura Hoy</h4>
</div>

<table id="tablafactura" class="table table-bordered table-hover">
    <thead>
         <tr>
            <th scope="col">Id</th>
            <th scope="col">Fecha</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Total</th>
         </tr>
    </thead>

@forelse($factura as $facturaItem)
    
    <tbody>
      <tr>        
         <td id="codigo_fac">{{ $facturaItem->idlfactura }}</td>          
         <td>{{ $facturaItem->fechafactura }}</td>
         <td>{{ $facturaItem->subtotal }}</td>
         <td>{{ $facturaItem->total }}</td>

      </tr>
         
@empty
      <tr>
        <td colspan="4">
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
   