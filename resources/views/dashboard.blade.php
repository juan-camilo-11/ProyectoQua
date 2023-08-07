@extends('layouts.nav')

@section('content-nav')
<h3 class="my-2">{{ $mensaje }}, {{ auth()->user()->nombre }}!</h3>
<div class="row cards-dash my-4">
    <div class="col card-dashboard">
        <div class="row d-flex align-items-center">
            <div class="col-2 d-flex justify-content-center">
                <span class="span-warning">
                    <i class="bi bi-dash"></i>
                </span>
            </div>
            <div class="col-10">
                <h6 class="card-title">Pruebas Asignadas</h6>
                <p class="card-text">{{$PruebasAsignadas}}</p>
            </div>
        </div>
    </div>
    <div class="col card-dashboard">
        <div class="row d-flex align-items-center">
            <div class="col-2 d-flex justify-content-center">
                <span class="span-success">
                    <i class="bi bi-check"></i>
                </span>
            </div>
            <div class="col-8">
                <h6 class="card-title">Pruebas Aprobadas</h6>
                <p class="card-text">{{$PruebasAprobadas}}</p>
            </div>
        </div>
    </div>
    <div class="col card-dashboard">
        <div class="row d-flex align-items-center">
            <div class="col-2 d-flex justify-content-center">
                <span class="span-danger">
                <i class="bi bi-x"></i>
                </span>
            </div>
            <div class="col-8">
                <h6 class="card-title">Pruebas No Aprobadas</h6>
                <p class="card-text">{{$PruebasNoAprobadas}}</p>
            </div>
        </div>

    </div>
</div>
<div class="row my-4">
    <div class="col">
        <table class="table">
            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Estado</th>
                    <th>Avance</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto->nombre }}</td>
                    <td><span class="badge bg-success">{{$proyecto->estado}}</span></td>
                    <td>{{$proyecto->avance}}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $proyectos->links() }}
    </div>
    <div class="col">
        <h3>Calendario</h3>
        <table>
            <caption>Mayo 2023</caption>
            <thead>
                <tr>
                    <th>Dom</th>
                    <th>Lun</th>
                    <th>Mar</th>
                    <th>Mié</th>
                    <th>Jue</th>
                    <th>Vie</th>
                    <th>Sáb</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>9</td>
                    <td>10</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>12</td>
                    <td>13</td>
                    <td>14</td>
                    <td>15</td>
                    <td>16</td>
                    <td>17</td>
                </tr>
                <tr>
                    <td>18</td>
                    <td>19</td>
                    <td>20</td>
                    <td>21</td>
                    <td>22</td>
                    <td>23</td>
                    <td>24</td>
                </tr>
                <tr>
                    <td>25</td>
                    <td>26</td>
                    <td>27</td>
                    <td>28</td>
                    <td>29</td>
                    <td>30</td>
                    <td>31</td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
@endsection