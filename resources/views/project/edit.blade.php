@extends('layoutedit')

@section('title',$clientebd->idlcliente)

@section('content')

<section id="contact-page">
    <div class="container">
      <div class="center">
        <br>
        <br>
        <h2>Editar Cliente</h2>
      </div>
      <div class="row contact-wrap">
        <div class="col-md-8 col-md-offset-2">
          
          <form  method="POST" action="{{ route('cliente.update',$clientebd->idcliente,'edit') }}">
          @csrf
          
            <div class="form-group">
                <input name="Idlcliente" type="text" class="form-control" placeholder="Codigo Cliente"  value="{{$clientebd->idlcliente}}" readonly="readonly"/>
                {!! $errors->first('Idlcliente','<small>:message</small><br>') !!}
            </div>
  
            <div class="form-group">
                <input name="Nombre" type="text" class="form-control" placeholder="Nombre" value="{{$clientebd->nombre}}" >
                {!! $errors->first('Nombre','<small>:message</small><br>') !!}
            </div>
  
            <div class="form-group">
                <input name="Apellido" type="text" class="form-control" placeholder="Apellido" value="{{$clientebd->apellido}}" >
                {!! $errors->first('Apellido','<small>:message</small><br>') !!}
            </div>
  
            <div class="form-group">
                <input name="Cedula" type="text" class="form-control" placeholder="Cedula" value="{{$clientebd->cedula}}" > 
                {!! $errors->first('Cedula','<small>:message</small><br>') !!}
            </div>
  
            <div class="form-group">
                <input name="Telefono" type="number" class="form-control" placeholder="Telefono" value="{{$clientebd->telefono}}" >
                {!! $errors->first('Telefono','<small>:message</small><br>') !!}
            </div>
  
            <div class="form-group">
              <input name="Departamento" type="text" class="form-control" placeholder="Departamento" value="{{$clientebd->departamento}}" >
              {!! $errors->first('Departamento','<small>:message</small><br>') !!}
            </div>
  
            <div class="form-group">
                <textarea name="Direccion" class="form-control" placeholder="Direccion" >{{$clientebd->direccion}}</textarea>
                {!! $errors->first('Direccion','<small>:message</small><br>') !!}
            </div>
            <div class="form-group">
                <input name="Email" type="email" class="form-control" placeholder="Email" value="{{$clientebd->email}}" />
                {!! $errors->first('Email','<small>:message</small><br>') !!}
            </div>
            
            <div id="boton_form_client">
               <button  class="btn btn-primary btn-lg" onclick="toastr.info('El registro se ha editado correctamente','Registro Actualizado',{timeOut:3000});">Actualizar</button>
            </div>
  
  
          </form>
        </div>
      </div>
      <!--/.row-->
    </div>
    <!--/.container-->
  </section>

@endsection