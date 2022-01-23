<?php
include('../configuracion/baseDatos.php');
session_start();

if (isset($_POST["botonProducto"])) {

    $nombreProducto = $_POST['nombreProducto'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $subcategoria = $_POST['subcategoria'];
    $idVendedor = $_SESSION['id'];
    $randomProducto = uniqid();

    $countfiles = count($_FILES['imagenProducto']['name']);

    for ($i = 0; $i < $countfiles; $i++) {

//        $imagen = $_FILES['imagenProducto']['tmp_name'][$i]; //COPIA TEMPORAL DEL ARCHIVO
//        $size = $_FILES['imagenProducto']['size'][$i];
//        $abrir = fopen($imagen, 'r');
//        $leer = fread($abrir, $size);
//        $leer = $data->escape_string($leer);
        $randomArchivo = uniqid();
        $directorio = '/archivos/';

        if(!file_exists("..". $directorio)){
            mkdir("..". $directorio);
        }

        $leer = $directorio . basename($_FILES['imagenProducto']['name'][$i]);
        move_uploaded_file($_FILES['imagenProducto']['tmp_name'][$i], ".." . $leer);

        $insertar = $data->query("INSERT INTO archivos values ( '$randomArchivo', '$randomProducto' , '$leer')");
    }

//    var_dump($archivos);
//    die();

    $insertar = $data->query("INSERT INTO productos values ( '$randomProducto', '$idVendedor' , '$nombreProducto', 
                              '$precio', '$stock', '$descripcion' , '$categoria' , '$subcategoria','0', now())");


    header("location: gracias.php");

} ?>