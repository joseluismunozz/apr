@extends('layouts.app')
@section('contenido')
<div class="row mb-3">
	<div class="col col-lg-12 col-md-12  col-xs-12 mb-2">
		<h5>Editar medicion de la vivienda: {{$medicion->direccion}}, 
			registrada en la fecha: {{$medicion->fechadeingreso}}</h5>
		@if(count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
	
</div>
	<form class="form" action="{{route('medicion.update', $medicion->idmedicion)}}" method="POST" autocomplete="off" >
				@method('PUT')
		<div class="form-group">
				<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
				<label for="valordemedicion">valor de la medicion</label>
				<input type="number" name="valordemedicion" class="form-control" required value="{{$medicion->valordemedicion}}">
			</div>
		<div class="form-group">
			<button class="btn btn-primary" class="form-control" type="submit">guardar</button>
			@if(Auth::user()->Rol=="admin")
			<a href="{{url('medicion')}}" class="btn btn-danger">cancelar</a>
			@else
				<a href="{{url('medicionEncargado')}}" class="btn btn-danger">cancelar</a>
			@endif
		</div>
	
	
	
</form>

@endsection
@section('ubicacion')
@if(Auth::user()->Rol=="Admin")
 <div class="row mb-2">
                <div class="col-sm-3">
                  <h1 class="m-0 text-dark">Accediste a: </h1>
                </div><!-- /.col -->
                <div class="col-sm-9">
                 <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('medicion')}}">Medicion</a></li>
                  <li class="breadcrumb-item active">editar medicion existente</li>
                </ol>
              </div><!-- /.col -->
          </div>
		  @endif
@endsection