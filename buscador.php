<?php
include("configuracion/baseDatos.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="buscador.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
    <title><?php echo $_GET['buscar']; ?> | Lolita Nabokov</title>
</head>
<body>
<a href="index.php" class="ubicacion"><p style="margin-left: 2%">Inicio</p></a>
<h5 class="titulo"><?php echo $_GET['buscar']; ?></h5>

<div class="container">
    <div class="row">
        <div class="col" style="float: right">
            <form method="post" class="filtro">
                Precio
                <input type="number" name="precioMin" placeholder="mínimo" value="" autocomplete="off"
                       class="inputFiltro" min="1">
                <input type="number" name="precioMax" placeholder="máximo" value="" autocomplete="off"
                       class="inputFiltro" min="1">
                <input type="submit" name="rango" placeholder="enviar" value=" ➜" class="enviar">
            </form>
        </div>
        <div class="col">
            <form method="post" action="" class="filtro">
                Ordena por
                <input class="boton" type="submit" name="ascendente" value="Menor precio">
                <input class="boton" type="submit" name="descendente" value="Mayor precio">
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_GET['buscar'])) {
    $buscar = $_GET['buscar'];

    $buscarDatos = "SELECT * FROM productos WHERE descripcion LIKE LOWER('%$buscar%') OR subcategoria LIKE LOWER('%$buscar%') OR nombre_producto LIKE LOWER('%$buscar%')";

    if (isset($_POST['ascendente'])) {

        $buscarDatos = "SELECT * FROM productos WHERE descripcion LIKE LOWER('%$buscar%') OR subcategoria LIKE LOWER('%$buscar%') OR nombre_producto LIKE LOWER('%$buscar%') ORDER BY precio ASC";

    } else if (isset($_POST['descendente'])) {

        $buscarDatos = "SELECT * FROM productos WHERE descripcion LIKE LOWER('%$buscar%') OR subcategoria LIKE LOWER('%$buscar%') OR nombre_producto LIKE LOWER('%$buscar%') ORDER BY precio DESC";

    } else if (isset($_POST['rango'])) {

        $min = $_POST['precioMin'];
        $max = $_POST['precioMax'];

        $buscarDatos = "SELECT * FROM productos WHERE (descripcion LIKE LOWER('%$buscar%') OR subcategoria LIKE LOWER('%$buscar%') OR nombre_producto LIKE LOWER('%$buscar%')) AND precio BETWEEN $min AND $max";
    }


    $busca2 = $data->query($buscarDatos);

    while ($resultado = $busca2->fetch_assoc()) {
        ?>
            <div class="container-fluid informacion" >
                <a href="perfil/productoIndividual.php?id=<?php echo $resultado['id_producto'];?>" class="enlace">
                    <?php echo $resultado['nombre_producto']; ?>
                </a>
                <p>$ <?php echo $resultado['precio']; ?> MXN </p>
                <p> <?php echo $resultado['descripcion']; ?> </p>
                <p> <?php echo $resultado['subcategoria']; ?> </p>
                <p> <?php echo $resultado['fecha']; ?> </p>
            </div>
    <?php }

    if ($busca2->num_rows == 0) {?>
        <div class="alert alert-warning d-flex align-items-center" role="alert" style="justify-content: center">
            <i class="fas fa-exclamation-triangle"></i>
            <div style="margin-left: 1%">
                No existen productos, por favor inténtelo de nuevo.
            </div>
        </div>
    <?php }
}
?>
</body>
<script src="https://kit.fontawesome.com/e4c5f4b000.js" crossorigin="anonymous"></script>
</html>

