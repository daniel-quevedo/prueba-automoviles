@extends('layout')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Inicio')
</head>

<body style="background-image: url(https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fwww.solofondos.com%2Fwp-content%2Fuploads%2F2016%2F01%2Fwallpaper-carros-deportivos-hd.jpg&f=1&nofb=1); background-size: 100% 100%; background-repeat: no-repeat; background-attachment: fixed">
    <input type="text" hidden disabled id="alert" value="{{ $alert }}">
    <input type="text" hidden disabled id="totalUsers" value="{{ $totalUsers }}">
    <nav class="navbar fixed-top navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Automoviles S.A.</a>
            <a href="{{ route('exporExcel') }}" type="button" class="btn btn-success">Descargar Excel de la BD</a>
        </div>
    </nav>
    <div class="p-5 col-7 mx-auto" style="background-color: black; opacity: 70%; margin-top: 10%">
        <section class="text-white">
            <div class="text-center" >
                <div>
                    <H5>Empresa Automovilistica</H5>
                </div>
                <div class="m-5">
                    <H1>Registrate</H1>
                </div>
                <div class="d-grid gap-2 col-3 mx-auto ">
                    <button class="btn btn-outline-light mt-5" type="button" data-bs-toggle="modal" data-bs-target="#registro">Registrar</button>
                </div>
            </div>
        </section>
    </div>
    <div class="text-center mx-auto">
        <h4>{{ $totalUsers }} Usuarios Registrados</h4>
    </div>
    <div class="d-grid gap-2 col-4 mx-auto ">
        <button type="button" style="background-color: gold" class="btn mt-3" id="selectWinner" data-bs-toggle="modal" data-bs-target="#winner">Seleccionar Ganador</button>
    </div>
</body>
<!-- ============= Modal de Registro ================== -->

<div class="modal fade" id="registro">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route("create") }}" method="post">
                @csrf
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-light" >Registrar</h5>
                </div>
                <div class="modal-body bg-light">
                    <div class="row ">
                        <div class="col-6">
                            <div class="my-2">
                                <label for="" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" pattern="[a-zA-Z ]{2,50}" required>
                            </div>
                            <div class="my-2">
                                <label for="" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" pattern="[a-zA-Z ]{2,50}" required>
                            </div>
                            <div class="my-2">
                                <label for="" class="form-label">Cédula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" pattern="[0-9]{7,15}" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="my-2">
                                <label for="" class="form-label">Departamento</label>
                                <select  name="departamentos" id="departamentos" class="form-control" required>
                                    <option disabled value="" selected>Seleccione...</option>
                                    @foreach ($departamentos as $item)
                                        <option value="{{ $item->idDep }}">{{ $item->nombres }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="my-2">
                                <label for="" class="form-label">Ciudad</label>
                                <select name="ciudades" id="ciudades" class="form-control" required>
                                    <option disabled value="" selected>Seleccione...</option>
                                </select>
                            </div>
                            <div class="my-2">
                                <label for="" class="form-label">Celular</label>
                                <input type="text" class="form-control" id="celular" name="celular" pattern="[0-9]{7,15}" required>
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="" class="form-label">Correo Electrónico</label>
                            <input type="text" class="form-control" id="correo" name="correo" required>
                        </div>
                        <div class="my-2">
                            <div class="form-check">
                                <input id="my-input" class="form-check-input" type="checkbox" name="" value="true" required>
                                <label for="my-input" class="form-check-label">“Autorizo el tratamiento de mis datos de acuerdo con la
                                    finalidad establecida en la política de protección de datos personales”. <a href="https://funcionpublica.gov.co/eva/gestornormativo/norma.php?i=34488" target="_blank">Haga clic
                                    aquí</a></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============= Modal Ganador ================== -->

@if ($totalUsers >= 5)
    <div class="modal fade" id="winner">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-light text-center" >GANADOR</h5>
                </div>
                <div class="modal-body bg-light">
                    <div class="row ">
                        <div class="col-6">
                            <div class="my-2">
                                <label for="" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $userWinner[0]->nombre }}" disabled>
                            </div>
                            <div class="my-2">
                                <label for="" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $userWinner[0]->apellido }}" disabled>
                            </div>
                            <div class="my-2">
                                <label for="" class="form-label">Cédula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" value="{{ $userWinner[0]->cedula }}" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="my-2">
                                <label for="" class="form-label">Departamento</label>
                                <input type="text" class="form-control" id="departamento" name="departamento" value="{{ $userWinner[0]->depNombre }}" disabled>
                            </div>
                            <div class="my-2">
                                <label for="" class="form-label">Ciudad</label>
                                <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ $userWinner[0]->ciuNombre }}" disabled>
                            </div>
                            <div class="my-2">
                                <label for="" class="form-label">Celular</label>
                                <input type="text" class="form-control" id="celular" name="celular" value="{{ $userWinner[0]->celular }}" disabled>
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="" class="form-label">Correo Electrónico</label>
                            <input type="text" class="form-control" id="correo" name="correo" value="{{ $userWinner[0]->correo }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endif


</html>

@section('scripts')
<script>

    let alerts = document.getElementById('alert').value;
    let totalUsers = document.getElementById('totalUsers').value;
    let button = document.getElementById('selectWinner');


    setTimeout(myFunction, 500)

    function myFunction() {
        if (alerts == 1) {
            alert("¡¡¡ Te has registrado correctamente !!!");
        }else if(alerts == 2){
            alert("No se pudo registrar correctamente \nLa cédula y/o correo ya Existen");
        }
    }

    if (totalUsers >= 5) {
        button.removeAttribute('disabled');
    }else{
        button.setAttribute('disabled', "true");
    }

    $(document).ready(function () {

        $('#departamentos').on('change', function() {

            $.ajax({
                url: '{{ URL::route('ciudad') }}',
                method: 'get',
                data:{
                    'idDep': $(this).val()
                },
                success:function(data){
                    $('#ciudades').html(data);
                },error : function(e) {
                    alert(e.error);
                }
            });
        });
    });
</script>
@endsection
