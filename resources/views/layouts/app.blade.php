<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Styles -->
  <title>Administracion APR</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{url('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('adminlte/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @stack('estilos')
</head>
@if(auth()->user()!=null)
<body class="hold-transition sidebar-mini" style="width: 98%;">
  <div id="app"></div>
  <div class="wrapper">
    <div class="row">
      <div class="col">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light ">
          <!-- Left navbar links -->
          <ul class="navbar-nav ">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="col">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light ">
          <!-- Left navbar links -->
          <ul class="navbar-nav ">
            <li class="nav-item">
              <a class="nav-link"  role="button" href="{{url('home')}}"><i class="fas fa-user"></i> 
                {{auth()->user()->name}}
              </a>
            </li>
            <li class="nav-item">
              <a id="navbarDropdown" role="button" class="btn btn-warning" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              cerrar sesion ({{ __('Logout') }})
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
               @csrf
              </form>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">Administracion APR</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
<!-- Add icons to the links using the .nav-icon class
  with font-awesome or any other icon font library -->
  @if(Auth::user()->Rol=='admin')

  <li class="nav-item has-treeview menu-open" id="administracionopcionabrircerrar">
    <span class="nav-link active administradorpositivoidentificador">
      <i class="nav-icon  fas fa-laptop"></i>
      <p>
        Administracion
        <i class="right fas fa-angle-left"></i>
      </p>
    </span>

    <ul class="nav nav-treeview" #administration>
           <li class="nav-item">
        <a href="{{url('valorm3')}}" id="menuvalor" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Adm. Valor por m3 </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('subsidio')}}" id="menusubsidio" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Adm. Subsidios</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('representante')}}" id="menurepresentante" class="nav-link ">
          <i class="far fa-circle nav-icon"></i>
          <p>Adm. Socios</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('vivienda')}}" id="menuvivienda" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Adm. viviendas</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('saldodiferenciado')}}" id="menusaldo" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Adm.  saldos diferidos</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('medicion')}}" id="menumedicion" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Adm. medicion</p>
        </a>
      </li>
      @endif
      @if( Auth::user()->Rol=="encargado")
      <li class="nav-item has-treeview menu-open" id="administracionopcionabrircerrar">
       

        <a href="{{url('medicionEncargado')}}" id="menumedicion2" class="nav-link">
          <i class="far fa-angle-right nav-icon"></i>
          <p>Adm. medicion</p>
        </a>
      </li>
      @endif()
    </ul>
  </li>
  @if(Auth::user()->Rol=="admin")
  <li class="nav-item has-treeview menu-open" id="facturacionopcionabrircerrar">
    <a href="#" class="nav-link active administradorpositivoidentificador">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
        Facturación
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{url('cupondepago')}}" class="nav-link" id="menucupondepago">
          <i class="far fa-circle nav-icon"></i>
          <p>Generar cupon de pago</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('facturacion')}}" class="nav-link" id="menufacturacion">
          <i class="far fa-circle nav-icon"></i>
          <p>Ingresar pago</p>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item has-treeview menu-open" id="reportesopcionabrircerrar">
    <a href="#" class="nav-link active administradorpositivoidentificador">
      <i class="nav-icon fas fa-book"></i>
      <p>
        Reportes
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{url('estadodecuentas')}}" class="nav-link" id="menuestadodecuenta">
          <i class="far fa-circle nav-icon"></i>
          <p>Ver estado de cuentas</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('Historialdeconsumos')}}" class="nav-link" id="menuhistorialdeconsumo">
          <i class="far fa-circle nav-icon"></i>
          <p>Historial de Consumos</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('estadisticasdeconsumos')}}" class="nav-link" id="menuestadisticasdeconsumo">
          <i class="far fa-circle nav-icon" ></i>
          <p> Estadisticas de Consumos</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('reportesdepagos')}}" class="nav-link" id="menureportesdepago">
          <i class="far fa-circle nav-icon"></i>
          <p>Reportes de pago</p>
        </a>
      </li>
    </ul>
  </li>
  @endif
  @if( Auth::user()->Rol=="socio")
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <li class="nav-item has-treeview menu-open" id="reportesopcionabrircerrar">
    <a href="#" class="nav-link active administradorpositivoidentificador">
      <i class="nav-icon fas fa-book"></i>
      <p>
        Reporte
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{url('estadodecuenta')}}" class="nav-link" id="menuestadodecuenta">
          <i class="far fa-circle nav-icon"></i>
          <p>Ver estado de cuenta</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('Historialdeconsumo')}}" class="nav-link" id="menuhistorialdeconsumo">
          <i class="far fa-circle nav-icon"></i>
          <p>Historial de consumo</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('estadisticasdeconsumo')}}" class="nav-link" id="menuestadisticasdeconsumo">
          <i class="far fa-circle nav-icon" ></i>
          <p> Estadisticas de Consumo</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('reportesdepago')}}" class="nav-link" id="menureportesdepago">
          <i class="far fa-circle nav-icon"></i>
          <p>Reportes de pago</p>
        </a>
      </li>
    </ul>
  </li>
</ul>
</nav>
</div>
  @endif

<!-- /.sidebar -->
</aside>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      @yield('ubicacion')
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      @include('sweetalert::alert')

      @yield('contenido')
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Main Footer -->
<footer class="main-footer">
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{url('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('adminlte/dist/js/adminlte.min.js')}}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
@else
<body style="background-image:url('{{url('imagenes/APR-campoflux.png')}}'); margin-top: 50px">
  <div class="container" >
    <div class="row justify-content-center">
      <div class="col-md-8 ">
        <div class="card mt-5" id="login">
          <div class="card-header"> <b> Ingresar a: Sistema administracion APR <strong> Buli Oriente</strong> San carlos </b></div>

          <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
              @csrf

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Correo Electrónico</label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                      Recuerdame
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    Entrar
                  </button>

                  @if (Route::has('password.request'))
                  <a class="btn btn-link" href="{{ route('password.request') }}">
                    ¿Olvido su contraseña?
                  </a>
                  @endif
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
      <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card mt-2">
        <div class="card-header">
           <h5 class="card-title">¿es miembro del comite? registrese aqui.</h5>
        </div>
       <div class="card-body">
        <a href="{{route('registro')}}" class="btn btn-success">registrar</a>
       </div>
      </div>
    </div>   
  </div>
  </div>

</div>
</body>


@endif
</html>
