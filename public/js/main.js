const getEvents = () =>{
    axios.get("/api/events/getAll", {
        resposeType:'json'
    }).then((res)=>{
        if(res.status == 200){
            let dataTableEvents = document.getElementById('dataTableEvents');
            let data = res.data.eventos;
            let body = '';

            data.forEach((value, index) => {
                body += 
                `<tr>
                    <th scope="row">${value.codigo_evento}</th>
                    <td>${value.nombre}</td>
                    <td>${dateFormat(value.fecha_lanzamiento)}</td>
                    <td>${value.ubicacion}</td>
                    <td>${value.estado}</td>
                    <td>0</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Default button group">
                            <button type="button" class="btn btn-outline-secondary" title="Participantes" onclick="changeContent('guest',${value.id}, '${value.nombre}')">
                                <i class="fa-solid fa-users"></i>
                            </button>
                            <button type="button" class="btn btn-outline-primary" title="Editar" onclick="formEditEvent(${value.id}, '${value.nombre}','${value.detalle}', '${value.fecha_lanzamiento}', '${value.ubicacion}', '${value.estado}')">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger" title="Eliminar" onclick="deleteEvent(${value.id})">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>`;
            })

            dataTableEvents.innerHTML = body;

            loader(false)
        }
    })
}

const getTitularesByEvent = (event_id) =>{
    axios.get("/api/principal/getAll/"+event_id, {
        resposeType:'json'
    }).then((res)=>{


        if(res.status == 200){
            let data = res.data.titulares;
            let dataTableEvents = document.getElementById('bodyT');
            let body = '';

            if(data.length <= 0) body = '<div class="trT">Sin Datos</div>';

            data.forEach((value) => {
                let tableSecundaria = '';

                if(value.acompanantes.length > 0){
                    tableSecundaria = `
                        <div class="table-responsive tableSec collapse" id="collapseData${value.id}">
                            <table class="table caption-top table-hover">
                                <caption>Acompañantes</caption>
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre Completo</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="col">1</td>
                                        <td>Carlos Najera</td>
                                        <td>carnave.cnv@gmail.com</td>
                                        <td>5531427467</td>
                                        <td>Acciones</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>`;
                }


                body +=
                    `<div class="trT">
                        <div class="pr">
                            <ul>
                                <li data-bs-toggle="collapse" href="#collapseData${value.id}" aria-expanded="false" aria-controls="collapseData${value.id}"><i class="fa-regular fa-square-plus"></i></li>
                                <li>${value.nombre_completo}</li>
                                <li>${value.correo}</li>
                                <li>${value.telefono}</li>
                                <li>${value.qty_acompanantes ?? 0}</li>
                                <li style="z-index: 999;">
                                    <div class="btn-group" role="group" aria-label="Default button group">
                                        <button type="button" class="btn btn-outline-secondary" title="Agregar Acompañantes" onclick="addGuests('formNewGuest', ${value.id})">
                                            <i class="fa-solid fa-user"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" title="Importar Excel" onclick="addMasiveGuests('formAddMassiveGuest', ${value.id})">
                                            <i class="fa-solid fa-users"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-primary" title="Editar" onclick="formEditTitular('formEditTitular', '${value.nombre}', '${value.apellidos}', '${value.correo}', '${value.telefono}')">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger" title="Eliminar" onclick="deleteTitular(${value.id})">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        ${tableSecundaria}
                    </div>`;
            })

            dataTableEvents.innerHTML = body;
            
            loader(false)
        }

    });
}

// Modals
const useModal  = (option) =>{
    const myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'))
    const modalTitle = document.getElementById('staticBackdropLabel')
    const modalBody = document.getElementById('modalBody')
    let bodyModal = ''; 

    // Options
    modalTitle.innerHTML = getTitleModal(option);
    
    // Create Body Modal
    if(['formNewEvent', 'formNewTitular'].includes(option)){
        bodyModal = getForm(option)
    }

    // if(['qr','guests'].includes(option)){
    //     bodyModal = getModalBody(option, event_id,titular_id)
    // }else i

    // Show Modal
    myModal.show()
    modalBody.innerHTML = bodyModal;
}

