@extends('layouts.app')
@section('contenido')
<div class="row">
	<div class="col col-lg-6 col-md-6  col-xs-6">
		<h3>Nueva medicion</h3>
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
<form class="form" action="{{route('medicion.store')}}" method="POST" autocomplete="off" >
				
			<div class="form-group">
				<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
				<input name="idinscriptor" type="hidden" value="2"/>
				<label for="valordemedicion">valor de la medicion</label>
				<input type="text" name="valordemedicion" class="form-control" required value="{{old('valordemedicion')}}">
			</div>
		
			<div class="form-group">
									<label for="idvivienda">vivienda</label>
									<select name="idvivienda" class="form-control selectpicker " required data-live-search="true">
										<option value="" > seleccione </option>
										@foreach ($viviendas as $v)
										<option value="{{$v->idvivienda}}"> {{$v->direccion}} </option>
										@endforeach
									</select>
								</div>
	
		<div class="form-group">
			<button class="btn btn-primary" class="form-control" type="submit">guardar</button>
			<a href="{{url('medicion')}}" class="btn btn-danger">cancelar</a>
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
                  <li class="breadcrumb-item"><a href="{{url('medicion')}}">Medicion</a></li>
                  <li class="breadcrumb-item active">Crear nuevo</li>
                </ol>
              </div><!-- /.col -->
 </div>
@endsection



