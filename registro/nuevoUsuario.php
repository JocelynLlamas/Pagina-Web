<?php
include("../configuracion/baseDatos.php"); //CON ESTE SE CONECTA UWU check
session_start();
var_dump($_SESSION);

if (isset($_SESSION["usuarioVerificado"])) {
    header('location: ../index.php');
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="nuevoUsuario.css">
    <script defer src="nuevoUsuario.js"></script>
    <script src="https://kit.fontawesome.com/e4c5f4b000.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
</head>
<body>
<div class="container">
    <div class="col"><img class="img" src="../static/logoBlanco.png" alt=""></div>
    <div class="descripcion"><p>Regístrate para realizar tus compras en línea</p></div>

    <form id="formulario" method="post" action="registrar.php">
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "nombreError" || $_GET["error"] == "correoNombreError") {
                ?>
                <div class="alerta">
                    Oops! El nombre ingresado ya esta ocupado por otro usuario.
                </div>
                <?php
            }
        }
        ?>
        <div id="alertNombreUsuario" class="alerta"></div>
        <div><input class="cajaInformacion" type="text" id="nombre" name="nombre" placeholder="Nombre de usuario" autocomplete="off"></div>

        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "correoError" || $_GET["error"] == "correoNombreError") {
                ?>
                <div class="alerta">
                    Oops! El correo ingresado ya esta ocupado por otro usuario.
                </div>
                <?php
            }
        }
        ?>
        <div id="alertEmail" class="alerta"></div>
        <div><input class="cajaInformacion" type="email" id="email" name="email" placeholder="Correo" autocomplete="off"></div>

        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "passwordError") {
                ?>
                <div class="alerta">
                    Oops! Las contraseñas no coinciden.
                </div>
                <?php
            }
        }
        ?>
        <div class="input-group mb-3">
            <div id="alertPassword" class="alerta"></div>
            <input type="password" id="password" class="form-control cajaInformacion" name="password" placeholder="Contraseña" aria-describedby="button-addon1">
            <button class="btn btn-outline-secondary mostrarContraseña" type="button" id="button-addon1" onclick="mostrarContraseña('password')" style="margin-left: -45px">
                <i class="fas fa-eye icono"></i>
            </button>
        </div>
        <div class="input-group mb-3">
            <div id="alertPassword" class="alerta"></div>
            <input type="password" id="password2" class="form-control cajaInformacion" name="password2" placeholder="Repite tu contraseña" aria-describedby="button-addon1">
            <button class="btn btn-outline-secondary mostrarContraseña" type="button" id="button-addon1" onclick="mostrarContraseña('password2')" style="margin-left: -45px">
                <i class="fas fa-eye icono"></i>
            </button>
        </div>
        <input class="boton" type="submit" name="registro" value="Regístrate">
    </form>


    <p class="txtCondiciones">Al registrarte aceptas nuestras Condiciones y Política de datos.</p>
    <p class="txtTienesCuenta">¿Ya tienes una cuenta?</p>
    <a class="iniciaSesion" href="../logIn/logIn.php">Inicia sesión</a>
</div>
</body>
</html>