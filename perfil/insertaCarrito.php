<?php
include ("../configuracion/baseDatos.php");
session_start();

$productos = $data->query("SELECT P.nombre_producto, P.id_producto, P.id_vendedor, A.archivo FROM productos P INNER JOIN archivos A ON P.id_producto = A.id_producto");
$producto = $productos->fetch_all();

foreach ($productos as $producto){

    if (isset($_POST[''.$producto['id_producto'].''])  && isset($_SESSION['email'])){

        $idTalla = $_POST['talla'];
        $idP = $producto["id_producto"];
        $idU = $_SESSION['id'];
        $random = uniqid();

        $verifica = $data->query("SELECT id_producto FROM carrito WHERE id_producto = '$idP' AND id_usuario = '$idU'");

        if ($_POST['talla'] == 'default' && $verifica->num_rows == 0) {

            header('location: ../botasT.php?error=tallaNoSeleccionada');
            die();
        }
        if ($verifica->num_rows == 0){

            $inserta = $data->query("INSERT INTO carrito VALUES ('$idP','$idU','$idTalla','$random')");

            $inserta = "UPDATE carrito SET '$idP','$idU','$idTalla','$random' WHERE id_usuario = '$idU'";

        }else{

            $elimina = $data->query("DELETE FROM carrito WHERE id_producto = '$idP' AND id_usuario = '$idU'");
        }

//        header('location: producto.php');
        header('location: carrito.php');
        die();

    }else if (!isset($_SESSION['email'])){
        header("location: ../login/login.php");
        die();
    }
}

?>