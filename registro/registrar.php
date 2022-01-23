<?php
include("../configuracion/baseDatos.php");//CON ESTE SE CONECTA UWU
session_start();

if (isset($_POST["registro"])) {
    $nombre = $_POST["nombre"];
    $correo = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    $random = uniqid();

    if ($password != $password2){
        header('location: nuevoUsuario.php?error=passwordError');
        die();
    }

    $verificarEmail = $data->query("SELECT * from usuarios where email= '$correo'");//VERIFICA SI YA EXISTE EL CORREO
    $verificarNombre = $data->query("SELECT * from usuarios where nombre= '$nombre'");

    if ($verificarEmail->num_rows == 1 && $verificarNombre->num_rows == 1){

        header('location: nuevoUsuario.php?error=correoNombreError');

    }else if ($verificarEmail->num_rows == 1) {

        header('location: nuevoUsuario.php?error=correoError');

    }else if ($verificarNombre->num_rows == 1){

        header('location: nuevoUsuario.php?error=nombreError');

    }

    $insertar = $data->query("INSERT INTO usuarios values ( '$random', '$nombre', '$correo', '$password', 'Basico')");

    if ($insertar) {
        $_SESSION["email"] = $correo;
        $_SESSION["id"] = $random;
        $_SESSION["nombre"] = $nombre;
        $_SESSION["rol"] = 'Basico';
        header('location: ../index.php');
    }
}
