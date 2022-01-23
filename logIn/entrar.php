<?php
include("../configuracion/baseDatos.php");//CON ESTE SE CONECTA UWU
session_start();

if (isset($_POST["login"])) {
    $correo = $_POST["email"];
    $contraseña = $_POST["password"];
    $verificar = $data->query("SELECT * from usuarios where email= '$correo' and password = '$contraseña'");
//    var_dump($verificar);
    if ($verificar->num_rows == 0) {
        header('location: logIn.php');
    } else {
        $verificar = $verificar->fetch_assoc();

        $_SESSION["email"] = $verificar["email"];
        $_SESSION["nombre"] = $verificar["nombre"];
        $_SESSION["id"] = $verificar["id"];
        $_SESSION["rol"] = $verificar['rol'];
        var_dump($_SESSION);
//        die();
        header('location: ../index.php');
    }
}

//debbug y variables preglobales
//var_dump($_POST["login"]);
