@extends('layouts.app')
@section('contenido')

<div class="card text-left">
	<div class="card-header">
		<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h2>Listado de saldos registrados</h2>
			
		</div>	
	</div>
  <div class="card-body">
		
<div class="row">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		@include('Administracion.saldodiferenciado.search')
		<div class="table-responsive pt-1">
			<table class="table table-striped table-condensed table-hover" id="tablasaldo">
				<thead>
					<th>Id</th>
					<th>Tipo</th>
					<th>Descripción</th>
					<th>Monto</th>
					<th>Vivienda</th>
					<th>Opciones</th>
				</thead>
				<tbody>
				@foreach($saldodiferenciados as $s)
 					<tr>
 						<td>{{$s->idsaldodiferenciado}}</td>
 						<td>{{$s->tipo}}</td>
 						<td>{{$s->descripcion}}</td>
 						<td>{{$s->monto}}</td>
 						<td>{{$s->direccion}}</td>
 					<td>
 						<a href="{{route('saldodiferenciado.edit',$s->idsaldodiferenciado)}}"><button class=" btn boton-info"><i class="fas fa-pen"></i></button></a>
 				
 							<a href="" data-target="#modal-delete-{{$s->idsaldodiferenciado}}" data-toggle="modal"><button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></a>
 							@include('administracion.saldodiferenciado.modal')
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
  $("#menusaldo").addClass("active");
   $('#tablasaldo').DataTable({
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