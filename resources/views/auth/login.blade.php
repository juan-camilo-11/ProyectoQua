@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg bg-body-tertiary nav-inicio">
  <div class="container-fluid nav-inicio-div">
    <a class="navbar-brand" href="/">
      <img src="{{ asset('img/logo-blanco.svg') }}" alt="Logo de Qua"> &nbsp;&nbsp;Qua</a>
      <ul>
      <li class="nav-item">
          <a class="nav-link btn-principal text-center" href="{{route('register')}}">Registrarse</a>
        </li>
  </ul>
  </div>
</nav>
<div class="login">
    <div class="row row-login">
        <div class="col login-form">
            <form method="POST" action="{{ route('login') }}" class="d-flex justify-content-center align-items-center">
                @csrf
                <div class="col-12">
                    <div class="row">
                            <label for="email" class="col-md-4 col-form-label text-md-end my-3">Correo: </label>
                            <div class="col-md-6 my-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                    </div>
                    <div class="row">
                 
                        <label for="password" class="col-md-4 col-form-label text-md-end my-3">Contraseña: </label>
                     
                            
                            <div class="col-md-6 my-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                    </div>
                    
                    <div class="row login-form-btn mx-auto">
                            <button type="submit" class="btn btn-primary my-3">
                                    Iniciar Sesion
                            </button>
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Olvidaste la contraseña?.
                            </a>
                            @endif
                  
                    </div>
                </div>
            </form>
        </div>
        <div class="col login-img">
            <img src="{{ asset('img/gatoimg.jpg') }}" alt="">
        </div>
    </div>

</div>
@endsection