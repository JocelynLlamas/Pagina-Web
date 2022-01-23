<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="gracias.css">
    <title>Gracias por publicar</title>
</head>
<body>
<div class="container">
    <a href="../index.php"><p class="ubicacion">Vuelve al inicio</p></a>
    <div class="col"><img class="img" src="../static/logoBlanco.png" alt=""></div>
    <div class="col titulo"><p>Gracias por vender en Lolita Nabokov</p></div>
    <div class="descripcion" style="font-weight: lighter"><p>Nos encargaremos de que tus productos sean parte de esta
            comunidad de moda juvenil en calzado.</p></div>
    <div class="row">
        <button type="button" class="boton">
            <a href="vender.php" class="textoBoton">¡Publica otro producto!</a>
        </button>
    </div>
</div>
</body>
</html>
