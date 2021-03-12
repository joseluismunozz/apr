

<div class="modal fade" id="modal-delete-{{$s->idsubsidio}}">
 <form action="{{ route('subsidio.destroy', $s->idsubsidio) }}" method="POST">
  @method('DELETE')
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
      ¿Desea Eliminar <strong>{{ $s->tipodesubsidio }}</strong>?
     </p>
     <i class="fas fa-exclamation-circle fa-5x" style="color:#17a2b8"></i>

    </div>
    <div class="form-inline mx-auto m-3">
     <button type="button" style="width:120px"class="btn btn-danger mr-2" data-dismiss="modal">
      Cerrar
     </button>
     <button type="submit" style="width:120px" class="btn btn-primary mr-2">Confirmar</button>
    </div>
   </div>
  </div>
 </form>
</div>


