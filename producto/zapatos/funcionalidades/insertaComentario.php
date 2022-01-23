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

        switch ($imagen['subcategoria']){
            case 'Chunky':
                header('location: ../Chunky.php');
                break;
            case 'Planos':
                header('location: ../Planos.php');
                break;
            case 'Plataformas':
                header('location: ../Plataformas.php');
                break;
            case 'Sandalias':
                header('location: ../Sandalias.php');
                break;
            case 'Sneakers':
                header('location: ../Sneakers.php');
                break;
        }

        die();

    }
    header('location: ../botasT.php');
}

?>