const formEditEvent  = (event_id, nombre, detalle, fecha, ubicacion, estado) =>{
    const myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'))
    const modalTitle = document.getElementById('staticBackdropLabel')
    const modalBody = document.getElementById('modalBody')
    let bodyForm = ''; 

    // Options
    modalTitle.innerHTML = getTitleModal('formEditEvent');

    date = new Date(fecha);
    day = date.getDate() < 10 ? '0'+date.getDate() : date.getDate();
    month = (date.getMonth() + 1) < 10 ? '0'+(date.getMonth() + 1) : (date.getMonth() + 1);
    year = date.getFullYear();
    fecha = year+'-'+month+'-'+day;

    bodyForm = 
        `<div class="row g-3 needs-validation" novalidate id="frm_edit_event">
            <div class="col-md-12">
                <label for="nameEvent" class="form-label">Nombre</label>
                <input type="text" class="form-control validation frm_edit_event_data" value="${nombre}" id="nameEvent" placeholder="Concierto de Billie Eilish" required>
                <div class="invalid-feedback"> Agrega un Nombre para tu Evento</div>
            </div>
            <div class="col-md-12">
                <label for="descriptionEvent" class="form-label">Detalle De Evento</label>
                <textarea class="form-control frm_edit_event_data" id="descriptionEvent" rows="3">${detalle}</textarea>
            </div>
            <div class="col-md-12">
                <label for="ubication" class="form-label">Ubicacion</label>
                <input type="text" class="form-control validation frm_edit_event_data" value="${ubicacion}" id="ubication" required>
                <div class="invalid-feedback">Ingresa una direccion</div>
            </div>
            <div class="col-md-12">
                <label for="date" class="form-label">Fecha de Lanzamiento</label>
                <input type="date" class="form-control frm_edit_event_data" id="date" value="${fecha}" required>
                <div class="invalid-feedback">Ingresa una fecha de lanzamiento</div>
            </div>
            <div class="col-md-12">
                <label for="state" class="form-label">Estado</label>
                <select class="form-select validation frm_edit_event_data" id="state" required>
                    <option selected disabled value="">Elige...</option>
                    <option ${estado == "Activo" ? 'selected' : ''} value="Activo">Activo</option>
                    <option ${estado == "Proximamente" ? 'selected' : ''} value="Proximamente">Proximamente</option>
                    <option ${estado == "Vencido" ? 'selected' : ''} value="Vencido">Vencido</option>
                    <option ${estado == "Cancelado" ? 'selected' : ''} value="Cancelado">Cancelado</option>
                </select>
                <div class="invalid-feedback"> Selecciona un Estado </div>
            </div>

            <div class="col-12 d-flex justify-content-end align-items-center">
                <button class="btn btn-success" onclick="EditNewEvent('frm_edit_event', ${event_id})">Actualizar Evento</button>
            </div>
        </div>`;
    
    // Show Modal
    myModal.show()
    modalBody.innerHTML = bodyForm;
}

const getTitleModal = (option) =>{
    let title = '';

    switch(option){
        case 'qr' : title = 'Escanea codigo QR'; break;
        case 'event': title = 'Detalle de Evento'; break;
        case 'guests': title = 'Acompañantes'; break;
        case 'formNewEvent': title = 'Nuevo Evento'; break;
        case 'formEditEvent': title = 'Editar Evento'; break;
        case 'formNewTitular': title = 'Nuevo Titular'; break;
        default : title = 'Sin Contenido para mostrar'; break;
    }

    return title;
} 

