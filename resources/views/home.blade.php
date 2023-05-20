@extends('layouts.nav')

@section('content-nav')
<h3>{{ $mensaje }}, {{ auth()->user()->nombre }}!</h3>
<div class="row">
    <div class="col">

        <div class="card">
            <i class="bi bi-circle-square text-end"></i>
            <div class="card-body">
                <h5 class="card-title">Pruebas Asignadas</h5>
                <p class="card-text">25.</p>
                <a href="#" class="btn btn-primary">Ver</a>
            </div>
        </div>


    </div>
    <div class="col">

        <div class="card">
            <i class="bi bi-check2 text-end"></i>
            <div class="card-body">
                <h5 class="card-title">Pruebas Aprobadas</h5>
                <p class="card-text">15.</p>
                <a href="#" class="btn btn-primary">Ver</a>
            </div>
        </div>

    </div>
    <div class="col">

        <div class="card">
            <i class="bi bi-dash text-end"></i>
            <div class="card-body">
                <h5 class="card-title">Pruebas No aprobadas</h5>
                <p class="card-text">10.</p>
                <a href="#" class="btn btn-primary">Ver</a>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table">
            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Estado</th>
                    <th>Avance</th>
                    <th>Calidad</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Proyecto 1</td>
                    <td><span class="badge bg-success">Aprobado</span></td>
                    <td>70%</td>
                    <td>40%</td>
                </tr>
                <tr>
                    <td>Proyecto 2</td>
                    <td><span class="badge bg-danger">No Aprobado</span></td>
                    <td>40%</td>
                    <td>40%</td>
                </tr>
                <tr>
                    <td>Proyecto 3</td>
                    <td><span class="badge bg-warning text-dark">Asignado</span></td>
                    <td>20%</td>
                    <td>40%</td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="col-4">
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