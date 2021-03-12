@extends('layouts.app')
@section('contenido')
<div class="row">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 mx-auto">
		<h3>Listado de mediciones pendientes</h3>
        <div class="contenido" style="display: block">
         <a href="{{route('medicion.indexencargado')}}" class="btn btn-danger" style="float: right" > Volver  <i class="fas fa-back"></i></a>
    </div>
	</div>	
</div>
<div class="row mt-2 ml-1">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover" id="tablamedicion">
				<thead>
					<th>Vivienda</th>
                    <th>Registro</th>
					<th>opciones</th>
				</thead>
				<tbody>
				@foreach($viviendas as $v)
 					<tr>
 						
 						<td>{{$v->direccion}}</td>
                         <td>
                            @foreach ($mediciones as $medicion)
                                @if($medicion->idvivienda==$v->idvivienda)
                                    {{$medicion->valordemedicion}}
                           

                         </td>
 					<td>
 							<a href="{{route('medicion.edit',$medicion->idmedicion)}}"><button class=" btn btn-info"><i class="fas fa-pencil"></i></button></a>

 						</td>
 					</tr>
                     @endif
                     @endforeach
 					@endforeach
				</tbody>
 			</table>
 		</div>	
 	</div>
 </div>



@endsection 

@push('scripts')

@endpush