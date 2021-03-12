@extends('layouts.app')
@section('contenido')
<div class="card">
  <div class="card-header">
  <strong> bienvenido: {{Auth::user()->name}}</strong>
  </div>
  <div class="card-body">
    <h5 class="card-title">Esta es la pagina de administracion para APR buli oriente san carlos</h5>
    <p class="card-text"> esta seccion pertenece a la gestion de tu cuenta, puedes volver aqui presionando en tu nombre</p>
  </div>
</div>
<div class="card">
  <div class="card-header">
  <strong> Tus datos de Usuario:</strong>
  </div>
  <div class="card-body">
   <form>
  <div class="form-group">
    <label for="exampleInputEmail1">correo electronico</label>
    <input type="email" class="form-control" value="{{Auth::user()->email}}" disabled>
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Rol</label>
    <input type="text" class="form-control" value="{{Auth::user()->Rol}}" disabled>
  </div>
</form>
		¿Deseas cambiar tu contraseña? click aqui <a href="{{url('password/reset')}}" class="btn btn-primary"> cambiar datos</a>
  </div>
</div>

@endsection
