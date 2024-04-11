var url = 'http://localhost/ApiEjemplo/';


function validarFormulario(){
    let formulario = new FormData(document.querySelector('.formularioCrear'));
    return validarCampos(formulario);
    
}

function validarCampos(formulario){

    for (let [key, value] of formulario.entries()) {
        if (value instanceof File) {
            if (!validarImagen(value)) {
                return false;
            }
        }
        else if (value.trim() === '') {
            return false;
        }
    }
    return true;
}

function validarImagen(archivo){
    let tiposValidos = ["image/jpg", "image/jpeg", "image/png", "image/webp"];
    return tiposValidos.includes(archivo.type);

}

document.addEventListener("DOMContentLoaded", function(){
    const formulario = document.querySelector('.formularioCrear');
    const botonEnviar = document.querySelector('.formularioCrear .enviar');

    formulario.addEventListener('input', function() {
        if (validarFormulario()) {

            botonEnviar.removeAttribute('disabled');
            botonEnviar.style.opacity = '1';
        }
        else{
            botonEnviar.setAttribute('disabled', 'disabled');
        }
    });

    botonEnviar.addEventListener('click', function(e) {
        e.preventDefault();
        fetchForm(formulario);
    });
});

async function fetchForm(formulario){
    if (validarFormulario()) {
        
        const formData = new FormData(formulario);

        
        const personaje = {
            nombre_personaje: formData.get('nombre'),
            daño_personaje: formData.get('daño'),
            vida_personaje: formData.get('vida'),
            escudo_personaje: formData.get('escudo'),
            energia_personaje: formData.get('energia'),
            precio_personaje: formData.get('precio'),
            imagen_personaje: formData.get('imagen')
        }
        console.log("JAVASCRIPT")
        console.log(personaje);
        
        try {
            const respuesta = await fetch(url, {
                method: 'POST',
                body: formData,
            });

            if (!respuesta.ok) {
                throw new Error("ERROR AL ENVIAR");
            }

            const datos = await respuesta.text();
            console.log("PHP")
            console.log(datos);
        }catch (error) {
            console.log("ERROR AL ENVIAR: ", error);
        }

    }else{
        console.log("NO SE HA LLENADO CORRECTAMENTE EL FORMULARIO");
    }
}


