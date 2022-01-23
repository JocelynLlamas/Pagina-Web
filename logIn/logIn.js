function mostrarContraseña(){
    var contraseña = document.getElementById("password");
    if(contraseña.type == "password"){
        contraseña.type = "text";
    }else{
        contraseña.type = "password";
    }
}

document.getElementById("formulario").addEventListener("submit", (e)=>{

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

    this.onsubmit();

});