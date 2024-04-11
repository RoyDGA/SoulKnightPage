var url = 'http://localhost/ApiEjemplo/';

async function getDatos() {
    try {
        await fetch(
            url
        )
        .then(response => response.json())
        .then(datos => console.log(datos))
    } catch (error) {
        throw new Error(error);
    }
}

getDatos();