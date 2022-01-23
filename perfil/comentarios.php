<?php
include("../configuracion/baseDatos.php");
session_start();

$productos = $data->query("SELECT * FROM productos P INNER JOIN comentarios C ON P.id_producto = C.id_producto AND C.id_usuario = '{$_SESSION['id']}' GROUP BY P.nombre_producto");


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
        <title>Comentarios</title>
    </head>
    <body>
    <a href="../index.php"><p class='ubicacion'>Inicio</p></a>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="titulo"><p>¡Bienvenido a la sección de tus comentarios!</p></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php
                while ($producto = $productos->fetch_assoc()) { ?>
                <div class="col containerProducto border">

                    <?php $categoria = $data->query("SELECT C.nombre FROM categoria C WHERE id_categoria = '{$producto['categoria']}'");
                    $nombreCat = $categoria->fetch_assoc();
                    ?>
                    <a href="productoIndividual.php?id=<?php echo $producto['id_producto'];?>">
                        <p class="nombre"><?php echo $producto['nombre_producto']; ?></p>
                    </a>
                    <p class="texto">$ <?php echo $producto['precio']; ?> MXN</p>
                    <p class="text"><?php echo $nombreCat['nombre']; ?></p>

                    <?php
                    $buscaComentario = "SELECT C.id_comentario, C.id_usuario, C.id_producto, C.comentario, C.fecha, U.nombre, U.id, U.email, P.id_producto, P.nombre_producto FROM comentarios C
                                                        INNER JOIN usuarios U ON C.id_usuario = U.id
                                                        INNER JOIN productos P ON C.id_producto = P.id_producto 
                                                        AND P.id_producto = '{$producto['id_producto']}'";
                    $resultado = $data->query($buscaComentario);

                    if ($resultado){?>
                        <div style="margin-top: 2%; background-color: #f6cddf" class="texto border-top rounded"><p>
                                Comentarios sobre este
                                producto</p></div>
                            <?php
                    while ($comentario = $resultado->fetch_assoc()) {?>
                        <div class="pt-3 pb-3 ps-3" style="margin-top: 1%">
                            <div class="justify-content-between">
                                <!--                                    NOMBRE DE USUARIO-->
                                <div class="d-flex justify-content-start align-items-center nombre"
                                     style="font-size: 1em; margin-left: 1%">
                                    <i class="far fa-user-circle" style="margin-right: 1%"></i>
                                    <?php echo $comentario['nombre'] .'('. $comentario['fecha'] . ')';?>
                                </div>
                                <!--                                    COMENTARIO-->
                                <div class="justify-content-center align-items-center rounded"
                                     style="background-color: #e7a6cf">
                                    <p><?php echo $comentario['comentario'] ?></p>
                                    <?php
                                    if (isset($_SESSION['email']) && $_SESSION['rol'] == 'Premium') {
                                        ?>
                                        <form method="post" action="eliminaComentario.php" class="texto">
                                            <div class="justify-content-center align-items-end btn-group"
                                                 style="text-align: end">
                                                <button class="btn btn-sm boton" type="submit"
                                                        name="elimina<?php echo $comentario['id_comentario'] ?>"
                                                        value="elimina<?php echo $comentario['id_comentario'] ?>">
                                                    <i class="far fa-trash-alt iconoNoSeleccionado"></i>
                                                </button>
                                            </div>
                                        </form>
                                    <?php } else if (isset($_SESSION['email']) && $_SESSION['email'] == $comentario['email'] && $_SESSION['rol'] == 'Basico') {
                                        ?>
                                        <form method="post" action="insertaComentario.php" class="texto">
                                            <div class="justify-content-center align-items-end btn-group"
                                                 style="text-align: end">
                                                <button class="btn btn-sm boton" type="submit"
                                                        name="elimina<?php echo $comentario['id_comentario'] ?>"
                                                        value="elimina<?php echo $comentario['id_comentario'] ?>">
                                                    <i class="far fa-trash-alt iconoNoSeleccionado"></i>
                                                </button>
                                            </div>
                                        </form>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                    <?php }
                    }
                    }
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