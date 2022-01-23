<?php
include("baseDatos.php");//CON ESTE SE CONECTA UWU
session_start();

if (isset($_POST["cambiaNombre"])) {
    $nombre = $_POST["nombre"];

    $verificaNombre = $data->query("SELECT * FROM usuarios WHERE nombre = '$nombre'");

    if (!$verificaNombre->num_rows){
        $verificar = $data->query("UPDATE usuarios SET nombre = '$nombre' where id = '{$_SESSION['id']}'");
        $_SESSION['nombre'] = $_POST['nombre'];

        header('location: configuracion.php');
    }else{
        header('location: configuracion.php?error=nombreError');
    }
}

if (isset($_POST["cambiaCorreo"])) {
    $email = $_POST["email"];

    $verificaCorreo = $data->query("SELECT * FROM usuarios WHERE email = '$email'");

    if (!$verificaCorreo->num_rows){
        $verificar = $data->query("UPDATE usuarios SET email = '$email' where id = '{$_SESSION['id']}'");
        $_SESSION['email'] = $_POST['email'];

        header('location: configuracion.php');
    }else{
        header('location: configuracion.php?error=correoError');
    }
}

if (isset($_POST["cambiaPassword"])) {
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    if ($password != $password2){
        header('location: configuracion.php?error=passwordError');
        die();
    }

    $verificar = $data->query("UPDATE usuarios SET password = '$password' where id = '{$_SESSION['id']}'");

    if ($verificar) {
        header('location: configuracion.php');
    } else {
        header('location: configuracion.php');
    }
}


