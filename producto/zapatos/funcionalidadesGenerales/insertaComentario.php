<?php
include ("../../../configuracion/baseDatos.php");
session_start();

$productos = $data->query("SELECT P.nombre_producto, P.id_producto, P.id_vendedor, U.id, P.subcategoria 
                                FROM productos P INNER JOIN usuarios U ON P.id_vendedor = U.id ");

while ($imagen = $productos ->fetch_assoc()){

    if (isset($_POST['botonComentario'.$imagen['id_producto'].''])){

        $idP = $imagen["id_producto"];
        $idU = $_SESSION['id'];
        $random = uniqid();
        $comentario = $_POST['comentario'.$imagen['id_producto'].''];

        $data->query("INSERT INTO comentarios VALUES ('$random','$idP','$idU', '$comentario', now())");

        header('location: ../zapatosT.php');
        die();

    }
    header('location: ../zapatosT.php');
}

?>