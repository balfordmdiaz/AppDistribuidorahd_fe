<section id="contact-page">
    <div class="container">
      <div class="center">
        <h2>Nueva Factura</h2>
      </div>
      <div class="row contact-wrap">
        <div class="col-md-8 col-md-offset-2">
          
        <form id="formulariofactura" method="POST" action="{{ route('factura.store') }}">
        @csrf

           <!--<div class="form-group" style="display:none">
                <input name="id" type="text" class="form-control" value="{{ $fact_id  }}">
           </div>-->

           <div class="form-group">
                <label for="idfac" style="float: left">Codigo de Factura:</label>
                <input name="idlfactura" type="text" class="form-control" placeholder="Codigo factura" value="{{ $fact_id }}" readonly="readonly" />
           </div>
        
            <div class="form-group">
              <label for="idcliente" style="float: left">Cliente:</label>
              <input id="idlcliente" name="idlcliente" type="text" class="form-control" value="" required>
              <!--<select  name="idlcliente" class="form-control">
                    @forelse($cliente as $clienteItem)
                            <option value="{{ $clienteItem->idcliente }}">{{ $clienteItem->idlcliente }} - {{ $clienteItem->nombre }} {{ $clienteItem->apellido }} - {{ $clienteItem->departamento }}</option>
                    @empty
                            <option value="">No hay Clientes</option>
                    @endforelse
                 
              </select>-->
            </div>

            <div class="form-group" style="display:none">
                 <input name="idlempleado" id="idlempleado" type="text" class="form-control" placeholder="Codigo factura" value="{{ $empleado->idempleado }}" readonly="readonly" />
            </div>

            <div class="form-group">
                  <label for="idemp" style="float: left">Empleado:</label>     
                  <input name="mostrar_emp" id="mostrar_emp" type="text" class="form-control" placeholder="Codigo factura" value="{{ $empleado->idlempleado }} {{ $empleado->nombre }} {{ $empleado->apellido }}" readonly="readonly" />
            </div>

         
            <div id="boton_form_factura">
               <button id="btnrealizarf" class="btn btn-primary btn-lg" onclick="toastr.success('El registro se ingreso correctamente','Nuevo Registro',{timeOut:3000});"><i class="fa fa-plus fa-1x"></i> Realizar Factura</button>
            </div>


          </form>
        </div>
      </div>
      <!--/.row-->
    </div>
    <!--/.container-->
  </section>



<script src="{{asset('js/jquery-ui/jquery-ui.min.js')}}"></script>

<script>// manda a llamar o autocompletar datos buscados

    $('#idlcliente').autocomplete({
        source: function(request, response){
            $.ajax({
                url: "{{route('search.cliente')}}",
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data){
                    response(data)
                }
            });
        }

    });

</script>

<script>//Validacion de evitar carga de datos varias veces
          $('#formulariofactura').submit(function(e)
        {
            $('#btnrealizarf').on("click", function(e){
              e.preventDefault();
            });
        });

  </script>

