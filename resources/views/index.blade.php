<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Scripts Bootstrap-->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles Bootstrp-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- Icons --}}
    <script src="https://kit.fontawesome.com/b3d3d5c8e5.js" crossorigin="anonymous"></script>

    <title>Eventos</title>
</head>
<body>
    <div class="container p-4">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-10">
                <div class="h1">Control de Eventos</div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-2 d-flex justify-content-start align-items-center">
                <button class="btn btn-primary" onclick="useModal('formNewEvent')">Nuevo Evento</button>
            </div>
            <hr class="border border-secondary border-1 opacity-50">
        </div>
        <div>
            <div class="table-responsive">
                <table class="table caption-top table-hover">
                    <caption>Eventos Recientes</caption>
                    <thead>
                      <tr>
                        <th scope="col">Codigo Evento</th>
                        <th scope="col">Evento</th>
                        <th scope="col">Fecha Evento</th>
                        <th scope="col">Titular</th>
                        <th scope="col">No. Acompañantes</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">Eve-123tal</th>
                        <td>Corona Capital</td>
                        <td>23 de Marzo de 2023, 11:00 hrs.</td>
                        <td>Cristina Valle</td>
                        <td>12</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                <button type="button" class="btn btn-outline-secondary" title="Codigo QR" onclick="useModal('qr')">
                                    <i class="fa-solid fa-qrcode"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary" title="Detalles Eventos" onclick="useModal('event',1)">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary" title="Participantes" onclick="useModal('guests',1,1)">
                                    <i class="fa-solid fa-users"></i>
                                </button>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">Eve-456ica</th>
                        <td>Orquesta Filarmonica</td>
                        <td>12 de Abril de 2023, 20:00 hrs.</td>
                        <td>Aranza Marquez</td>
                        <td>3</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                <button type="button" class="btn btn-outline-secondary" title="Codigo QR" onclick="useModal('qr')">
                                    <i class="fa-solid fa-qrcode"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary" title="Detalles Eventos" onclick="useModal('event',2)">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary" title="Participantes" onclick="useModal('guests',2,2)">
                                    <i class="fa-solid fa-users"></i>
                                </button>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">Eve-789vas</th>
                        <td>America vs Chivas</td>
                        <td>25 de Abril de 2023, 13:00 hrs.</td>
                        <td>Victor Sanchez</td>
                        <td>21</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                <button type="button" class="btn btn-outline-secondary" title="Codigo QR" onclick="useModal('qr')">
                                    <i class="fa-solid fa-qrcode"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary" title="Detalles Eventos" onclick="useModal('event', 3)">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary" title="Participantes" onclick="useModal('guests', 3, 3)">
                                    <i class="fa-solid fa-users"></i>
                                </button>
                            </div>
                        </td>
                      </tr>
                    </tbody>
                </table>
              </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Titulo Modal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-regular fa-rectangle-xmark"></i> Cerrar</button>
                    <button type="button" class="btn btn-success"><i class="fa-regular fa-floppy-disk"></i> Guardar Cambios</button>
                </div> --}}
            </div>
        </div>
    </div>


    {{-- Custom --}}
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>