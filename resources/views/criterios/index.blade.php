@extends('layouts.nav')

@section('content-nav')
<button onclick="window.history.back()" class="btn btn-gris"><i class="bi bi-arrow-left"></i></button>

<div class="row">
    <h3 class="my-2">Asignar Criterios</h3>
    <p>La suma de todos los seleccionados no puede ser superior a 100</p>
    <form action="{{route('criterios.store')}}" method="post">
        @csrf
        <input type="text" name="proyecto_id" value="{{$_REQUEST['proyecto']}}" style="display: none;"/>
        <div class="col">
            <div class="form-check w-100 d-flex justify-content-between">
                <input class="form-check-input" type="checkbox" id="mi-checkbox" name="c_funcionalidad" value="funcionalidad">
                <label class="form-check-label" for="mi-checkbox">
                    Funcionalidad
                </label>
                <input type="number" name="p_funcionalidad" min="0" max="100" step="0.1" placeholder="Ponderación" disabled class="w-50">
            </div>

            <div class="form-check w-100 d-flex justify-content-between">
                <input class="form-check-input" type="checkbox" id="mi-checkbox" name="c_eficiencia" value="eficiencia">
                <label class="form-check-label" for="mi-checkbox">
                    Eficiencia
                </label>
                <input type="number" name="p_eficiencia" min="0" max="100" step="0.1" placeholder="Ponderación" disabled class="w-50">
            </div>

            <div class="form-check w-100 d-flex justify-content-between">
                <input class="form-check-input" type="checkbox" id="mi-checkbox" name="c_compatibilidad" value="compatibilidad">
                <label class="form-check-label" for="mi-checkbox">
                    Compatibilidad
                </label>
                <input type="number" name="p_compatibilidad" min="0" max="100" step="0.1" placeholder="Ponderación" disabled class="w-50">
            </div>

            <div class="form-check w-100 d-flex justify-content-between">
                <input class="form-check-input" type="checkbox" id="mi-checkbox" name="c_usabilidad" value="usabilidad">
                <label class="form-check-label" for="mi-checkbox">
                    Usabilidad
                </label>
                <input type="number" name="p_usabilidad" min="0" max="100" step="0.1" placeholder="Ponderación" disabled class="w-50">
            </div>

            <div class="form-check w-100 d-flex justify-content-between">
                <input class="form-check-input" type="checkbox" id="mi-checkbox" name="c_fiabilidad" value="fiabilidad">
                <label class="form-check-label" for="mi-checkbox">
                    Fiabilidad
                </label>
                <input type="number" name="p_fiabilidad" min="0" max="100" step="0.1" placeholder="Ponderación" disabled class="w-50">
            </div>

            <div class="form-check w-100 d-flex justify-content-between">
                <input class="form-check-input" type="checkbox" id="mi-checkbox" name="c_seguridad" value="seguridad">
                <label class="form-check-label" for="mi-checkbox">
                    Seguridad
                </label>
                <input type="number" name="p_seguridad" min="0" max="100" step="0.1" placeholder="Ponderación" disabled class="w-50">
            </div>

            <div class="form-check w-100 d-flex justify-content-between">
                <input class="form-check-input" type="checkbox" id="mi-checkbox" name="c_mantenibilidad" value="mantenibilidad">
                <label class="form-check-label" for="mi-checkbox">
                    Mantenibilidad
                </label>
                <input type="number" name="p_mantenibilidad" min="0" max="100" step="0.1" placeholder="Ponderación" disabled class="w-50">
            </div>

            <div class="form-check w-100 d-flex justify-content-between">
                <input class="form-check-input" type="checkbox" id="mi-checkbox" name="c_portabilidad" value="portabilidad">
                <label class="form-check-label" for="mi-checkbox">
                    Portabilidad
                </label>
                <input type="number" name="p_portabilidad" min="0" max="100" step="0.1" placeholder="Ponderación" disabled class="w-50">
            </div>
        </div>
        <button type="submit" class="btn btn-primary my-2">Asignar</button>
    </form>
</div>
<!-- Boton para abrir modal de editar criterios -->
<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Editar criterios
</button>

<!-- Modal para editar criterios -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Criterios asignados</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table>
                    <thead>
                        <tr>
                            <th class="px-3">Nombre</th>
                            <th class="px-3">Ponderación</th>
                            <th class="px-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($criterios as $criterio)
                        <tr>
                            <td class="text-center">{{ $criterio->Nombre }}</td>
                            <td class="text-center">{{ $criterio->Ponderacion }}</td>
                            <td class="text-center">
                                <form action="{{ route('criterios.destroy', $criterio->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



<script>
    let checkboxes = document.querySelectorAll('input[type=checkbox]');
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', () => {
            let input = checkbox.parentNode.querySelector('input[type=number]');
            input.disabled = !checkbox.checked;
        });
    });
</script>


@endsection