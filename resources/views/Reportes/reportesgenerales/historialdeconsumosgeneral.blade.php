@extends('layouts.app')
@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Historial de consumo comite buli oriente</h3>
        </div>
    
        <div class="card-body">
            <table class="table table-striped table-condensed" id="tablavivienda">
              <thead>
                    <th>Id</th>
                    <th>Dirección</th>
                    <th>Número de medidor</th>
                 
                    <th>Opciones</th>
                </thead>
                <tbody>
                @foreach($viviendas as $v)
                    <tr>
                        <td>{{$v->idvivienda}}</td>
                        <td>{{$v->direccion}}</td>
                        <td>{{$v->numeromedidor}}</td>
                     
                    <td>
                        <a href="{{route('reporte.Historialdeconsumoaa',$v->idvivienda)}}"><button class="btn btn-info"><i class="fa fa-eye fa-2x"></i></button></a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
 @push('estilos')
    <link rel="stylesheet" href="{{url('adminlte/plugins/sweetalert2/sweetalert2.min.css')}}">
    <link href="{{ asset('css/factura.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('adminlte/plugins/datatables/jquery.datatables.min.css')}}">
    @endpush
    @push('scripts')
    <script src="{{url('adminlte/plugins/sweetalert2/sweetalert2@10.js')}}"></script>
         <script src="{{url('adminlte/plugins/datatables/jquery.datatables.min.js')}}"></script>

<script >
$( document ).ready(function() {
    //quitamo lo active anteriores y reponemos los neesarios
    $(".nav-link").removeClass("active");
    $(".administradorpositivoidentificador").addClass("active");
     $("#facturacionopcionabrircerrar").removeClass("menu-open");
    $("#administracionopcionabrircerrar").removeClass("menu-open");
//agregamos el active de la seccion
  $("#menuhistorialdeconsumo").addClass("active");
   $('#tablavivienda').DataTable({
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
                scrollY: 250,
                lengthMenu: [ [5,10,15,20,-1], [5,10,15,20,"todos"] ],
            });
});
</script>
@endpush