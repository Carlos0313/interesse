const useModal  = (option, event_id = null, titular_id = null) =>{
    const myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'))
    const modalTitle = document.getElementById('staticBackdropLabel')
    const modalBody = document.getElementById('modalBody')
    let bodyModal = ''; 

    // Options
    modalTitle.innerHTML = getTitleModal(option);
    
    // Create Body Modal
    if(['qr','event','guests'].includes(option)){
        bodyModal = getModalBody(option, event_id,titular_id)
    }else if(['formNewEvent'].includes(option)){
        bodyModal = getModalBody(option)
    }

    // Show Modal
    myModal.show()
    modalBody.innerHTML = bodyModal;
}

const getTitleModal = (option) =>{
    let title = '';

    switch(option){
        case 'qr' : title = 'Escanea codigo QR'; break;
        case 'event': title = 'Detalle de Evento'; break;
        case 'guests': title = 'Acompañantes'; break;
        case 'formNewEvent': title = 'Nuevo Evento'; break;
        default : title = 'Sin Contenido para mostrar'; break;
    }

    return title;
} 

const getModalBody = (option, event_id = null, titular_id = null ) =>{
    let resultado = '';

    if(option ==  'qr'){
        resultado = getQRCode()
    }else if(option == 'event'){
        resultado = getDetailEvent(event_id)
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
        console.log(data);

    }else{
        console.log('fallo')
    }
}


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