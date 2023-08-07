@extends('layouts.app')

@section('content')
<a href="#" class="btn-volver px-2"><i class="bi bi-arrow-up"></i></a>
<nav class="navbar navbar-expand-lg bg-body-tertiary nav-inicio">
  <div class="container-fluid nav-inicio-div">
    <a class="navbar-brand" href="#">
      <img src="{{ asset('img/logo-blanco.svg') }}" alt="Logo de Qua"> &nbsp;&nbsp;Qua</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse nav-inicio-content" id="navbarNavAltMarkup">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#nosotros">Nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#servicios">Servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn-principal text-center" href="{{route('login')}}">Iniciar sesion</a>
        </li>
      </ul>

    </div>

  </div>
</nav>

<div class="container mt-5 inicio" id="inicio">
  <div class="inicio-contenido">
    <h3>Seguimiento de calidad del software</h3>
    <p>
      Tomar un servicio de seguimiento de calidad del software basado en la norma ISO 25000 ofrece varias ventajas significativas. En primer lugar, ayuda a garantizar que el software desarrollado cumpla con los requisitos de calidad esperados y se ajuste a las normas internacionales. Esto asegura que el software sea seguro, fiable y fácil de mantener y evita problemas costosos y tiempo de inactividad más adelante.
    </p>
    <a href="{{route('login')}}">Empezar</a>
  </div>
  <div class="inicio-img text-center">
    <img src="{{ asset('img/ilustracion-pagina.svg') }}" alt="Ilustracion de pagina" class="inicio-img">
  </div>
</div>
<div class="container mt-5 nosotros" id="nosotros">
  <h3>Nosotros</h3>
  <div class="container nosotros-back my-5 ">
    <div class="nosotros-info">
      <div class="row">
        <div class="col">
          <img src="{{ asset('img/logo-blanco.svg') }}" alt="Logo de Sistema Qua">
        </div>
        <div class="col d-flex align-items-center">
          <h2>Qua</h2>
        </div>
      </div>
      <p class="my-3">En nuestra empresa, entendemos la importancia de la calidad del software, y nos esforzamos por brindar soluciones de calidad excepcional que ayuden a nuestros clientes a crecer y tener éxito en su negocio. Contáctenos hoy mismo para obtener más información sobre cómo podemos ayudarlo a mejorar la calidad de su software.</p>
    </div>
  </div>
</div>
<div class=" container servicio" id="servicios">
  <div class="row d-flex w-90">
    <h3 class="text-center my-5">Servicios</h3>
    <div class="col-6 servicios-img">
      <img src="{{ asset('img/img-prueba.jpg') }}" alt="">
    </div>
    <div class="col-6 servicios-info p-4">
      <h2>Servicio</h2>
      <p>Nuestra plataforma de seguimiento de calidad de software basada en la norma ISO 25000 es una solución especializada en la evaluación de las pruebas de uso y evaluación del software. Con nuestra plataforma, puede realizar un seguimiento completo de las pruebas, identificando cualquier problema o defecto y ofreciendo soluciones efectivas para mejorar la calidad y eficiencia del software.</p>
      <a href="{{route('login')}}" class="py-2">Intentar gratis</a>
    </div>
  </div>



</div>
<div class="footer mt-5">
  <p class="p-3 text-center">Desarrollado por Qua. </p>
</div>
@endsection