document.getElementById("formulario").addEventListener("submit", (e)=>{

    const nombre = document.getElementById("nombreProducto").value;
    const alerta_nombre = document.getElementById("alertNombreProducto");

    const precio = document.getElementById("precio").value;
    const alerta_precio = document.getElementById("alertPrecio");

    const stock = document.getElementById("stock").value;
    const alerta_stock = document.getElementById("alertStock");

    const archivo = document.getElementById("imagenProducto").value;
    const alerta_archivo = document.getElementById("alertArchivo");

    const descripcion = document.getElementById("descripcion").value;
    const alerta_descripcion = document.getElementById("alertDescripcion");

    if (nombre.length === 0){

        alerta_nombre.innerText = "¡Te faltó algo! No te olvides de agregar el nombre de tu producto";
        e.preventDefault();
    }
    if (precio.length === 0){

        alerta_precio.innerText = "¡Te faltó algo! No te olvides de agregar el precio";
        e.preventDefault();

    }
    if (stock.length === 0){

        alerta_stock.innerText = "¡Te faltó algo! No te olvides de agregar stock disponible";
        e.preventDefault();

    }
    if (archivo.length === 0){

        alerta_archivo.innerText = "¡Te faltó algo! No te olvides de agregar fotos de tu producto";
        e.preventDefault();

    }
    if (descripcion.length === 0){

        alerta_descripcion.innerText = "¡Te faltó algo! No te olvides de agregar una descripción";
        e.preventDefault();

    }



    this.onsubmit();

});