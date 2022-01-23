<?php
include("../configuracion/baseDatos.php");//CON ESTE SE CONECTA UWU
session_start();

$carritos = $data->query("SELECT * FROM carrito WHERE id_usuario = '{$_SESSION['id']}'");

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
        <title>Carrito</title>
    </head>
    <body>
    <a href="../index.php"><p class='ubicacion'>Inicio</p></a>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="titulo"><p>¡Bienvenido a tu carrito de compras!</p></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php
                while ($carrito = $carritos->fetch_assoc()) {
                $productos = $data->query("SELECT * FROM productos WHERE id_producto = '{$carrito['id_producto']}'");
                while ($producto = $productos->fetch_assoc()){
                ?>
                <div class="col containerProducto border">

                    <?php $categoria = $data->query("SELECT C.nombre FROM categoria C WHERE id_categoria = '{$producto['categoria']}'");
                    $nombreCat = $categoria->fetch_assoc();

                    $tallas = $data->query("SELECT numero FROM tallas WHERE id_talla = '{$carrito['id_talla']}'");
                    $talla = $tallas->fetch_assoc();
                    ?>

                    <a href="productoIndividual.php?id=<?php echo $producto['id_producto'];?>" style="color: white">
                        <p class="nombre"><?php echo $producto['nombre_producto']; ?></p>
                    </a>
                    <p class="texto">$ <?php echo $producto['precio']; ?> MXN</p>
                    <p class="text"><?php echo $nombreCat['nombre']; ?></p>
                    <p class="text">Talla: <?php echo $talla['numero'];?></p>

                    <!--CARRITO-->
                    <form method="post" action="insertaCarrito.php" class="texto">
                        Edita de tu carrito
                        <?php
                            $buscaCarrito = "SELECT * FROM carrito WHERE id_producto ='{$producto['id_producto']}' AND id_usuario = '{$_SESSION['id']}'";
                            $resultado = $data->query($buscaCarrito);
                            ?>
                            <div>
                                <button class="boton" type="submit" name="<?php echo $producto['id_producto'] ?>"
                                        value="<?php echo $producto['id_producto'] ?>">
                                    <?php
                                    if ($resultado->num_rows) {
                                        ?>
                                        <i class="fas fa-shopping-cart" style="color: #f30258"></i>
                                    <?php } else {
                                        ?>
                                        <i class="fas fa-cart-plus" style="color: white"></i>
                                    <?php }
                                    ?>
                                </button>
                            </div>
                        <?php } ?>
                    </form>

                    <?php
                    } die();
                    ?>
                </div>
            </div>
        </div>
    </div>

    </body>

    </html>
    <?php
}else{
    header('location: ../index.php'); //REDIRECCIONAR (LOCATION)
}
?>