const getForm = (option) =>{
    let bodyForm = '';

    switch(option){
        case 'formNewEvent': 
            date = new Date();
            day = date.getDate() < 10 ? '0'+date.getDate() : date.getDate();
            month = (date.getMonth() + 1) < 10 ? '0'+(date.getMonth() + 1) : (date.getMonth() + 1);
            year = date.getFullYear();
            fecha = year+'-'+month+'-'+day;

            bodyForm = 
                `<div class="row g-3 needs-validation" novalidate id="frm_new_event">
                    <div class="col-md-12">
                        <label for="nameEvent" class="form-label">Nombre</label>
                        <input type="text" class="form-control validation frm_new_event_data" id="nameEvent" placeholder="Concierto de Billie Eilish" required>
                        <div class="invalid-feedback"> Agrega un Nombre para tu Evento</div>
                    </div>
                    <div class="col-md-12">
                        <label for="descriptionEvent" class="form-label">Detalle De Evento</label>
                        <textarea class="form-control frm_new_event_data" id="descriptionEvent" rows="3"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="ubication" class="form-label">Ubicacion</label>
                        <input type="text" class="form-control validation frm_new_event_data" id="ubication" required>
                        <div class="invalid-feedback">Ingresa una direccion</div>
                    </div>
                    <div class="col-md-12">
                        <label for="date" class="form-label">Fecha de Lanzamiento</label>
                        <input type="date" class="form-control frm_new_event_data" id="date" value="${fecha}" required>
                        <div class="invalid-feedback">Ingresa una fecha de lanzamiento</div>
                    </div>
                    <div class="col-md-12">
                        <label for="state" class="form-label">Estado</label>
                        <select class="form-select validation frm_new_event_data" id="state" required>
                            <option selected disabled value="">Elige...</option>
                            <option value="Activo">Activo</option>
                            <option selected value="Proximamente">Proximamente</option>
                            <option value="Vencido">Vencido</option>
                            <option value="Cancelado">Cancelado</option>
                        </select>
                        <div class="invalid-feedback"> Selecciona un Estado </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end align-items-center">
                        <button class="btn btn-success" onclick="createNewEvent('frm_new_event')">Crear Evento</button>
                    </div>
                </div>`;
        break;

        case 'formNewTitular': 
            const eventSelected = document.getElementById('eventSelected')
            bodyForm = 
                `<div class="row g-3 needs-validation" novalidate id="frm_new_titular">
                    <div class="col-md-12">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control validation frm_new_titular_data" id="nombre" placeholder="Carlos" required>
                        <div class="invalid-feedback"> Agrega un Nombre</div>
                    </div>
                    <div class="col-md-12">
                        <label for="apellidos" class="form-label">Appellidos</label>
                        <input type="text" class="form-control frm_new_titular_data" placeholder="Najera" id="apellidos">
                    </div>
                    <div class="col-md-12">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="text" class="form-control validation frm_new_titular_data" placeholder="ejemplo@ejemplo.com" id="correo" required>
                        <div class="invalid-feedback">Ingresa un Correo Valido</div>
                    </div>
                    <div class="col-md-12">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control frm_new_titular_data" placeholder="5512345678" id="telefono">
                    </div>
                    
                    <div class="col-12 d-flex justify-content-end align-items-center">
                        <button class="btn btn-success" onclick="createNewTitular('frm_new_titular', ${eventSelected.value})">Crear Titular</button>
                    </div>
                </div>`;
        break;

        default : 
            bodyForm = 
                `<div class="card">
                    <div class="card-body">
                        No hay Contenido para mostrar
                    </div>
                </div>`;
        break;
    }

    return bodyForm;
}

const changeContent = (option, id = null, name = null) =>{
    const eventsContent = document.getElementById('containerEventos')
    const guestsContent = document.getElementById('containerParticipantes')
    const titleEvent = document.getElementById('titleEvent')
    const eventSelected = document.getElementById('eventSelected')

    if(option == 'guest'){
        eventsContent.style.display = 'none'
        guestsContent.style.display = 'block'
        titleEvent.innerHTML = name
        eventSelected.value = id
        getTitularesByEvent(id)
    }else{
        eventsContent.style.display = 'block'
        guestsContent.style.display = 'none'
    }
}


