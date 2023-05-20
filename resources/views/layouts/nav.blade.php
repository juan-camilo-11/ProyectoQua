@extends('layouts.app')

@section('content')
<div class="row contenido">
    <div class="col-2 nav" style="min-height: 100vh;">
        <nav class="w-100 navegacion d-flex flex-column justify-content-around">
            <a href="" class="logo">
                <img src="{{ asset('img/logo-blanco.svg') }}" alt="">
            </a>
            <a href="" class="btn-user"><i class="bi bi-person"></i><span> {{ auth()->user()->nombre }} {{ auth()->user()->apellido }}</span></a>
            <ul class="d-flex flex-column align-items-center">
                <li>
                    <a href="{{ route('home') }}" class="d-flex justify-content-center"><i class="bi bi-activity"></i><span>Dashboard</span> </a>
                </li>
                <li>
                    <a href="{{ route('proyectos.index') }}" class="d-flex justify-content-center"><i class="bi bi-folder"></i><span>Proyectos</span>  </a>
                </li>
                @can('users.index')
                <li>
                    <a href="" class="d-flex justify-content-center"><i class="bi bi-person-gear"></i><span>Usuarios</span></a>
                </li>
                @endcan
            </ul>
            <form action="{{ url('/logout') }}" method="POST" class="text-center">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger"><i class="bi bi-box-arrow-left"></i><span>Cerrar sesion</span></button>
                </form>
        </nav>
    </div>
    <div class="col-2"></div>
    <div class="col my-4 col-contenido mx-auto" style="overflow-y: auto;">
    
        <div class="container">
        
            @yield('content-nav')
        </div>
    </div>
</div>

@endsection