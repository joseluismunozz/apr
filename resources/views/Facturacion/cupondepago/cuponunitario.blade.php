 @extends('layouts.app')
@section('contenido')
  <link rel="stylesheet" href="{{url('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{url('adminlte/dist/css/adminlte.min.css')}}">

      <div class="row">

      	<div class="card col-md-9 mx-auto">

      		<div class="card-body">
      			  <form method="get" id="formulario" action="{{route('cupondepago.exportarparticular')}}">
      			   <input type="hidden" name="nombre" value="{{$nombre}}">
                   <input type="hidden" name="direccion" value="{{$direccion}}">
            	     <input type="hidden" name="fecha" value="{{$fecha}}">
                   <input type="hidden" name="lecturaanterior" value="{{$lecturaanterior}}">
                   <input type="hidden" name="lecturaactual" value="{{$lecturaactual}}">
                   <input type="hidden" name="valorm3" value="{{$valorm3}}">
                   <input type="hidden" name="m3" value="{{$m3}}">
                   <input type="hidden" name="vivienda" value="{{$vivienda}}">
                   <input type="hidden" name="multa" value="{{$multa}}">
                   <input type="hidden" name="totaldelmes" value="{{$totaldelmes}}">
                   <input type="hidden" name="totalfinal" value="{{$totalfinal}}">
                   <input type="hidden" name="subsidio" value="{{$subsidio.'%'}}">
                   <a class="btn btn-danger" href="{{route('cupondepago.index')}}">Volver</a>
      			       <button class="btn btn-success"  id="alertarfacturacionparticular" type="button">Exportar a pdf</a>

      			</form>

      		</div>
      	</div>
      </div>
<div class="row">
    <div class="card col-md-9 mx-auto">
        <div class="card-header">
            <h3 class="text-center">COMITE DE AGUA POTABLE RURAL <br>
                <b>"BULI ORIENTE"</b></h3>
        </div>
        <div class="card-body">
            <div class="form-inline float-right">
                <label class="form-label" for="date">Fecha de emisión: </label>
                <input class="from-control" id="fecha" name="fecha" type="text" value=" {{$fecha}}" disabled>
            </div>
            <div class="clearfix"></div>
                <div class="title">
                    <h2 class="text-center pt-2">Cupón de Pago</h4>
                </div>              

          
                <div class="">
                    <label class="form-label ml-4"for="name">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-comtrol col-9" disabled  value="{{$nombre.', '.$direccion}}">
                  
                </div>
            
           
            <div class="row">
               <div class="col-md-9 mx-auto">
                <table style="width: 100%">
                    <tr>
                        <td>
                            <label class="form-label" for="prev">Lectura Anterior</label>
                            <input type="number" name="lecturaanterior" class="form-control"disabled value="{{$lecturaanterior}}">
                        </td>
                        <td>
                            <label class="form-label" for="today">Lectura Actual</label>
                            <input type="number" name="lecturaactual" disabled class="form-control" value="{{$lecturaactual}}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="currentMonth" class="form-label">Total del Mes</label>
                            <input type="number" disabled class="form-control" name="totaldelmes" value="{{$totaldelmes}}">
                        </td>
                        <td>
                            <label class="form-label" for="m3">M<sup>3</sup></label>
                            <input type="number" class="form-control" name="m3" disabled value="{{$m3}}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="currentMonthPrev" class="form-label">Mes Anterior</label>
                            <input type="number" disabled class="form-control" name="currentMonthPrev" value="0">
                        </td>
                        <td>
                            <label class ="form-label" for="subsidio">Subsidio</label>
                            <input type="text" disabled name="subsidio" class="form-control" value="{{$subsidio}}">
                
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="multa" class="form-label">Saldo a favor/ en contra</label>
                            <input type="text" class="form-control" disabled name="multa" value="{{$multa}}">
                        </td>
                        <td>
                            <label for="total" class="form-label">Total</label>
                            <input type="number" class="form-control" name="totalfinal" disabled value="{{$totalfinal}}">
                        </td>
                    </tr>
                   
                </table>
                <span class="text-center">FECHA DE PAGO: Del 01 al 15 de cada mes.- HORARIO: 09:00-13:00</span>
                    
               </div>
            
            </div>
        </div>
    </div>

</div>

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
  $("#alertarfacturacionparticular").click(function(){
    Swal.fire({
  title: '¿estas seguro que deseas exportar? se generaran la deuda si lo haces',
  showDenyButton: true,
  showCancelButton: false,
  confirmButtonText: `exportar`,
  denyButtonText: `cancelar`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    Swal.fire('exportado!', 'cobros confirmado y deuda listas para pagar', 'success')
    //submit
    $("#formulario").submit();
  } else if (result.isDenied) {
    Swal.fire('cancelado', 'no se genero deuda', 'info')
  }
})
  });
});
</script>
@endpush