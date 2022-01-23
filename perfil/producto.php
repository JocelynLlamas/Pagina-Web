<?php
include("../configuracion/baseDatos.php");
session_start();
var_dump($_SESSION);
//$productos = $data->query("SELECT P.id_producto, P.id_vendedor, A.archivo FROM productos P INNER JOIN archivos A ON P.id_producto = A.id_producto");
$productos = $data->query("SELECT * FROM productos");
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
    <link rel="stylesheet" href="producto.css">
    <script src="https://kit.fontawesome.com/e4c5f4b000.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<a href="../index.php"><p class="ubicacion">Inicio</p></a>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="col"><img class="logo" src="../static/logoBlanco.png" alt=""></div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php
            while ($imagen = $productos->fetch_assoc()) {
            ?>
            <div class="col containerProducto border">

                <?php $categoria = $data->query("SELECT C.nombre FROM categoria C WHERE id_categoria = '{$imagen['categoria']}'");
                $nombreCat = $categoria->fetch_assoc();
                ?>

                <p class="nombre"><?php echo $imagen['nombre_producto']; ?></p>
                <p class="texto">$ <?php echo $imagen['precio']; ?> MXN</p>
                <p class="text"><?php echo $nombreCat['nombre']; ?></p>

                <!--CARRITO-->
                <form method="post" action="insertaCarrito.php" class="texto">
                    Tallas disponibles
                    <div>
                        <select class="menu" name="talla" id="formularioTalla">
                            <option selected name="default" value="default">Selecciona</option>
                            <?php

                            $obtenTalla = $data->query("SELECT * FROM tallas");

                            while ($talla = $obtenTalla->fetch_assoc()) {
                                $id_talla = $talla['id_talla'];
                                ?>
                                <option name="<?php echo $talla['numero']; ?>"
                                        value="<?php echo $talla['id_talla']; ?>">
                                    <?php echo $talla['numero']; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    Añade a tu carrito
                    <?php
                    if (isset($_SESSION['email']) && $_SESSION['rol'] == 'Basico') {
                        $buscaCarrito = "SELECT * FROM carrito WHERE id_producto ='{$imagen['id_producto']}' AND id_usuario = '{$_SESSION['id']}'";
                        $resultado = $data->query($buscaCarrito);
                        ?>
                        <div>
                            <button class="boton" type="submit" name="<?php echo $imagen['id_producto'] ?>"
                                    value="<?php echo $imagen['id_producto'] ?>">
                                <?php
                                if ($resultado->num_rows) {
                                    ?>
                                    <i class="fas fa-shopping-cart iconoSeleccionado"></i>
                                <?php } else {
                                    ?>
                                    <i class="fas fa-cart-plus iconoNoSeleccionado"></i>
                                <?php }
                                ?>
                            </button>

                        </div>
                    <?php } else {
                        ?>
                        <div>
                            <button class="boton" type="submit" name="<?php echo $imagen['id_producto'] ?>"
                                    value="<?php echo $imagen['id_producto'] ?>">
                                <i class="fas fa-cart-plus" style="color: white"></i>
                            </button>
                        </div>
                    <?php } ?>

                </form>

                <!--                FAVORITOS-->
                <form method="post" action="insertaFavoritos.php" class="texto">
                    Añade a favoritos
                    <?php
                    if (isset($_SESSION['email'])) {

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
                    <?php } else {
                        ?>
                        <div>
                            <button class="boton" type="submit" name="<?php echo $imagen['nombre_producto'] ?>"
                                    value="<?php echo $imagen['nombre_producto'] ?>">

                                <i class="far fa-heart" style="color: white"></i>
                            </button>
                        </div>
                    <?php } ?>

                </form>

                <!--                COMENTARIO-->
                <?php
                if (isset($_SESSION['email'])) {
                    ?>
                    <form method="post" action="insertaComentario.php" class="texto">
                        Añade un comentario
                        <div>
                            <input class="cajaInformacion" type="text"
                                   name="comentario<?php echo $imagen['id_producto'] ?>"
                                   id="comentario<?php echo $imagen['id_producto'] ?>" value=""
                                   placeholder="escribe aquí"
                                   autocomplete="off">
                        </div>
                        <input class="boton" type="submit"
                               name="botonComentario<?php echo $imagen['id_producto'] ?>"
                               value="botonComentario<?php echo $imagen['id_producto'] ?>">
                    </form>
                    <?php
                    if ($_SESSION['rol'] == 'Premium') {
                        $buscaPublicacion = "SELECT * FROM productos WHERE id_producto ='{$imagen['id_producto']}' AND id_vendedor = '{$_SESSION['id']}'";
                        $resultado = $data->query($buscaPublicacion);
                        ?>
                        <!--                            ELIMINA PUBLICACION -->
                        <form method="post" action="eliminaPublicacion.php" class="texto">
                            Eliminar publicacion
                            <div>
                                <button class="boton" type="submit" name="elimina<?php echo $imagen['id_producto'] ?>"
                                        value="elimina<?php echo $imagen['id_producto'] ?>">
                                    <i class="fas fa-minus-circle iconoNoSeleccionado"></i>
                                </button>
                            </div>
                        </form>
                        <!--                        PONE EN OFERTA-->
                        <form method="post" action="insertaOferta.php" class="texto">
                            <?php
                            $buscaOferta = "SELECT * FROM sale WHERE id_producto ='{$imagen['id_producto']}'";
                            $resultado = $data->query($buscaOferta);
                            ?>
                            SALE
                            <div>
                                <button class="boton" type="submit" name="<?php echo $imagen['id_producto'] ?>"
                                        value="<?php echo $imagen['id_producto'] ?>"
                                        style="background-color: red">
                                    <?php
                                    if ($resultado->num_rows) {
                                        ?>
                                        <i class="fas fa-tags"></i>
                                    <?php } else {
                                        ?>
                                        <i class="fas fa-tag iconoNoSeleccionado"></i>
                                    <?php }
                                    ?>
                                </button>
                            </div>
                        </form>
                    <?php }
                    ?>
                <?php }

                $archivos = $data->query("SELECT A.archivo FROM archivos A INNER JOIN productos P ON A.id_producto = P.id_producto AND P.id_producto = '{$imagen['id_producto']}'");

                while ($archivo = $archivos->fetch_assoc()) {

                    $abre = $archivo['archivo'];

                    echo "<img src=data:image/jpeg;base64," . base64_encode($abre) . ' class=img >';

                }
                ?>

                <?php
                $buscaComentario = "SELECT C.id_comentario, C.id_usuario, C.id_producto, C.comentario, U.nombre, U.id, U.email, P.id_producto, P.nombre_producto FROM comentarios C
                                                        INNER JOIN usuarios U ON C.id_usuario = U.id
                                                        INNER JOIN productos P ON C.id_producto = P.id_producto 
                                                        AND P.id_producto = '{$imagen['id_producto']}'";
                $resultado = $data->query($buscaComentario);

                if ($resultado) { ?>
                    <div style="margin-top: 2%; background-color: #f6cddf" class="texto border-top rounded"><p>
                            Comentarios sobre este
                            producto</p></div>
                    <?php
                    while ($comentarios = $resultado->fetch_assoc()) {
                        ?>
                        <div class="pt-3 pb-3 ps-3" style="margin-top: 1%">
                            <div class="justify-content-between">
                                <!--                                    NOMBRE DE USUARIO-->
                                <div class="d-flex justify-content-start align-items-center nombre"
                                     style="font-size: 1em; margin-left: 1%">
                                    <i class="far fa-user-circle" style="margin-right: 1%"></i>
                                    <?php echo $comentarios['nombre'] ?>
                                </div>
                                <!--                                    COMENTARIO-->
                                <div class="justify-content-center align-items-center rounded"
                                     style="background-color: #e7a6cf">
                                    <p><?php echo $comentarios['comentario'] ?></p>
                                    <?php
                                    if (isset($_SESSION['email']) && $_SESSION['rol'] == 'Premium') {
                                        ?>
                                        <form method="post" action="eliminaComentario.php" class="texto">
                                            <div class="justify-content-center align-items-end btn-group"
                                                 style="text-align: end">
                                                <button class="btn btn-sm boton" type="submit"
                                                        name="elimina<?php echo $comentarios['id_comentario'] ?>"
                                                        value="elimina<?php echo $comentarios['id_comentario'] ?>">
                                                    <i class="far fa-trash-alt iconoNoSeleccionado"></i>
                                                </button>
                                            </div>
                                        </form>
                                    <?php } else if (isset($_SESSION['email']) && $_SESSION['email'] == $comentarios['email'] && $_SESSION['rol'] == 'Basico') {
                                        ?>
                                        <form method="post" action="insertaComentario.php" class="texto">
                                            <div class="justify-content-center align-items-end btn-group"
                                                 style="text-align: end">
                                                <button class="btn btn-sm boton" type="submit"
                                                        name="elimina<?php echo $comentarios['id_comentario'] ?>"
                                                        value="elimina<?php echo $comentarios['id_comentario'] ?>">
                                                    <i class="far fa-trash-alt iconoNoSeleccionado"></i>
                                                </button>
                                            </div>
                                        </form>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                        <?php
                    }
                }
                }
                ?>
            </div>
        </div>
    </div>
</div>

</body>

</html>
