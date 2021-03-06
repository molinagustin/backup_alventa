@extends('layouts.app')

@section ('body-class', 'login-page sidebar-collapse')

@section ('styles')
<style>
    .hide {
        visibility: hidden;
    }

    *,
    *::before,
    *::after {
        box-sizing: content-box;
    }

    *,
    *::before,
    *::after {
        box-sizing: content-box;
    }
</style>
@endsection

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('img/ecommerce.jpg') }}'); background-size: cover; background-position: top center; position: relative;display:grid;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                <div class="card card-login" style="height:60%;">

                    <form class="form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card-header card-header-primary text-center">
                            <h4 class="card-title">Inicio de Sesión</h4>
                        </div>
                        <p class="description text-center">Ingresá Tus Datos</p>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>
                                    {{$error}}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="card-body">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">mail</i>
                                    </span>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                            </div>
                            <br>
                            <div class="checkbox text-center">
                                <label style="padding-top: 20px;">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    Recordar sesión
                                </label>
                            </div>

                        </div>


                        <div class="text-center">
                            <br>
                            <button type="submit" class="btn btn-primary btn-link btn-wd btn-lg">INGRESAR</button>
                        </div>
                        <br><br><br><br><br><br><br><br><br><br>


                        <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a> -->
                    </form>
                </div>
            </div>
        </div>
    </div>


    @include('includes.footer')

</div>
@endsection