@extends('layouts.app')
@section('contenido')
<div class="row">
	<div class="col col-lg-6 col-md-6  col-xs-6">
		<h3>Editar valor: {{$valorm3->nombre}}</h3>
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
	<form class="form" action="{{route('valor.update', $valorm3->idValorM3)}}" method="POST" autocomplete="off" >
				@method('PUT')
			<div class="form-group">
				<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" class="form-control" required value="{{$valorm3->nombre}}">
			</div>
		
			<div class="form-group">
				<label for="descripcion">descripcion</label>
				<input type="textarea" name="descripcion" class="form-control" required value="{{$valorm3->descripcion}}">
			</div>
			
			<div class="form-group">
				<label for="precio">precio</label>
				<input type="number" name="precio" class="form-control" required value="{{$valorm3->precio}}">
			</div>
	
		<div class="form-group">
			<button class="btn btn-primary" class="form-control" type="submit">guardar</button>
			<a href="{{url('valorm3')}}" class="btn btn-danger">cancelar</a>
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
                  <li class="breadcrumb-item"><a href="{{url('valorm3')}}">Valor por metro cubico</a></li>
                  <li class="breadcrumb-item active">editar valor</li>
                </ol>
              </div><!-- /.col -->
               </div>
@endsection