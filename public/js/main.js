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

// Modals
const useModal  = (option, event_id = null, titular_id = null) =>{
    const myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'))
    const modalTitle = document.getElementById('staticBackdropLabel')
    const modalBody = document.getElementById('modalBody')
    let bodyModal = ''; 

    // Options
    modalTitle.innerHTML = getTitleModal(option);
    
    // Create Body Modal
    if(['qr','guests'].includes(option)){
        bodyModal = getModalBody(option, event_id,titular_id)
    }else if(['formNewEvent'].includes(option)){
        bodyModal = getForm(option)
    }

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
        default : title = 'Sin Contenido para mostrar'; break;
    }

    return title;
} 

const getModalBody = (option, event_id = null, titular_id = null ) =>{
    let resultado = '';

    if(option ==  'qr'){
        resultado = getQRCode()
    }else if (option == 'guests'){
        resultado = getGuests(event_id,titular_id)
    }else {
        resultado = getForm(option)
    }

    return resultado;
}

const getQRCode = () =>{
    let body = ``;

    body = `<div class="card">
                <div class="card-body">
                    Aqui el codigo QR
                </div>
            </div>`;

    return body;
}

const getDetailEvent = (event_id) =>{

}

const getGuests = (event_id, titular_id) =>{

}

const getForm = (option, obj) =>{
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

    if(option == 'guest'){
        eventsContent.style.display = 'none'
        guestsContent.style.display = 'block'
        titleEvent.innerHTML = name
    }else{
        eventsContent.style.display = 'block'
        guestsContent.style.display = 'none'
    }
    console.log(id);
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
                    confirmButtonColor: '#198754'
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
                    confirmButtonColor: '#198754'
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
                        confirmButtonColor: '#198754'
                    })

                    getEvents()

                }
            })

        }
      })
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
