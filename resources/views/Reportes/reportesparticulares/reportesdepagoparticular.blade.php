@extends('layouts.app')
@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">reportes de pago comite buli oriente</h3>
            <h4 class="text-center">Vivienda: {{ $vivienda->direccion }}</h4>
        </div>

        <div class="card-body">
            <div class="dates" style="display: block">

                <div class="elements " style="float: right">
                    <form action="{{ route('reporte.reportespagorango') }}" method="post">
                        <label for="" style="margin-right: 5px">Seleccione rango de fechas </label>
                        @csrf
                        <input id="datepicker1" autocomplete="off" class="datepickers" placeholder="desde.." name="desde"
                            width="276" required />
                        <input type="hidden" name="idvivienda" value="{{ $vivienda->idvivienda }}">
                        <input id="datepicker2" autocomplete="off" class="datepickers" placeholder="hasta.." name="hasta"
                            width="276" required />
                        <button id="search" class="btn btn-primary"> <i class="far fa-search"
                                style="margin-right: 5px"></i>Buscar</button>
                    </form>

                </div>

                <table class="table table-striped table-condensed" id="facturas">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Fecha</th>
                            <th>Total Cobrado</th>
                            <th>Estado de pago</th>
                        </tr>

                    </thead>
                    <tbody>
                        @if ($facturas->count() == 0)
                            <tr>
                                <td colspan="4" class="text-center">
                                    Ningun dato encontrado
                                </td>
                            </tr>
                        @endif
                        <tr>
                            @foreach ($facturas as $index => $factura)
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $factura->fecha }}</td>
                                <td>{{ '$ ' . $factura->totalCobrado }}</td>
                                <th
                                    class=" text-bold {{ $factura->estadodepago == 'pagado' ? 'text-green' : 'text-red' }}">
                                    {{ $factura->estadodepago }}</th>
                            @endforeach
                        </tr>

                    </tbody>
                </table>

            </div>

        </div>
    </div>


@endsection
@push('estilos')
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="{{ url('adminlte/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link href="{{ asset('css/factura.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables/jquery.datatables.min.css') }}">
@endpush
@push('scripts')

    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
    <script src="{{ url('adminlte/plugins/sweetalert2/sweetalert2@10.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables/jquery.datatables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            //quitamo lo active anteriores y reponemos los neesarios
            $(".nav-link").removeClass("active");
            $(".administradorpositivoidentificador").addClass("active");
            $("#facturacionopcionabrircerrar").removeClass("menu-open");
            $("#administracionopcionabrircerrar").removeClass("menu-open");
            //agregamos el active de la seccion
            $("#menureportesdepago").addClass("active");
            $('#tablavivienda').DataTable({
                searching: true,
                paging: true,
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
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "todos"]
                ],
            });
            $('#datepicker1').datepicker();
            $('#datepicker2').datepicker();
            $('#datepicker1').datepicker("option", "monthNames", [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]);
            $('#datepicker2').datepicker("option", "monthNames", [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]);
            $( "#datepicker1" ).datepicker( "option", "dayNamesMin", [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ] );
            $( "#datepicker2" ).datepicker( "option", "dayNamesMin", [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ] );
            $('#datepicker1').on("change", function() {
                var startVal = new Date($('#datepicker1').val());
                $('#datepicker2').datepicker("option", "minDate", startVal);
            });
            $('#datepicker2').on("change", function() {
                var endVal = new Date($('#datepicker2').val());
                $('#datepicker1').datepicker("option", "maxDate", endVal);
            });

        });

    </script>
@endpush
