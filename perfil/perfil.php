<?php

include("../configuracion/baseDatos.php");//CON ESTE SE CONECTA UWU
session_start();
//$usuario = $_SESSION["nombre"];
if (isset($_SESSION["email"])){?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="perfil.css">
        <title>Perfil</title>
    </head>
    <body>
    <div class="container">
        <a href="../index.php" ><p class="ubicacion">Cuenta > Perfil</p></a>

        <div class="titulo"><p>Información del perfil</p></div>

        <div class="descripcion"><p>Nombre: <?php
                echo $_SESSION["nombre"] ?></p></div>

        <div class="descripcion"><p>Correo electrónico: <?php
                echo $_SESSION["email"] ?></p></div>

        <div class="descripcion" style="margin-bottom: 190px"><p>Rol: <?php
                echo $_SESSION["rol"] ?></p></div>

        <form method="post" action="../configuracion/cambia.php">

        </form>

    </div>

    </body>
<!--    <script defer src="configuracion.js"></script>-->
    <script src="https://kit.fontawesome.com/e4c5f4b000.js" crossorigin="anonymous"></script>
    </html>
    <?php
}else{
    header('location: ../index.php'); //REDIRECCIONAR (LOCATION)
}
?>