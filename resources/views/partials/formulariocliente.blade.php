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
              <input name="Idlcliente" type="text" class="form-control" placeholder="Codigo Cliente" value="CL00{{$id=$id+1}}" readonly="readonly"/>
          </div>

          <div class="form-group">
              <input name="Nombre" type="text" class="form-control" placeholder="Nombre" value="{{ old('Nombre') }}">
              {!! $errors->first('Nombre','<small class="message_error">:message</small><br>') !!}
          </div>

          <div class="form-group">
              <input name="Apellido" type="text" class="form-control" placeholder="Apellido" value="{{ old('Apellido') }}" >
              {!! $errors->first('Apellido','<small class="message_error">:message</small><br>') !!}
          </div>

          <div class="form-group">
              <input name="Cedula" type="text" class="form-control" placeholder="Cedula" value="{{ old('Cedula') }}" >
              {!! $errors->first('Cedula','<small class="message_error">:message</small><br>') !!}
          </div>

          <div class="form-group">
              <input name="Telefono" type="number" class="form-control" placeholder="Telefono" value="{{ old('Telefono') }}" >
              {!! $errors->first('Telefono','<small class="message_error">:message</small><br>') !!}
          </div>

          <div class="form-group">
            <input name="Departamento" type="text" class="form-control" placeholder="Departamento" value="{{ old('Departamento') }}" >
            {!! $errors->first('Departamento','<small class="message_error">:message</small><br>') !!}
          </div>

          <div class="form-group">
              <textarea name="Direccion" class="form-control" placeholder="Direccion" value="{{ old('Direccion') }}" ></textarea>
              {!! $errors->first('Direccion','<small class="message_error">:message</small><br>') !!}
          </div>
          <div class="form-group">
              <input name="Email" type="email" class="form-control" placeholder="Email" value="{{ old('Email') }}" />
              {!! $errors->first('Email','<small class="message_error">:message</small><br>') !!}
          </div>
          
          <div id="boton_form_client">
             <button  class="btn btn-primary btn-lg" onclick="toastr.success('El registro se ingreso correctamente','Nuevo Registro',{timeOut:3000});"><i class="fa fa-plus fa-1x"></i> Registrar</button>
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