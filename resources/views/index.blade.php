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
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    {{-- Icons --}}
    <script src="https://kit.fontawesome.com/b3d3d5c8e5.js" crossorigin="anonymous"></script>

    <title>Eventos</title>
</head>
<body>
    <div class="container p-4" >
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-10">
                <div class="h1">Control de Eventos</div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-2 d-flex justify-content-start align-items-center">
                <button class="btn btn-primary" onclick="useModal('formNewEvent')">Nuevo Evento</button>
            </div>
            <hr class="border border-secondary border-1 opacity-50">
        </div>

        <div id="containerEventos">
            <div class="table-responsive">
                <table class="table caption-top table-hover">
                    <caption>Eventos Recientes</caption>
                    <thead>
                      <tr>
                        <th scope="col">Codigo Evento</th>
                        <th scope="col">Evento</th>
                        <th scope="col">Fecha Evento</th>
                        <th scope="col">Ubicacion</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Cant. Asistentes</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody id="dataTableEvents">
                        <tr>
                            <th scope="row" class="text-center" colspan="8"> Sin Datos</th>
                          </tr>
                    </tbody>
                </table>
              </div>
        </div>

        <div id="containerParticipantes">
            <div class="row">
                <div class="col-sm-2 col-md-2 col-lg-1 d-flex justify-content-start align-items-center">
                    <button class="btn btn-outline-Secondary" onclick="changeContent('event')">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-9 d-flex justify-content-start align-items-center">
                    <div class="h3" id="titleEvent"></div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-2 d-flex justify-content-start align-items-center">
                    <button class="btn btn-outline-primary" onclick="useModal('formNewTitular')">
                        <i class="fa-solid fa-user-plus"></i> Agregar Titular
                    </button>
                </div>
                <input type="hidden" value="" id="eventSelected">
            </div>
            <div class="table-responsive">
                <table class="table caption-top table-hover">
                    <caption>Titulares</caption>
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Cant. Acompañantes</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody id="dataTableGuestPrincipal">
                        <tr>
                            <th scope="row" class="text-center" colspan="8"> Sin Datos</th>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal"></button>
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

    <div class="loading" id="loading">
        <span class="loader"></span>
    </div>

    {{-- Custom --}}
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>