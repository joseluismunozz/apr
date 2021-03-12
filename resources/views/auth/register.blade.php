<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <title>Administracion APR</title>
   <!-- Font Awesome Icons -->
   <link rel="stylesheet" href="{{url('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
   <!-- Theme style -->
   <link rel="stylesheet" href="{{url('adminlte/dist/css/adminlte.min.css')}}">
   <!-- Google Font: Source Sans Pro -->
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <script src="{{url('adminlte/plugins/jquery/jquery.min.js')}}"></script>
</head>
<body style="background-image:url('{{url('imagenes/APR-campoflux.png')}}'); margin-top: 50px">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">Registro de usuarios</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                                    <label for="vivienda">Seleccione su direccion</label>
                                    <select name="idvivienda" id="idvivienda"class="form-control selectpicker " data-live-search="true" onchange="cargaremail();">
                                        <option value="" > seleccione.. </option>
                                        @foreach ($viviendas as $v)
                                        <option value="{{$v->idvivienda}}"> {{$v->direccion}} </option>
                                        @endforeach
                                    </select>
                                </div>
                        <div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required  readonly>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo electronico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required  readonly >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
$( document ).ready(function() {
    });
function cargaremail(){
let representantes=@json($representantes);
let id=$("#idvivienda").val();
for (let i = 0; i < representantes.length; i++) {
    if(representantes[i].idvivienda==id){
        $('#email').val(representantes[i].email);
        $('#name').val(representantes[i].nombre);
           
    }
}
};
    
</script>
</html>
