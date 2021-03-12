@extends('layouts.app')
@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">pagar factura por: ${{$cupondepago->idvalor}}, fecha{{$cupondepago->fecha}}, de la vivienda: {{$vivienda->direccion}}</h3>
        </div>
    
        <div class="card-body">
        	<div class="form-group text-center">
        		<label>El saldo adeudado en esta factura haciende a:{{$factura->totalcobrado}} y posee ademas un(a) multa/haber de: ${{$deuda}}</label>
        	</div>
        	
            <div class="form-group">
                <div class="lg-3">
                    <a href="{{ route('factura.ingresarpago', $factura->idfactura) }}"><button class="btn btn-success form-control ">pagar factura completa</button></a>
                </div>
            </div>
            <div class="form-group">
                <div class="lg-3">
                    <form class="form-group" action="{{Route("factura.abonar")}}" method="post">
                        @csrf
                        <input type="hidden" name="idvivienda" value="{{$factura->idvivienda}}">
                        <input type="hidden" name="idfactura" value="{{$factura->idfactura}}">
                        <input type="number" required name="monto" class="form-control" placeholder="$monto a abonar" max="{{$factura->totalcobrado}}" min="1">
                        <button type="submit" class="btn btn-warning form-control ">abonar a la cuenta</button>
                    </form>
                   
                </div>
            </div>
            <div class="form-group">
                @if($deuda>0)
                <div class="lg-3">
                    <form class="form-group" action="{{Route("factura.deuda")}}" method="post">
                        @csrf
                        <input type="hidden" name="idvivienda" value="{{$factura->idvivienda}}">
                        <input type="number"  required name="monto" class="form-control" placeholder="$monto a abonar en la multa" max="{{$deuda}}" min="1">
                        <button type="submit" class="btn btn-success form-control ">pagar multa</button>
                    </form>
                </div>
                @endif
            </div>
            <div class="form-group">
                @if($deuda<0)
                <div class="lg-3">
                    <a href="{{ route('factura.unir', [$factura->idvivienda , $factura->idfactura]) }}"><button class="btn btn-success form-control ">unir saldo a favor a factura</button></a>
                </div>
                @endif
            </div>
        </div>
    </div>


@endsection
 @push('estilos')
    <link rel="stylesheet" href="{{url('adminlte/plugins/sweetalert2/sweetalert2.min.css')}}">
    <link href="{{ asset('css/factura.css') }}" rel="stylesheet">
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
  $("#menufacturacion").addClass("active");
});
</script>
@endpush