// ##### Functions  CRUD ######

//  EVENTS
const createNewEvent = (frm) => {

    if(validationEvents(frm)){
        const form_data = document.querySelectorAll(`.${frm}_data`)
        let data = {};

        form_data.forEach(value => {
            let llave = value.id
            let valor = value.value
            
            data = {... data, [llave]:valor}
        })

        // Se preparan los datos para el back
        axios.post("/api/events/create", data, {
            resposeType:'json',
        }).then((res)=>{
            var modalActive = document.getElementById('closeModal')

            if(res.status == 201){
                modalActive.click();
                let data = res.data.evento[0];

                Swal.fire({
                    title: 'Evento '+data.nombre+' Creado Corectamente!',
                    text: 'Codigo: '+data.codigo_evento,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                })

                getEvents()
            }
        })

    }
}

const EditNewEvent = (frm, event_id) => {

    if(validationEvents(frm)){
        const form_data = document.querySelectorAll(`.${frm}_data`)
        let data = {};

        form_data.forEach(value => {
            let llave = value.id
            let valor = value.value
            
            data = {... data, [llave]:valor}
        })

        // Se preparan los datos para el back
        axios.put("/api/events/update/"+event_id, data, {
            resposeType:'json'
        }).then((res)=>{
            var modalActive = document.getElementById('closeModal')

            if(res.status == 201){
                modalActive.click();
                let data = res.data.evento[0];

                Swal.fire({
                    title: 'Evento '+data.nombre+' Actualizado Corectamente!',
                    text: 'Codigo: '+data.codigo_evento,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                })

                getEvents()
            }
        })

    }
}

const deleteEvent = (event_id) =>{
    Swal.fire({
        title: 'Deseas Eliminar este Evento?',
        text: "Todos sus asistenten tambien se Eliminaran!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {

            axios.post("/api/events/delete/"+event_id, {
                resposeType:'json',
                _method: 'DELETE'
            }).then((res)=>{
                if(res.status == 200){
                    let message = res.data.message;

                    Swal.fire({
                        title: 'Eliminado!',
                        text: message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    getEvents()

                }
            })

        }
      })
}

const createNewTitular = (frm, event_id) => {

    if(validationEvents(frm)){
        const form_data = document.querySelectorAll(`.${frm}_data`)
        let data = {};

        form_data.forEach(value => {
            let llave = value.id
            let valor = value.value
            
            data = {... data, [llave]:valor}
        })

        data.evento_id = event_id;

        // Se preparan los datos para el back
        axios.post("/api/principal/create", data, {
            resposeType:'json',
        }).then((res)=>{
            var modalActive = document.getElementById('closeModal')

            if(res.status == 201){
                modalActive.click();
                let data = res.data.titular;

                Swal.fire({
                    title: 'Titular Creado Corectamente!',
                    text: '',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                })

                getTitularesByEvent(event_id)
            }
        })

    }
}


// #### Utils ####
const validationEvents = (frm) => {
    const validation = document.querySelectorAll('.validation')
    const form = document.getElementById(frm)
    form.classList.add('was-validated')
    let res = true;

    validation.forEach(input => {
        if(input.value.length <= 0 ) res = false
    })

    return res;
}

const loader = (action) =>{
    const loading = document.getElementById('loading');

    if(action){
        loading.style.display ='flex';
    }else{
        loading.style.display ='none';
    }
}

const dateFormat = (date) =>{
    let fecha = new Date(date);
    let options = { year: 'numeric', month: 'long', day: 'numeric' };

    return  fecha.toLocaleDateString("es-ES", options);
}

// ######### autoload #######3

loader(true)
setTimeout(()=>{
    getEvents()
}, 500)
