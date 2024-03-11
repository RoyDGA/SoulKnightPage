var url = `http://localhost/ApiEjemplo/`;

function RecuperarDatos(event) {
    event.preventDefault();
    const formulario = new FormData(document.querySelector('.formulario'));
    let imagen = formulario.get('imagenPersonaje');
    const tipoDeImagen = imagen.type;

    validarImagen(tipoDeImagen);
    for (const [key, value] of formulario.entries()) {
        console.log(`${key}: `, value);
    }
}

function validarImagen(tipoDeImagen){
    let minusTipo = tipoDeImagen.toLowerCase();
    const tiposValidos = ["image/jpg", "image/jpeg", "image/png", "image/webp"];
    if(tiposValidos.includes(minusTipo)){
        return true;
    }
    else{
        return false;
    }
    
}

async function crudAPI() {
    try {
        await fetch(url)
        .then(respuesta => respuesta.json())
        .then(datos => {
            console.log('IMPRIMIR TODOS LOS OBJETOS DE USUARIOS👇');
            for(let dato of datos.personajes) {
                console.log(dato)
            }
        });
    
    
//         const personajeID = 71;
//         await fetch(url+personajeID)
//         .then(respuesta => respuesta.json())
//         .then(resultado=> {
//             console.log("BUSCAR POR ID 👇")
//             console.log(resultado[0])
//         });
    
//         const datosPersonaje ={
//             nombre_personaje: 'Roy',
//             daño_personaje: 999,
//             vida_personaje: 1,
//             escudo_personaje: 1,
//             energia_personaje: 1,
//             precio_personaje: 1,
//         }
    
//     //     await fetch(url,{
//     //         method: 'POST',
//     //         body: JSON.stringify(datosPersonaje)
//     //     })
//     //     .then(respuesta => respuesta.json())
//     //     .then(datos => {
//     //         console.log("PERSONAJE INSERTADO👇")
//     //         console.log(datos)
//     //     });
//         id_personaje = 27;    
//         const ActualizarPersonaje = {
//             nombre_personaje: 'PersonajeAAAAAAAAAA',
//             daño_personaje: 10101,
//             vida_personaje: 3456,
//             escudo_personaje: 909,
//             energia_personaje: 110,
//             precio_personaje: 1000,
//         };
//         await fetch(url+id_personaje, {
//             method: 'PUT',
//             body: JSON.stringify(ActualizarPersonaje)
//         })
//         .then(respuesta => respuesta.json())
//         .then(datos => {
//             console.log("SE ACTUALIZO PERSONAJE 👇")
//             console.log(datos)
//         });

//         await fetch(url+27,{
//             method: 'DELETE'
//         })
//         .then(respuesta => respuesta.json())
//         .then(datos =>{
//             console.log("PERSONAJE BORRADO 👇");
//             console.log(datos);
//         });

        
        
    } catch (error) {
        console.log(error);
    }
    
}
    
    
crudAPI();