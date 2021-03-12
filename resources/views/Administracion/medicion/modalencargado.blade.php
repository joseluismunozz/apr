

<div class="modal fade" id="modal-create-{{$v->idvivienda}}">
    <form action="{{ route('medicion.store') }}" method="POST">
     @csrf
     <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
        </button>
       </div>
       <div class="modal-body text-center">
        <p style="font-size: 20px">
        <form >
            <label for="valordemedicion">Registre el valor de la vivienda: {{$v->direccion}}</label>
            <input type="number" name="valordemedicion" class="form-control">
            <input type="hidden" name="idvivienda" value="{{$v->idvivienda}}">
            <input type="hidden" name="idinscriptor" value="{{Auth::user()->id}}">
        </form>

        </p>
        <i class="fas fa-exclamation-circle fa-5x" style="color:#17a2b8"></i>
   
       </div>
       <div class="form-inline mx-auto m-3">
           <button type="button" style="width:120px;" class="btn btn-danger mr-2" data-dismiss="modal">
               Cerrar
              </button>
           <button type="submit" style="width:120px" class="btn btn-primary">Confirmar</button>
            
       </div>
       </div>
     </div>
    </form>
   </div>
   
   
   