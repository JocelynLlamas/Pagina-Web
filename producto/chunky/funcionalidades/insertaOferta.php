<?php
include ("../../../configuracion/baseDatos.php");
session_start();

$productos = $data->query("SELECT P.nombre_producto, P.id_producto, P.id_vendedor, A.archivo, P.subcategoria 
                                FROM productos P INNER JOIN archivos A ON P.id_producto = A.id_producto");
$producto = $productos->fetch_all();

foreach ($productos as $producto){

    if (isset($_POST[''.$producto['id_producto'].''])  && isset($_SESSION['email'])){


        $idP = $producto["id_producto"];
        $random = uniqid();

        $verifica = $data->query("SELECT id_producto FROM sale WHERE id_producto = '$idP'");

        if ($verifica->num_rows == 0){

            $data->query("INSERT INTO sale VALUES ('$idP', '$random')");

        }else{

            $data->query("DELETE FROM sale WHERE id_producto = '$idP'");
        }

        switch ($producto['subcategoria']){
            case 'Botas':
                header('location: ../Botas.php');
                break;
            case 'Zapatos':
                header('location: ../Zapatos.php');
                break;
        }

        die();

    }else if (!isset($_SESSION['email'])){
        header("location: ../../../login/login.php");
        die();
    }
}

?>