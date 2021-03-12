@extends('layouts.app')
@section('contenido')
    <div class="card ">
   
      <div class="card-body" style="display: block">
          <div class="col-md-4" style="float: right">
            <div class="form-inline ">
                <label for="year">Seleccionar Año</label>
                <select name="year" id="year" class="form-control" style="margin-left: 5px; margin-right:5px">
                    @for ($i = 0; $i < 5; $i++)
                    <option  value="{{ date("Y")-$i}}">{{ date("Y")-$i}}</option>
    
                    @endfor
                </select>
                <button class="btn btn-primary" >Actualizar</button>
            </div>
          </div>
        
      </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Estadísticas de Consumo de agua Comite Buli Oriente</h3>
            <h4 class="text-center">Vivienda: {{ $vivienda->direccion }}</h4>
        </div>

        <div class="card-body">

            <div class="box box-primary">
                
                <div class="box-body">
                    <div class="chart">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('estilos')
    <link rel="stylesheet" href="{{ url('adminlte/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables/jquery.datatables.min.css') }}">
    <link href="{{ asset('css/factura.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="{{ url('adminlte/plugins/datatables/jquery.datatables.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/sweetalert2/sweetalert2@10.js') }}"></script>

    <script>
        $(document).ready(function() {
            //quitamo lo active anteriores y reponemos los neesarios
            $(".nav-link").removeClass("active");
            $(".administradorpositivoidentificador").addClass("active");
            $("#facturacionopcionabrircerrar").removeClass("menu-open");
            $("#administracionopcionabrircerrar").removeClass("menu-open");
            //agregamos el active de la seccion
            $("#menuestadisticasdeconsumo").addClass("active");
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

            
        });

    </script>
    <script>
         var todayYear =new Date().getFullYear();
        function cargar(year){

        
           var js_variable = <?php echo json_encode($consumos); ?>; 
           
            var data= ([0,0,0,0,0,0,0,0,0,0,0,0]);

            for (let index = 0; index < js_variable.length; index++) {
                const element = js_variable[index];
               // console.log(element["fechadeingreso"]);
                let medicion=element["valordemedicion"];
                let stringdate=element["fechadeingreso"];
                let month = parseInt(stringdate.substring(6,7));
                let year2 = parseInt(stringdate.substring(0,4));
                for (let i = 0; i < data.length; i++) {
                   
                    if (month==(i+1) && year2==year) 
                    {
                        if (data[i-1]) {
                            data[i]=medicion-data[i-1];
                        }else{
                            data[i]=medicion;
                        }
                     
                    }
                    
                }
               
                
            }
            console.log(data.every(item => item === 0));
            if (data.every(item => item === 0)) {
                
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'En este año no se han registrado consumos',
                    showConfirmButton: false,
                    timer: 1500
                });
               
                setTimeout(() => {
                    $('#year').prop('selectedIndex',0);
                  
                }, 2000);
            }
            var myChart2 = document.getElementById('myChart2').getContext('2d');
           

            var massPopChart = new Chart(myChart2, {
                type: 'horizontalBar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                data: {
                    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto",
                        "Septiembre", "Octubre", "Noviembre", "Diciembre"
                    ],
                    datasets: [{
                        label: 'consumo',
                        data: data,
                        //backgroundColor:'green',
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)',
                            'rgba(255, 99, 132, 0.6)',

                        ],
                        borderWidth: 1,
                        borderColor: '#777',
                        hoverBorderWidth: 3,
                        hoverBorderColor: '#000'
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Consumo Anual de metros cúbicos de '+$("#year").val(),
                        fontSize: 25
                    },
                    legend: {
                        display: false,
                        position: 'right',
                        labels: {
                            fontColor: '#000'
                        }
                    },
                    responsive: true,
                    tooltips: {
                        enabled: true
                    }
                }
            });

        }
   
    cargar(year=todayYear);
      $("#year").change(function(){
          year= $("#year").val();
        cargar(year); 
      
    });
         
           

    </script>
@endpush
