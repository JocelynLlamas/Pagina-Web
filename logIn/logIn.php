<?php
include("../configuracion/baseDatos.php"); //CON ESTE SE CONECTA UWU check
session_start();

if (isset($_SESSION["usuarioVerificado"])){
    header('location: ../index.php');
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="logIn.css">
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
</head>
<body>
<div class="container">
    <div class="col"><img class="img" src="../static/logoBlanco.png" alt=""></div>
    <form id="formulario" method="post" action="entrar.php" onsubmit="return validacion();">

        <div id="alertEmail" class="alerta"></div>
        <input class="cajaInformacion" type="email" id="email" name="email" placeholder="Correo Electrónico" autocomplete="off">

        <div class="input-group mb-3">
            <div id="alertPassword" class="alerta"></div>
            <input type="password" id="password" class="form-control cajaInformacion" name="password" placeholder="Contraseña" aria-describedby="button-addon1" autocomplete="off">
            <button class="btn btn-outline-secondary mostrarContraseña" type="button" id="button-addon1" onclick="mostrarContraseña()" style="margin-left: -45px">
                <i class="fas fa-eye icono"></i>
            </button>
        </div>
<!--        <input type="text" id="password" name="password" placeholder="Correo Electrónico">-->
        <input class="boton" type="submit" name="login" value="Inicia sesión">
    </form>
    <div class="row">
        <p class="txtNoTienesCuenta">¿No tienes una cuenta?</p>
        <a class="registrate" href="../registro/nuevoUsuario.php" >Regístrate</a>
    </div>
</div>
</body>
<script defer src="logIn.js"></script>
<script src="https://kit.fontawesome.com/e4c5f4b000.js" crossorigin="anonymous"></script>
</html>
