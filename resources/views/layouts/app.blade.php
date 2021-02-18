<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title> @yield('tittle', 'AlVenta, tu lugar de intercambios')

  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">


  <!-- CSS Files -->
  <link href="{{asset('css/material-kit.css?v=2.0.7')}}" rel="stylesheet" />

  <!--Estilos de Welcome.Blade.php-->
  @yield('styles')

</head>

<body class="@yield('body-class')">


  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="navbar-translate">
      <a class="navbar-brand" href="{{url('/')}}">
        LOGO INICIO </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
        </li>
        @endif
        @else

        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

            <a class="dropdown-item" href="{{ url('/home') }}">Dashboard</a>

            @if (auth()->user()->rol->id == 1)
            <a class="dropdown-item" href="{{ url('admin\products') }}">Gestionar Productos</a>
            @endif

            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              {{ __('Cerrar Sesión') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        @endguest

        <!--         <li class="nav-item">
          <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank" data-original-title="Follow us on Twitter" rel="nofollow">
            <i class="fa fa-twitter"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://www.facebook.com/CreativeTim" target="_blank" data-original-title="Like us on Facebook" rel="nofollow">
            <i class="fa fa-facebook-square"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank" data-original-title="Follow us on Instagram" rel="nofollow">
            <i class="fa fa-instagram"></i>
          </a>
        </li> -->
      </ul>
    </div>
  </nav>

  <div class="wrapper">
    @yield('content')
  </div>

  <!--   Core JS Files   -->
  <script src="{{asset('js/core/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('js/core/popper.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('js/core/bootstrap-material-design')}}.min.js" type="text/javascript"></script>
  <script src="{{asset('js/plugins/moment.min.js')}}"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="{{asset('js/plugins/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{asset('js/plugins/nouislider.min.js')}}" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('js/material-kit.js?v=2.0.7')}}" type="text/javascript"></script>
</body>

</html>