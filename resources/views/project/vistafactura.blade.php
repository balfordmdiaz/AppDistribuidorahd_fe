@extends('layout')

@section('title',$facturabd->idlfactura)

@section('content')
@inject('articulostock', 'App\Services\Article')

<section id="contact-page">
    <div class="container">
      <div class="center">
        <br>
        <br>
        <br>
      <h4>Agregar mas articulo {{ $facturabd->idlfactura }}</h4>
      </div>
      <div class="row contact-wrap">
        <div class="col-md-8 col-md-offset-2">
          
        <form id="formularioagregar" method="POST" action="{{ route('factura.agregar',$facturabd->idfactura,'store') }}">
         @csrf

           <!----------------------MENSAJES---------------------------->
           <div class="form-group">
               @if(session('flash'))
                   <div class="alert alert-danger" role="alert">
                       <strong>Aviso</strong>{{ session('flash') }}
                       <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                          <span aria-hidden="true"> &times;</span>
                       </button>
                   </div>
               @endif
           </div>

           <div class="form-group">
            @if(session('mensaje'))
                <div class="alert alert-success" role="alert">
                    <strong>Aviso</strong>{{ session('mensaje') }}
                    <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                       <span aria-hidden="true"> &times;</span>
                    </button>
                </div>
            @endif
           </div>

           <div class="form-group">
            @if(session('mensaje_iva'))
                <div class="alert alert-info" role="alert">
                    <strong>Aviso</strong>{{ session('mensaje_iva') }}
                    <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                       <span aria-hidden="true"> &times;</span>
                    </button>
                </div>
            @endif
           </div>

           <div class="form-group">
            @if(session('mensaje_descuento'))
                <div class="alert alert-info" role="alert">
                    <strong>Aviso</strong>{{ session('mensaje_descuento') }}
                    <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                       <span aria-hidden="true"> &times;</span>
                    </button>
                </div>
            @endif
           </div>
           <!------------------------------------------------------------->

           <div class="form-group">
                <label for="" style="float: left">Factura:</label>    
                <input name="idlfactura" type="text" class="form-control" placeholder="Codigo factura" value="{{ $facturabd->idlfactura }}" readonly="readonly">   
           </div>

           <div class="form-group">
                 <label for="" style="float: left">Empleado:</label>
                 <input name="idempleado" type="text" class="form-control" placeholder="Codigo empleado" 
                 value="{{ $idemp = DB::table('tbl_empleado')->where('idempleado', $facturabd->idempleado)->value('idlempleado') }}" readonly="readonly">
           </div>

           <div
            class="form-group">
                 <label for="" style="float: left">Cliente:</label>    
                 <input name="idlcliente" type="text" class="form-control" placeholder="Codigo cliente" 
                 value="{{ $idcliente = DB::table('tbl_clientes')->where('idcliente', $facturabd->idcliente)->value('idlcliente') }}" readonly="readonly">
           </div>

          <div class="form-group">
            <label for="" style="float: left">Articulo:</label> 
            <select  id="idarticulostock" name="idarticulos" class="form-control" >
              @foreach($articulostock->get() as $index => $article)
                   <option value="{{ $index }}" {{ old('idarticulos') == $index ? 'selected' : '' }}>
                      {{ $article }}
                   </option>
              @endforeach  
              

            </select> 
            @if ($errors->has('idarticulos'))
               <span class="invalid-feedback" role="alert">
                   <strong>{{ $errors->first('idarticulos') }}</strong>
               </span>
            @endif   
         </div>

          <div class="form-group">
              <label for="" style="float: left">Talla Articulo:</label> 
              <select  id="idarticulov" name="idarticulov" data-old="{{ old('idarticulov') }}" class="form-control{{ $errors->has('idarticulov') ? ' is-invalid' : '' }}">
              </select> 

              @if ($errors->has('idarticulov'))
                   <span class="invalid-feedback" role="alert">
                       <strong>{{ $errors->first('idarticulov') }}</strong>
                   </span>
              @endif
          </div>
        
          <div class="form-group">
            <label for="" style="float: left">Color Articulo:</label> 
            <select  id="color" data-old="{{ old('idarticulo') }}" name="idarticulo" class="form-control{{ $errors->has('idarticulo') ? ' is-invalid' : '' }}">
            </select> 

            @if ($errors->has('idarticulo'))
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('idarticulo') }}</strong>
                 </span>
            @endif
        </div>

          <div class="form-group">
             <label for="" style="float: left">Cantidad:</label>
             <input name="cantidad" id="cantidad" type="number" class="form-control"  onkeyup="loadprecio()" pattern="^[0-9]+" oninput="this.value = Math.max(this.value, 0)"/>
             {!! $errors->first('cantidad','<small class="message_error">:message</small><br>') !!}
          </div>

          <div class="form-group" >
               <label for="" style="float: left">Precio:</label>
               <input name="precio" id="precio" type="number" step="any" class="form-control" value="{{ old('precio') }}" readonly="readonly"/>        
          </div>

          <div class="form-group">
            <label for="" style="float: left">Monto:</label>
            <input name="monto" id="monto" type="number" step="any" class="form-control" readonly="readonly"/>       
          </div>

          <div class="form-group">
                  <input name="chec" type="checkbox" id="chec" onChange="comprobar(this);" onclick="loadcalculos();" />
                  <label for="chec">IVA(opcional)</label>
                  <input name="Iva" type="number" id="boton" class="form-control" step="any" style="display:none" placeholder="IVA" readonly="readonly"/>

                  <button type="submit" name="action" id="mas_iva" style="display:none" class="btn btn-primary btn-lg" value="iva"
                  onclick="toastr.info('El iva ha sido cambiado','Iva Actualizado',{timeOut:5000});"
                  ><i class="fa fa-plus fa-1x"></i> Iva</button>
          </div>

          <div class="form-group">
              <input name="chec" type="checkbox" id="chec_descuento" onChange="comprobarDescuento(this);" onclick="loadcalculos();" />
              <label for="chec">Descuento(opcional)</label>
              <input name="descuento" id="descuento" type="number" step="any" class="form-control" style="display:none" min="0" value="0" pattern="^[0-9]+" oninput="this.value = Math.max(this.value, 0)"/>

              <button  type="submit" name="action" id="mas_descuento" style="display:none" class="btn btn-primary btn-lg" value="descuento"
              onclick="toastr.info('El descuento ha sido cambiado','Descuento Actualizado',{timeOut:5000});"
              ><i class="fa fa-plus fa-1x"></i> Descuento</button>
      </div>

          <div class="form-group" style="display:none">
            <label for="" style="float: left">Total:</label>
            <input id="total" name="total" type="number" step="any" class="form-control" readonly="readonly" />
            {!! $errors->first('total','<small class="message_error">:message</small><br>') !!}         
          </div>

          <div id="boton_form_factura">
            <button type="submit" name="action" class="btn btn-primary btn-lg" value="final"><i class="fa fa-sign-in fa-1x"></i> Salir</button>
            <button type="submit" name="action" class="btn btn-primary btn-lg" value="facturar" ><i class="fa fa-file-text fa-1x"></i> Facturar</button>    
            <button type="submit" name="action" class="btn btn-primary btn-lg" value="agregar"
            onclick="toastr.success('El registro se ingreso correctamente','Nuevo Registro',{timeOut:5000});"
            ><i class="fa fa-plus fa-1x"></i> Agregar Articulo</button>
          </div> 
           
        </form>

        <div class="center">
          <h3>Lista articulos {{ $facturabd->idlfactura }}</h3>
        </div>
        </div>
      </div>
      <!--/.row-->
    </div>
    <!--/.container-->
  </section>

  <div>
    

    <table id="tabladetallefactura" class="table table-bordered table-hover">
      <thead>
           <tr>
              <th scope="col">Art</th>
              <th scope="col">Talla</i></th>
              <th scope="col">Cant</th>
              <th scope="col">Monto</th>
           </tr>
      </thead>
  
     @forelse($detalle = DB::table('tbl_facturadetalle')
                            ->join('tbl_articulovariante', 'tbl_facturadetalle.idarticulov', '=', 'tbl_articulovariante.idarticulov')
                            ->join('tbl_articulostock', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
                            ->join('tbl_factura', 'tbl_facturadetalle.idfactura', '=', 'tbl_factura.idfactura')
                            ->select('tbl_articulostock.nombrearticulo', 'tbl_articulovariante.talla', 'tbl_facturadetalle.cantidad','tbl_facturadetalle.monto')
                            ->where('tbl_facturadetalle.idfactura', $facturabd->idfactura)
                            ->get()  as $detalleItem)
      
       <tbody>
        <tr>        
           <td>{{ $detalleItem->nombrearticulo }}</td>          
           <td>{{ $detalleItem->talla }}</td>
           <td>{{ $detalleItem->cantidad }}</td>
           <td>{{ $detalleItem->monto }}</td>
        </tr>
           
     @empty

     
      <tr>
        <td colspan="5"><p style="text-align: center">No hay articulos para mostrar</p> </td>
      </tr>  
     
      </tbody>

     @endforelse

     <tr>
       <th>Subtotal</th>
       <td colspan="3">{{ $facturabd->subtotal }} C$</td>
     </tr>

     <tr>    
       <th>Iva</th>
       <td colspan="3">{{ $facturabd->iva }} C$</td>
     </tr>

    <tr>   
       <th>Descuento</th>
       <td colspan="3">{{ $facturabd->descuento }} C$</td>
    </tr>

    <tr>
       <th>Total</th>
       <td colspan="3">{{ $facturabd->total }} C$</td>
    </tr>

  </table>
  

</div>

@endsection

@section('script')
<script>
  $(document).ready(function(){

       function loadvariante()
       {
          var idarticulos=$('#idarticulostock').val();
          if($.trim(idarticulos) != '')
          {
              
            $.get('variante',{idarticulos: idarticulos}, function(variantes){
                     
                    var old=$('#idarticulov').data('old') != '' ? $('#idarticulov').data('old') : '';
                    $('#idarticulov').empty();
                    $('#idarticulov').append("<option value=''>Selecciona una Talla</option>");
                    $.each(variantes,function(index,value){
                      $('#idarticulov').append("<option value='"+index+"'"+ (old==index ? 'selected' : '') +">"+value+"</option>");
                    })
            });
          }
       }
       loadvariante();
      $('#idarticulostock').on('change', loadvariante);
  });


</script>

<script>
  function ShowSelected()
  {
    
   //obtener el id articulo seleccionado
   var elementos = document.getElementById('color').value;
   console.log(elementos);



   if(elementos>0)
   {
   var precioaux=document.getElementById('precio').value;

   var cantidadaux=document.getElementById('cantidad').value;
   var montoaux=0.00;
   montoaux=precioaux*cantidadaux;
   console.log("precio:"+precioaux);
   console.log("cantidad:"+cantidadaux);
   console.log("monto:"+montoaux);

   document.getElementById('monto').value=montoaux;

   document.getElementById('total').value=parseFloat(montoaux);
   }
 
 };

 function loadcalculos()
 {
   const subtotalbd = {!! json_encode($facturabd->subtotal ?? '') !!};
   var subtotal_aux=subtotalbd;
   console.log("subtotal:"+subtotal_aux);
   if(document.getElementById('chec').checked)
   {
      //Este es el Iva 
      document.getElementById('boton').value=subtotal_aux*0.15;         
   }
   else
   {
      document.getElementById('boton').value=0;
   }

   if(document.getElementById('chec_descuento').checked)
   {
     //si el check del descuento esta habilitado
   }
   else
   {
      document.getElementById('descuento').value=0;
   }

   var aux=document.getElementById('boton').value;

   console.log("Iva:"+aux);

 }
window.onload = ShowSelected; //para que cargue la funcion desde el principio
</script>


<script>
    $(document).ready(function(){

         function loadcolor()
         { 
            var idarticulos=$('#idarticulostock').val();
            var talla=$('#idarticulov option:selected').text()
            if($.trim(idarticulos) != '')
            {
               $.get('colores',{idarticulos: idarticulos,talla: talla}, function(variantes){
            
                     var old=$('#color').data('old') != '' ? $('#color').data('old') : '';
                     $('#color').empty();
                     $('#color').append("<option value=''>Selecciona color</option>");
                     $.each(variantes,function(index,value){
                       $('#color').append("<option value='"+index+"'"+ (old==index ? 'selected' : '') +">"+value+"</option>");
                     })
             });
           }       
        }
        loadcolor();
        $('#idarticulov').on('change', loadcolor);
    });
    
    function loadprecio()
    {
        var idarticulov=$('#color').val();
        var idarticulos=$('#idarticulostock').val();
        console.log("id stock:"+idarticulos);
        console.log("id variante:"+idarticulov);

        if($.trim(idarticulov) != '')
        {
          $.get('precio',{idarticulov: idarticulov},function(variable){

          $.each(variable,function(index,value){
             $('#precio').val(value);
          })     
        });

        ShowSelected();
        }

    }



    $(document).ready(function()
    {
         $('#color').on('change',loadprecio);
    });
</script>

@endsection



