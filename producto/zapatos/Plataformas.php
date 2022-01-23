<?php
include("../../configuracion/baseDatos.php");
session_start();

$productos = $data->query("SELECT * FROM productos P INNER JOIN  categoria C ON P.categoria = C.id_categoria 
                                AND C.nombre = 'Zapatos' AND P.subcategoria = 'Plataformas'");
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
    <link rel="stylesheet" href="../../perfil/producto.css">
    <script src="https://kit.fontawesome.com/e4c5f4b000.js" crossorigin="anonymous"></script>
    <title>Zapatos Plataforma</title>
</head>
<body>
<a href="../../index.php"><p class="ubicacion">Inicio > Zapatos Plataforma</p></a>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="titulo"><p>PLATAFORMAS</p></div>
            <p class="tip">Recuerda que para añadir a tu carrito primero debes escoger tu talla.</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php
            while ($producto = $productos->fetch_assoc()) {
            ?>
            <div class="col containerProducto border">

                <?php $categoria = $data->query("SELECT C.nombre FROM categoria C WHERE id_categoria = '{$producto['categoria']}'");
                $nombreCat = $categoria->fetch_assoc();
                ?>

                <a href="../../perfil/productoIndividual.php?id=<?php echo $producto['id_producto'];?>" style="color: white">
                    <p class="nombre"><?php echo $producto['nombre_producto']; ?></p>
                </a>
                <p class="texto">$ <?php echo $producto['precio']; ?> MXN</p>
                <p class="text"><?php echo $nombreCat['nombre']; ?></p>

                <!--CARRITO-->
                <form method="post" action="funcionalidades/insertaCarrito.php" class="texto">
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
                    if (isset($_SESSION['email'])) {
                        $buscaCarrito = "SELECT * FROM carrito WHERE id_producto ='{$producto['id_producto']}' AND id_usuario = '{$_SESSION['id']}'";
                        $resultado = $data->query($buscaCarrito);
                        ?>
                        <div>
                            <button class="boton" type="submit" name="<?php echo $producto['id_producto'] ?>"
                                    value="<?php echo $producto['id_producto'] ?>">
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
                            <button class="boton" type="submit" name="<?php echo $producto['id_producto'] ?>"
                                    value="<?php echo $producto['id_producto'] ?>">
                                <i class="fas fa-cart-plus" style="color: white"></i>
                            </button>
                        </div>
                    <?php } ?>

                </form>

                <!--                FAVORITOS-->
                <form method="post" action="funcionalidades/insertaFavoritos.php" class="texto">
                    Añade a favoritos
                    <?php
                    if (isset($_SESSION['email'])) {

                        $buscaFavoritos = "SELECT * FROM favoritos WHERE id_producto ='{$producto['id_producto']}' AND id_usuario = '{$_SESSION['id']}'";
                        $resultado = $data->query($buscaFavoritos);
                        ?>
                        <div>
                            <button class="boton" type="submit" name="<?php echo $producto['id_producto'] ?>"
                                    value="<?php echo $producto['id_producto'] ?>">
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
                            <button class="boton" type="submit" name="<?php echo $producto['nombre_producto'] ?>"
                                    value="<?php echo $producto['nombre_producto'] ?>">

                                <i class="far fa-heart" style="color: white"></i>
                            </button>
                        </div>
                    <?php } ?>

                </form>

                <!--                COMENTARIO-->
                <?php
                if (isset($_SESSION['email'])) {
                    ?>
                    <form method="post" action="funcionalidades/insertaComentario.php" class="texto">
                        Añade un comentario
                        <div>
                            <input class="cajaInformacion" type="text"
                                   name="comentario<?php echo $producto['id_producto'] ?>"
                                   id="comentario<?php echo $producto['id_producto'] ?>" value=""
                                   placeholder="escribe aquí"
                                   autocomplete="off">
                        </div>
                        <input class="boton" type="submit"
                               name="botonComentario<?php echo $producto['id_producto'] ?>"
                               value="enviar">
                    </form>
                    <?php
                    if ($_SESSION['rol'] == 'Premium') {
                        $buscaPublicacion = "SELECT * FROM productos WHERE id_producto ='{$producto['id_producto']}' AND id_vendedor = '{$_SESSION['id']}'";
                        $resultado = $data->query($buscaPublicacion);
                        ?>
                        <!--                            ELIMINA PUBLICACION-->
                        <form method="post" action="funcionalidades/eliminaPublicacion.php" class="texto">
                            Eliminar publicacion
                            <div>
                                <button class="boton" type="submit" name="elimina<?php echo $producto['id_producto'] ?>"
                                        value="elimina<?php echo $producto['id_producto'] ?>">
                                    <i class="fas fa-minus-circle iconoNoSeleccionado"></i>
                                </button>
                            </div>
                        </form>
                        <!--                        PONE EN OFERTA-->
                        <form method="post" action="funcionalidades/insertaOferta.php" class="texto">
                            <?php
                            $buscaOferta = "SELECT * FROM sale WHERE id_producto ='{$producto['id_producto']}'";
                            $resultado = $data->query($buscaOferta);
                            ?>
                            SALE
                            <div>
                                <button class="boton" type="submit" name="<?php echo $producto['id_producto'] ?>"
                                        value="<?php echo $producto['id_producto'] ?>"
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

                $archivos = $data->query("SELECT A.archivo FROM archivos A INNER JOIN productos P ON A.id_producto = P.id_producto AND P.id_producto = '{$producto['id_producto']}'");

                while ($archivo = $archivos->fetch_assoc()) {?>

                    <img src="<?php echo $archivo['archivo']?>" class="img">

                <?php }
                ?>

                <?php
                $buscaComentario = "SELECT C.id_comentario, C.id_usuario, C.id_producto, C.comentario, C.fecha,
                                    U.nombre, U.id, U.email, P.id_producto, P.nombre_producto FROM comentarios C
                                    INNER JOIN usuarios U ON C.id_usuario = U.id INNER JOIN productos P ON C.id_producto = P.id_producto 
                                    AND P.id_producto = '{$producto['id_producto']}'";

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
                                    <p><?php echo $comentarios['fecha'] ?></p>
                                    <?php
                                    if (isset($_SESSION['email']) && $_SESSION['rol'] == 'Premium') {
                                        ?>
                                        <form method="post" action="funcionalidades/eliminaComentario.php"
                                              class="texto">
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
                                        <form method="post" action="funcionalidades/insertaComentario.php"
                                              class="texto">
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
