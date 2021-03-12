

<div class="modal fade" id="modal-delete-{{$v->idValorM3}}">
 <form action="{{ route('valor.destroy', $v->idValorM3) }}" method="POST">
  @method('DELETE')
  @csrf
  <div class="modal-dialog modal-dialog-centered" style=" transform: translate(0,50%)" >
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
     </button>

    </div>
    <div class="modal-body text-center">
     <p style="font-size: 20px">
      ¿Esta seguro de modificar el valor actual ?
     </p>
     <i class="fas fa-exclamation-circle fa-5x" style="color:#17a2b8"></i>
 
    </div>
    <div class="form-inline mx-auto m-3">
     <button type="button" class="btn btn-danger mr-3" style="width:120px;" data-dismiss="modal">
      Cerrar
     </button>
     <button type="submit" class="btn btn-primary mr-3" style="width:120px;">Confirmar</button>
    </div>
   </div>
  </div>
 </form>
</div>


