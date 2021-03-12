@extends('layouts.app')
@section('contenido')
<div class="row">
	<div class="col col-lg-6 col-md-6  col-xs-6">
		<h3>Nuevo representante</h3>
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
<form class="form" action="{{route('representante.store')}}" method="POST" autocomplete="off" >
				
			<div class="form-group">
				<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
				<label for="nombre">nombre</label>
				<input type="text" name="nombre" class="form-control" required value="{{old('nombre')}}">
			</div>
		
			<div class="form-group">
				<label for="rut">rut</label>
				<input type="tex" name="rut"  id="rut"class="form-control" required  value="{{old('rut')}}">
			</div>
				<div class="form-group">
				<label for="telefono">telefono</label>
				<input type="number" name="telefono" class="form-control" required  value="{{old('telefono')}}">
			</div>
				<div class="form-group">
				<label for="email">email</label>
				<input type="email" name="email" class="form-control" required  value="{{old('email')}}">
			</div>
			<div class="form-group">
									<label for="idvivienda">vivienda</label>
									<select name="idvivienda" class="form-control  " required data-live-search="true">
										<option value="" > seleccione </option>
										@foreach ($viviendas as $v)
										<option value="{{$v->idvivienda}}"> {{$v->direccion}} </option>
										@endforeach
									</select>
								</div>
	
		<div class="form-group">
			<button class="btn btn-primary" class="form-control" type="submit">guardar</button>
			<a href="{{url('representante')}}" class="btn btn-danger">cancelar</a>
		</div>
	
</form>
@endsection
@section('ubicacion')
 <div class="row mb-2">
                <div class="col-sm-3">
                  <h1 class="m-0 text-dark">Accediste a: </h1>
                </div><!-- /.col -->
                <div class="col-sm-9">
                 <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('representante')}}">Representante</a></li>
                  <li class="breadcrumb-item active">Crear nuevo</li>
                </ol>
              </div><!-- /.col -->
               </div>
@endsection
@push('scripts')
<script src="{{url('js/jquery.rut.js')}}"></script>
<script>
	$(document).ready(function(){
		
		$("#rut").rut();
		
	});
 
</script>
@endpush
@push('estilos')
@endpush


