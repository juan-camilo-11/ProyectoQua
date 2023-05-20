@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Quality</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
        <a class="nav-link" href="#">Nosotros</a>
        <a class="nav-link" href="#">Servicio</a>
        <a class="nav-link btn-principal text-center" href="{{route('login')}}">Iniciar sesion</a>
      </div>
    </div>
  </div>
</nav>
<div class="container mt-5 inicio">
    <h3>Seguimiento de calidad del software</h3>
    <p>
    Tomar un servicio de seguimiento de calidad del software basado en la norma ISO 25000 ofrece varias ventajas significativas. En primer lugar, ayuda a garantizar que el software desarrollado cumpla con los requisitos de calidad esperados y se ajuste a las normas internacionales. Esto asegura que el software sea seguro, fiable y fácil de mantener y evita problemas costosos y tiempo de inactividad más adelante.
    </p>
    <a href="" class="btn-principal">Empezar</a>
    <div class="inicio-img text-center">
        <img src="{{ asset('img/ilustracion-pagina.svg') }}" alt="Ilustracion de pagina" class="inicio-img">
    </div>
</div>
<div class="container mt-5 nosotros">
    <h3>Nosotros</h3>
    <div class="container nosotros-back my-5">
        <img src="{{ asset('img/logo-blanco.svg') }}" alt="Logo de SistemaQA">
        <p>En nuestra empresa, entendemos la importancia de la calidad del software, y nos esforzamos por brindar soluciones de calidad excepcional que ayuden a nuestros clientes a crecer y tener éxito en su negocio. Contáctenos hoy mismo para obtener más información sobre cómo podemos ayudarlo a mejorar la calidad de su software.</p>
    </div>
</div>
<div class=" container servicio">
    <h3>Servicio</h3>
    <p>Nuestra plataforma de seguimiento de calidad de software basada en la norma ISO 25000 es una solución especializada en la evaluación de las pruebas de uso y evaluación del software. Con nuestra plataforma, puede realizar un seguimiento completo de las pruebas, identificando cualquier problema o defecto y ofreciendo soluciones efectivas para mejorar la calidad y eficiencia del software.</p>
    <a href="">Intentar gratis</a>
</div>
<div class="footer mt-5">
    <p class="p-3 text-center">Desarrollado por QualitySytem </p>
</div>
@endsection