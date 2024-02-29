var url = `http://localhost/ApiEjemplo/`;

async function crudAPI() {
    
    await fetch(url)
    .then(respuesta => respuesta.json())
    .then(datos => {
        console.log('IMPRIMIR TODOS LOS OBJETOS DE USUARIOS👇');
        for(let dato of datos) {
            console.log(dato)
        }
    });
    
    
    // Añadir usuario
    
    const añadirUsuario = {
        name: 'Royman',
        email: 'royman845@gmail.com',
    }
    
    await fetch(url,{
        method: 'POST',
        body: JSON.stringify(añadirUsuario)
    })
    .then(respuesta => respuesta.json())
    .then(datos=> {
        console.log('USUARIO AÑADIDO👇')
        console.log(datos)
    })
    .catch(error => console.log(error))
    
    
    // Actualizar usuario
    
    const usuarioId = 2;
    const actualizarUsuario = {
        name: 'Kar',
        email: 'Kar@gmail.com',
    }
    
    await fetch(url+usuarioId,{
        method: 'PUT',
        body: JSON.stringify(actualizarUsuario)
    })
    .then(respuesta => respuesta.json())
    .then(datos=> {
        console.log('USUARIO ACTUALIZADO👇')
        console.log(datos[usuarioId-1])
        console.log(datos)
    })
    .catch(error => console.log(error))
    
    
    // Borrar usuario
    
    const usuarioIdBorrar = 2;
    
    await fetch(url+usuarioIdBorrar,{
        method: 'DELETE',
    })
    .then(respuesta => respuesta.json())
    .then(datos=> {
        console.log('USUARIO CON ID('+usuarioIdBorrar+') BORRADO👇')
        console.log(datos)
    })
    .catch(error => console.log(error))
}
crudAPI();
