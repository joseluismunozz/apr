@extends('layouts.app')
@section('contenido')
<div class="row">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 mx-auto">
		<h3>Listado de mediciones pendientes</h3>
        <div class="contenido" style="display: block">
         <a href="{{route('medicion.list')}}" class="btn btn-warning" style="float: right" > Corregir  <i class="fas fa-pencil"></i></a>
    </div>
	</div>	
</div>
<div class="row mt-2 ml-1">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover" id="tablamedicion">
				<thead>
					<th>Vivienda</th>
					<th>opciones</th>
				</thead>
				<tbody>
				@foreach($viviendas as $v)
 					<tr>
 						
 						<td>{{$v->direccion}}</td>
 					<td>
 							<a href="" data-target="#modal-create-{{$v->idvivienda}}" data-toggle="modal"><button class=" btn btn-danger"><i class="fas fa-paper-plane"></i></button></a>
 							@include('administracion.medicion.modalencargado')
 						</td>
 					</tr>

 					@endforeach
				</tbody>
 			</table>
 		</div>	
 	</div>
 </div>



@endsection 
@push('estilos')
@endpush
@push('scripts')
<script>
    $( document ).ready(function() {
        console.log("prueba");
        //quitamo lo active anteriores y reponemos los neesarios
        $(".nav-link").removeClass("active");
        $(".administradorpositivoidentificador").addClass("active");
        $("#reportesopcionabrircerrar").removeClass("menu-open");
        $("#facturacionopcionabrircerrar").removeClass("menu-open");
    //agregamos el active de la seccion
      $("#menumedicion2").addClass("active");
       
    });
    </script>
@endpush