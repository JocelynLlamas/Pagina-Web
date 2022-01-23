function mostrarContraseña(p){
    var contraseña = document.getElementById(p);
    if(contraseña.type == "password"){
        contraseña.type = "text";
    }else{
        contraseña.type = "password";
    }
}

document.getElementById("formularioNombre").addEventListener("submit", (e)=>{

    const nombre = document.getElementById("nombre").value;
    const alerta_nombre = document.getElementById("alertNombreUsuario");

    if (nombre.length === 0){

        alerta_nombre.innerText = "¡Te faltó algo! No te olvides de agregar tu nonbre de usuario";
        e.preventDefault();
    }

    this.onsubmit();
});

document.getElementById("formularioCorreo").addEventListener("submit", (e)=>{

    const email = document.getElementById("email").value;
    const alerta_email = document.getElementById("alertEmail");

    if (email.length === 0){

        alerta_email.innerText = "¡Te faltó algo! No te olvides de agregar tu correo electrónico";
        e.preventDefault();

    }

    this.onsubmit();
});

document.getElementById("formularioPassword").addEventListener("submit", (e)=>{

    const password = document.getElementById("password").value;
    const alerta_password = document.getElementById("alertPassword");

    if (password.length === 0){

        alerta_password.innerText = "¡Te faltó algo! No te olvides de agregar tu contraseña";
        e.preventDefault();

    }

    this.onsubmit();
});