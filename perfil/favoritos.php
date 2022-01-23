<?php
include("../configuracion/baseDatos.php");//CON ESTE SE CONECTA UWU
session_start();

$favoritos = $data->query("SELECT * FROM favoritos WHERE id_usuario = '{$_SESSION['id']}'");

if (isset($_SESSION["email"])) {
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
              crossorigin="anonymous">
        <link rel="stylesheet" href="producto.css">
        <script src="https://kit.fontawesome.com/e4c5f4b000.js" crossorigin="anonymous"></script>
        <title>Favoritos</title>
    </head>
    <body>
    <a href="../index.php"><p class='ubicacion'>Inicio</p></a>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="titulo"><p>¡Aquí están tus favoritos!</p></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php
                while ($favorito = $favoritos->fetch_assoc()) {
                $productos = $data->query("SELECT * FROM productos WHERE id_producto = '{$favorito['id_producto']}'");
                while ($imagen = $productos->fetch_assoc()) {
                ?>
                <div class="col containerProducto border">

                    <?php $categoria = $data->query("SELECT C.nombre FROM categoria C WHERE id_categoria = '{$imagen['categoria']}'");
                    $nombreCat = $categoria->fetch_assoc();
                    ?>

                    <a href="productoIndividual.php?id=<?php echo $imagen['id_producto'];?>" style="color: white">
                        <p class="nombre"><?php echo $imagen['nombre_producto']; ?></p>
                    </a>
                    <p class="texto">$ <?php echo $imagen['precio']; ?> MXN</p>
                    <p class="text"><?php echo $nombreCat['nombre']; ?></p>

                    <!--                FAVORITOS-->
                    <form method="post" action="insertaFavoritos.php" class="texto">
                        Añade a favoritos
                        <?php

                        $buscaFavoritos = "SELECT * FROM favoritos WHERE id_producto ='{$imagen['id_producto']}' AND id_usuario = '{$_SESSION['id']}'";
                        $resultado = $data->query($buscaFavoritos);
                        ?>
                        <div>
                            <button class="boton" type="submit" name="<?php echo $imagen['id_producto'] ?>"
                                    value="<?php echo $imagen['id_producto'] ?>">
                                <?php
                                if ($resultado->num_rows) {
                                    ?>
                                    <i class="fas fa-heart iconoSeleccionado"></i>
                                <?php } else {
                                    ?>
                                    <i class="far fa-heart iconoNoSeleccionado"></i>
                                <?php }
                                ?>
                            </button>
                        </div>
                        <?php } ?>

                    </form>

                    <?php
                    }
                    die();
                    ?>
                </div>
            </div>
        </div>
    </div>

    </body>

    </html>
    <?php
} else {
    header('location: ../index.php'); //REDIRECCIONAR (LOCATION)
}
?>