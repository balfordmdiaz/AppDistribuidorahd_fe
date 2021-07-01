<section id="contact-page">
  <div class="container">
    <div class="center">
      <h2>Nuevo Cliente</h2>
    </div>
    <div class="row contact-wrap">
      <div class="col-md-8 col-md-offset-2">
        
        <form id="formcliente" method="POST" action="{{ route('cliente.store') }}">
        @csrf

         <div class="form-group" style="display:none">
             <input name="Id" type="text" class="form-control" value="{{$id=$cliente->idcliente}}" />
         </div>

          <div class="form-group">
              <input name="Idlcliente" type="text" class="form-control" placeholder="Codigo Cliente" value="CLI{{$id=$id+1}}" readonly="readonly"/>
          </div>

          <div class="form-group">
              <input name="Nombre" type="text" class="form-control" placeholder="Nombre Completo" maxlength="50" value="{{ old('Nombre') }}">
              {!! $errors->first('Nombre','<small class="message_error">:message</small><br>') !!}
          </div>

          <!--<div class="form-group">//se elimino en BD el campo apellido
              <input name="Apellido" type="text" class="form-control" placeholder="Apellido" maxlength="20" value="{{ old('Apellido') }}" >
              {!! $errors->first('Apellido','<small class="message_error">:message</small><br>') !!}
          </div>-->

          <div class="form-group">
              <input name="Cedula" type="text" class="form-control" placeholder="Cedula" maxlength="16" value="{{ old('Cedula') }}" >
              {!! $errors->first('Cedula','<small class="message_error">:message</small><br>') !!}
          </div>

          <div class="form-group">
              <input name="Telefono" type="text" class="form-control" placeholder="Telefono" maxlength="10" value="{{ old('Telefono') }}" >
              {!! $errors->first('Telefono','<small class="message_error">:message</small><br>') !!}
          </div>

          <div class="form-group">
            <input name="Departamento" type="text" class="form-control" placeholder="Departamento" maxlength="30" value="{{ old('Departamento') }}" >
            {!! $errors->first('Departamento','<small class="message_error">:message</small><br>') !!}
          </div>

          <div class="form-group">
              <textarea name="Direccion" class="form-control" placeholder="Direccion" maxlength="50" value="{{ old('Direccion') }}" ></textarea>
              {!! $errors->first('Direccion','<small class="message_error">:message</small><br>') !!}
          </div>
          <div class="form-group">
              <input name="Email" type="email" class="form-control" placeholder="Email" maxlength="30" value="{{ old('Email') }}" />
              {!! $errors->first('Email','<small class="message_error">:message</small><br>') !!}
          </div>
          
          <div id="boton_form_client">
             <button id="btnnuevo"  class="btn btn-primary btn-lg" onclick="toastr.success('El registro se ingreso correctamente','Nuevo Registro',{timeOut:3000});"><i class="fa fa-plus fa-1x"></i> Registrar</button>
          </div>


        </form>
      </div>
    </div>
    <!--/.row-->
  </div>
  <!--/.container-->
</section>



<script>
  /*
  $('#formcliente').onclick(function(e)
  {
      e.preventDefault();

      $.ajax({
              url:"{{ route('cliente.store') }}",
              type:"POST",
          },
          success.function(response)
          {
              if(response)
              {
                 $('#formcliente')[0].reset();
                 toastr.success('El registro se ingreso correctamente','Nuevo Registro',{timeOut:3000});

              }
          }
      )

  
  });
  console.log("agua");
  */
</script>

<script>//Validacion de evitar carga de datos varias veces
          $('#formcliente').submit(function(e)
        {
            $('#btnnuevo').on("click", function(e){
              e.preventDefault();
            });
        });

</script>