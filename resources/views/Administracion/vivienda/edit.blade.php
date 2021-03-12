@extends('layouts.app')
@section('contenido')
<div class="row">
	<div class="col col-lg-6 col-md-6  col-xs-6">
		<h3>Editar vivienda: {{$vivienda->direccion}}</h3>
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
	<form class="form" action="{{route('vivienda.update', $vivienda->idvivienda)}}" method="POST" autocomplete="off" >
				@method('PUT')
			<div class="form-group">
				<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
				<label for="direccion">direccion</label>
				<input type="text" name="direccion" class="form-control" required value="{{$vivienda->direccion}}">
			</div>
		
			<div class="form-group">
				<label for="numeromedidor">numero de medidor</label>
				<input type="number" name="numeromedidor" class="form-control" required min="1" value="{{$vivienda->numeromedidor}}">
			</div>
			<div class="form-group">
									<label for="idsubsidio">subsidio</label>
									<select name="idsubsidio" class="form-control selectpicker " data-live-search="true">
										<option value="" > seleccione </option>
										@foreach ($subsidios as $s)
										@if($s->idsubsidio == $vivienda->idsubsidio)
										<option value="{{$s->idsubsidio}}" selected> {{$s->tipodesubsidio}} </option>
										@else
										<option value="{{$s->idsubsidio}}"> {{$s->tipodesubsidio}} </option>
										@endif
										@endforeach
									</select>
								</div>
	
		<div class="form-group">
			<button class="btn btn-primary" class="form-control" type="submit">guardar</button>
			<a href="{{url('vivienda')}}" class="btn btn-danger">cancelar</a>
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
                  <li class="breadcrumb-item"><a href="{{url('vivienda')}}">Vivienda</a></li>
                  <li class="breadcrumb-item active">editar</li>
                </ol>
              </div><!-- /.col -->
               </div>
@endsection