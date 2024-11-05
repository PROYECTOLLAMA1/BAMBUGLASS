function borrarTexto() {
    document.getElementById('searchInput').value = ''; // Borrar texto del input
}

function comprar(nombre, precio, imagen) {
    // Imprimir en consola para verificar si los parámetros están siendo recibidos correctamente
    console.log(`Comprando: ${nombre}, Precio: ${precio}, Imagen: ${imagen}`);
    
    // Guardar los datos del producto en el localStorage
    localStorage.setItem('productoNombre', nombre);
    localStorage.setItem('productoPrecio', precio);
    localStorage.setItem('productoImagen', imagen);

    // Verificar si los datos se han guardado correctamente
    console.log(localStorage.getItem('productoNombre')); // Imprime el nombre del producto
    console.log(localStorage.getItem('productoPrecio')); // Imprime el precio
    console.log(localStorage.getItem('productoImagen')); // Imprime la imagen

    // Redirigir a la página de resultados
    window.location.href = 'seleccion.html'; // Asegúrate de que la página seleccion.html exista
}

// Función para mostrar los datos guardados en la página seleccion.html
function mostrarDatos() {
    const nombre = localStorage.getItem('productoNombre');
    const precio = localStorage.getItem('productoPrecio');
    const imagen = localStorage.getItem('productoImagen');

    // Verifica si los datos existen y se muestran correctamente
    console.log(`Nombre: ${nombre}, Precio: ${precio}, Imagen: ${imagen}`);

    document.getElementById('resultado').innerHTML = `
        <h2>Producto: ${nombre}</h2>
        <p>Precio: ${precio}$</p>
        <img src="${imagen}" alt="${nombre}" style="width: 200px; height: auto;">
    `;
}

function productos() {
    window.location.href = 'productos.html'; // Redirige a la página de productos
}
