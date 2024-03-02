var url = `http://localhost/ApiEjemplo/`;

async function crudAPI() {
    try {
        await fetch(url)
        .then(respuesta => respuesta.json())
        .then(datos => {
            console.log('IMPRIMIR TODOS LOS OBJETOS DE USUARIOS👇');
            for(let dato of datos) {
                console.log(dato)
            }
        });
    
    
        const personajeID = 71;
        await fetch(url+personajeID)
        .then(respuesta => respuesta.json())
        .then(resultado=> {
            console.log("BUSCAR POR ID 👇")
            console.log(resultado[0])
        });
    
        const datosPersonaje ={
            nombre_personaje: 'Roy',
            daño_personaje: 999,
            vida_personaje: 1,
            escudo_personaje: 1,
            energia_personaje: 1,
            precio_personaje: 1,
        }
    
    //     await fetch(url,{
    //         method: 'POST',
    //         body: JSON.stringify(datosPersonaje)
    //     })
    //     .then(respuesta => respuesta.json())
    //     .then(datos => {
    //         console.log("PERSONAJE INSERTADO👇")
    //         console.log(datos)
    //     });
        id_personaje = 27;    
        const ActualizarPersonaje = {
            nombre_personaje: 'PersonajeAAAAAAAAAA',
            daño_personaje: 10101,
            vida_personaje: 3456,
            escudo_personaje: 909,
            energia_personaje: 110,
            precio_personaje: 1000,
        };
        await fetch(url+id_personaje, {
            method: 'PUT',
            body: JSON.stringify(ActualizarPersonaje)
        })
        .then(respuesta => respuesta.json())
        .then(datos => {
            console.log("SE ACTUALIZO PERSONAJE 👇")
            console.log(datos)
        });

        await fetch(url+27,{
            method: 'DELETE'
        })
        .then(respuesta => respuesta.json())
        .then(datos =>{
            console.log("PERSONAJE BORRADO 👇");
            console.log(datos);
        });

        
        
    } catch (error) {
        console.log(error);
    }
    
}
    
crudAPI();
    
    // Añadir usuario
    
//     const añadirUsuario = {
//         name: 'Royman',
//         email: 'royman845@gmail.com',
//     }
    
//     await fetch(url,{
//         method: 'POST',
//         body: JSON.stringify(añadirUsuario)
//     })
//     .then(respuesta => respuesta.json())
//     .then(datos=> {
//         console.log('USUARIO AÑADIDO👇')
//         console.log(datos)
//     })
//     .catch(error => console.log(error))
    
    
//     // Actualizar usuario
    
//     const usuarioId = 2;
//     const actualizarUsuario = {
//         name: 'Kar',
//         email: 'Kar@gmail.com',
//     }
    
//     await fetch(url+usuarioId,{
//         method: 'PUT',
//         body: JSON.stringify(actualizarUsuario)
//     })
//     .then(respuesta => respuesta.json())
//     .then(datos=> {
//         console.log('USUARIO ACTUALIZADO👇')
//         console.log(datos[usuarioId-1])
//         console.log(datos)
//     })
//     .catch(error => console.log(error))
    
    
//     // Borrar usuario
    
//     const usuarioIdBorrar = 2;
    
//     await fetch(url+usuarioIdBorrar,{
//         method: 'DELETE',
//     })
//     .then(respuesta => respuesta.json())
//     .then(datos=> {
//         console.log('USUARIO CON ID('+usuarioIdBorrar+') BORRADO👇')
//         console.log(datos)
//     })
//     .catch(error => console.log(error))
// }
