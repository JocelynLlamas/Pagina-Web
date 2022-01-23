<?php
include("../../../configuracion/baseDatos.php");
session_start();

$comentarios = $data->query("SELECT C.id_comentario, C.id_producto, C.id_usuario, P.subcategoria 
                                    FROM comentarios C INNER JOIN productos P ON C.id_producto = P.id_producto ");

while ($nombreBoton = $comentarios->fetch_assoc()) {

    if (isset($_POST['elimina' . $nombreBoton['id_comentario'] . ''])) {

        $idP = $nombreBoton["id_producto"];

        $buscaComentario = $data->query("SELECT C.id_comentario, C.id_usuario, C.id_producto, C.comentario, U.nombre, U.id, U.email, P.id_producto, P.nombre_producto FROM comentarios C
                                                        INNER JOIN usuarios U ON C.id_usuario = U.id
                                                        INNER JOIN productos P ON C.id_producto = P.id_producto
                                                        AND P.id_producto = '{$nombreBoton['id_producto']}'
                                                        AND C.id_comentario = '{$nombreBoton['id_comentario']}'");

        $comentario = $buscaComentario->fetch_assoc();

//        echo $comentario['comentario'];
//        die();

        $verifica = $data->query("SELECT id_producto FROM productos WHERE id_producto = '$idP'");

        if ($verifica->num_rows ==1){
            $data->query("DELETE FROM comentarios WHERE id_producto = '$idP' AND comentario = '{$comentario['comentario']}'");
        }

        switch ($nombreBoton['subcategoria']){
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