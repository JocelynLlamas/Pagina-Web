<?php
include ("../../../configuracion/baseDatos.php");
session_start();

$productos = $data->query("SELECT P.nombre_producto, P.id_producto, P.id_vendedor, P.subcategoria, A.archivo 
                                FROM productos P INNER JOIN archivos A ON P.id_producto = A.id_producto");
$producto = $productos->fetch_all();

foreach ($productos as $producto){

    if (isset($_POST[''.$producto['id_producto'].'']) && isset($_SESSION['email'])){

        $idP = $producto["id_producto"];
        $idU = $_SESSION['id'];
        $random = uniqid();

        $verifica = $data->query("SELECT id_producto FROM favoritos WHERE id_producto = '$idP' AND id_usuario = '$idU'");

        if ($verifica->num_rows == 0){

            $inserta = $data->query("INSERT INTO favoritos VALUES ('$idP','$idU','$random')");

            $inserta = "UPDATE favoritos SET '$idP','$idU','$random' WHERE id_usuario = '$idU'";

        }else{

            $elimina = $data->query("DELETE FROM favoritos WHERE id_producto = '$idP' AND id_usuario = '$idU'");
        }

        switch ($producto['subcategoria']){
            case 'Aguja':
                header('location: ../Aguja.php');
                break;
            case 'Plataforma':
                header('location: ../Plataforma.php');
                break;
        }

        die();

    }
    else if (!isset($_SESSION['email'])){
        header("location: ../../../login/login.php");
        die();
    }
}

?>