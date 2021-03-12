@extends('layouts.app')
@section('contenido')


<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2>Listado de mediciones</h2>
			</div>	
		</div>
	</div>
  <div class="card-body">

	<div class="row mt-2 ml-1">
		<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
			@include('Administracion.medicion.search')

			<div class="table-responsive pt-2">
				<table class="table table-striped table-condensed table-hover" id="tablamedicion">
					<thead>
						<th>Id</th>
						<th>Inscriptor</th>
						<th>Valor</th>
						<th>Fecha de ingreso</th>
						<th>Vivienda</th>
						<th>Opciones</th>
					</thead>
					<tbody>
					@foreach($mediciones as $m)
						 <tr>
							 <td>{{$m->idmedicion}}</td>
							 <td>{{$m->inscriptor}}</td>
							 <td>{{$m->valordemedicion}}</td>
							 <td>{{$m->fechadeingreso}}</td>
							 <td>{{$m->direccion}}</td>
						 <td>
							 <a href="{{route('medicion.edit',$m->idmedicion)}}"><button class=" btn boton-info"><i class="fas fa-pen"></i></button></a>
					 
								 <a href="" data-target="#modal-delete-{{$m->idmedicion}}" data-toggle="modal"><button class=" btn btn-danger"><i class="fas fa-trash-alt"></i></button></a>
								 @include('administracion.medicion.modal')
							 </td>
						 </tr>
	
						 @endforeach
					</tbody>
				 </table>
			 </div>	
		 </div>
	 </div>
  </div>
</div>

 @endsection
@push('estilos')
  <link rel="stylesheet" href="{{url('adminlte/plugins/datatables/jquery.datatables.min.css')}}">
@endpush
@push('scripts')
 <script src="{{url('adminlte/plugins/datatables/jquery.datatables.min.js')}}"></script>
<script >
$( document ).ready(function() {
	//quitamo lo active anteriores y reponemos los neesarios
	$(".nav-link").removeClass("active");
	$(".administradorpositivoidentificador").addClass("active");
    $("#reportesopcionabrircerrar").removeClass("menu-open");
    $("#facturacionopcionabrircerrar").removeClass("menu-open");
//agregamos el active de la seccion
  $("#menumedicion").addClass("active");
    $('#tablamedicion').DataTable({
    			  searching: true,
    			  paging:true,
                language: {
                    processing: "Tratamiento en curso...",
                    search: "Buscar&nbsp;:",
                    lengthMenu: "Agrupar de _MENU_ items",
                    info: "Mostrando del item _START_ al _END_ de un total de _TOTAL_ items",
                    infoEmpty: "No existen datos.",
                    infoFiltered: "(filtrado de _MAX_ elementos en total)",
                    infoPostFix: "",
                    loadingRecords: "Cargando...",
                    zeroRecords: "No se encontraron datos con tu busqueda",
                    emptyTable: "No hay datos disponibles en la tabla.",
                    paginate: {
                        first: " Primero ",
                        previous: " Anterior ",
                        next: " Siguiente ",
                        last: " Ultimo "
                    },
                    aria: {
                        sortAscending: ": active para ordenar la columna en orden ascendente",
                        sortDescending: ": active para ordenar la columna en orden descendente"
                    }
                },
                scrollY: 200,
                lengthMenu: [ [3,7,-1], [3,7,"todos"] ],
            });
});
</script>
@endpush