<?php
include ("../configuracion/baseDatos.php");

$categoria = $_GET['categoria'];

$verifica = $data ->query("SELECT S.nombre FROM subcategoria S INNER JOIN categoria C ON S.id_categoria = C.id_categoria AND C.id_categoria = '$categoria'");

$arr = [];

while ($subcategoria = $verifica->fetch_assoc()){
    array_push($arr,['s' => $subcategoria['nombre']]);
}
echo json_encode($arr);
