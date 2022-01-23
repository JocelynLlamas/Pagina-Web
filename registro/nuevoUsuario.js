function mostrarContraseña(p){
    var contraseña = document.getElementById(p);
    if(contraseña.type == "password"){
        contraseña.type = "text";
    }else{
        contraseña.type = "password";
    }
}

document.getElementById("formulario").addEventListener("submit", (e)=>{

    const nombre = document.getElementById("nombre").value;
    const alerta_nombre = document.getElementById("alertNombreUsuario");

    const email = document.getElementById("email").value;
    const alerta_email = document.getElementById("alertEmail");

    const password = document.getElementById("password").value;
    const alerta_password = document.getElementById("alertPassword");

    if (email.length === 0){

        alerta_email.innerText = "¡Te faltó algo! No te olvides de agregar tu correo electrónico";
        e.preventDefault();

    }
    if (password.length === 0){

        alerta_password.innerText = "¡Te faltó algo! No te olvides de agregar tu contraseña";
        e.preventDefault();

    }
    if (nombre.length === 0){

        alerta_nombre.innerText = "¡Te faltó algo! No te olvides de agregar tu nombre de usuario";
        e.preventDefault();
    }

    this.onsubmit();

});