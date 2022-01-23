<?php
include("../../../configuracion/baseDatos.php");
session_start();

$productos = $data->query("SELECT P.nombre_producto, P.id_producto, P.id_vendedor, U.id, P.subcategoria 
                                FROM productos P INNER JOIN usuarios U ON P.id_vendedor = U.id");

while ($imagen = $productos->fetch_assoc()) {

    if (isset($_POST['elimina' . $imagen['id_producto'] . '']) && $_SESSION['rol'] == 'Premium') {

        $idP = $imagen["id_producto"];
        $idU = $imagen["id_vendedor"];

        $verifica = $data->query("SELECT id_producto FROM productos WHERE id_producto = '$idP' AND id_vendedor = '$idU'");

        if ($verifica->num_rows ==1){
            $data->query("DELETE FROM productos WHERE id_producto = '$idP'");
            $data->query("DELETE FROM archivos WHERE id_producto = '$idP'");
            $data->query("DELETE FROM comentarios WHERE id_producto = '$idP'");
            $data->query("DELETE FROM carrito WHERE id_producto = '$idP'");
            $data->query("DELETE FROM favoritos WHERE id_producto = '$idP'");
            $data->query("DELETE FROM sale WHERE id_producto = '$idP'");
        }

        header('location: ../chunkyT.php');
        die();

    }
}
?>