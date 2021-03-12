@extends('layouts.app')
@section('contenido')
<!-- poner un for para la lista de todos los cupones a generar -->
  <link rel="stylesheet" href="{{url('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{url('adminlte/dist/css/adminlte.min.css')}}">
         <div class="row">
        <div class="card col-md-9 mx-auto">
            <div class="card-body">
                <a class="btn btn-success"   style="color:white" id="alertarfacturacion"> Exportar a PDF</a>
                <a class="btn btn-danger" href="{{route('cupondepago.index')}}">Volver</a>
            </div>
        </div>
      </div>
     @for ($i = 0; $i <$final ; $i++)
<div class="row">
    <div class="card col-md-9 mx-auto">
        <div class="card-header">
            <h3 class="text-center">COMITE DE AGUA POTABLE RURAL <br>
                <b>"BULI ORIENTE"</b></h3>
        </div>
        <div class="card-body">
            <div class="form-inline float-right">
                <label class="form-label" for="date">Fecha de emisión: </label>
                <input class="from-control" id="date" type="text" value=" {{$fecha}}" disabled>
            </div>
            <div class="clearfix"></div>
                <div class="title">
                    <h2 class="text-center pt-2">Cupón de Pago</h4>
                </div>              

          
                <div class="">
                    <label class="form-label ml-4"for="name">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-comtrol col-9" disabled  value="{{$lista[$i]['nombre'].', '.$lista[$i]['direccion']}}">
            

                </div>
            
           
            <div class="row">
               <div class="col-md-9 mx-auto">
                <table style="width: 100%">
                    <tr>
                        <td>
                            <label class="form-label" for="prev">Lectura Anterior</label>
                            <input type="number" class="form-control"disabled value="{{$lista[$i]['lecturaanterior']}}">
                        </td>
                        <td>
                            <label class="form-label" for="today">Lectura Actual</label>
                            <input type="number" name="today" disabled class="form-control" value="{{$lista[$i]['lecturaactual']}}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="currentMonth" class="form-label">Total del Mes</label>
                            <input type="number" disabled class="form-control" name="currentMonth" value="{{$lista[$i]['totaldelmes']}}">
                        </td>
                        <td>
                            <label class="form-label" for="m3">M<sup>3</sup></label>
                            <input type="number" class="form-control" name="m3" disabled value="{{$lista[$i]['m3']}}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="currentMonthPrev" class="form-label">Mes Anterior</label>
                            <input type="number" disabled class="form-control" name="currentMonthPrev" value="0">
                        </td>
                        <td>
                            <label class ="form-label" for="benefit">Subsidio</label>
                            <input type="text" disabled name="benefit" class="form-control" value="{{$lista[$i]['subsidio']}}">
                
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="mulct" class="form-label">Saldo a favor/ en contra</label>
                            <input type="text" class="form-control" disabled name="mulct" value="{{$lista[$i]['multa']}}">
                        </td>
                        <td>
                            <label for="total" class="form-label">Total</label>
                            <input type="number" class="form-control" name="total" disabled value="{{$lista[$i]['totalfinal']}}">
                        </td>
                    </tr>
                   
                </table>
                <span class="text-center">FECHA DE PAGO: Del 01 al 15 de cada mes.- HORARIO: 09:00-13:00</span>
                    
               </div>
            
            </div>
        </div>
    </div>

</div>
    @endfor
    @endsection
    @push('estilos')
    <link rel="stylesheet" href="{{url('adminlte/plugins/sweetalert2/sweetalert2.min.css')}}">
    @endpush
    @push('scripts')
    <script src="{{url('adminlte/plugins/sweetalert2/sweetalert2@10.js')}}"></script>

<script >
$( document ).ready(function() {
    //quitamo lo active anteriores y reponemos los neesarios
    $(".nav-link").removeClass("active");
    $(".administradorpositivoidentificador").addClass("active");
    $("#reportesopcionabrircerrar").removeClass("menu-open");
    $("#administracionopcionabrircerrar").removeClass("menu-open");
//agregamos el active de la seccion
  $("#menucupondepago").addClass("active");
  $("#alertarfacturacion").click(function(){
    Swal.fire({
  title: '¿estas seguro que deseas exportar? se generaran las deudas si lo haces',
  showDenyButton: true,
  showCancelButton: false,
  confirmButtonText: `exportar`,
  denyButtonText: `cancelar`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    Swal.fire('exportados!', 'cobros confirmados y deudas listas para pagar', 'success')
    //redirigir
    window.location.href="{{route('cupondepago.exportartodos')}}";
  } else if (result.isDenied) {
    Swal.fire('cancelado', 'no se generaron deudas', 'info')
  }
})
  });
});
</script>
@endpush