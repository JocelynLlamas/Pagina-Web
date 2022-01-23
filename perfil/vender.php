<?php
include("../configuracion/baseDatos.php");
session_start();

if (!isset($_SESSION["email"])) {
    header("location: ../index.php");
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="vender.css">
    <title>Vender</title>
    <link rel="icon" href="../static/shoppingBag.ico">
</head>
<body>
<div class="container">
    <a href="../index.php"><p class="ubicacion">Compras > Vender</p></a>

    <div class="titulo"><p>¡Hola! Antes que nada cuéntanos, ¿qué vas a publicar?</p></div>
    <!--PARA QUE ACEPTE IMAGENES-->
    <form id="formulario" method="post" enctype="multipart/form-data" action="vende.php">
        <div><input class="cajaInformacion" type="hidden" name="idUsuario" id="idUsuario"></div>

        <div class="subtitulo"><p>1. Ponle un nombre a tu producto</p></div>
        <div id="alertNombreProducto" class="alerta"></div>
        <div style="margin-top: -50px"><input class="cajaInformacion" type="text" id="nombreProducto"
                                              name="nombreProducto" placeholder="Nombre del producto"
                                              autocomplete="off"></div>

        <div class="subtitulo"><p>2. Indica el precio de tu producto</p></div>
        <div id="alertPrecio" class="alerta"></div>
        <div><input class="cajaInformacion" type="number" id="precio" name="precio" placeholder="Precio"
                    autocomplete="off" min="1"></div>

        <div class="subtitulo"><p>3. ¿Cuánto stock tienes disponible?</p></div>
        <div id="alertStock" class="alerta"></div>
        <div><input class="cajaInformacion" type="number" id="stock" name="stock" placeholder="Stock"
                    autocomplete="off" min="1"></div>

        <div class="subtitulo"><p>4. Elige el tipo de calzado que vas a publicar</p></div>
        <div>
                <select class="menu" name="categoria" id="formularioCategoria">
                    <option selected name="default" value="default">Selecciona</option>
                    <?php

                    $obtenCategoria = $data->query("SELECT * FROM categoria");

                    while ($categoria = $obtenCategoria->fetch_assoc()) {
                        $id_categoria = $categoria['id_categoria'];
                        ?>
                        <option name="<?php echo $categoria['nombre']; ?>" value="<?php echo $categoria['id_categoria']; ?>">
                            <?php echo $categoria['nombre']; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
        </div>

        <script>
            document.getElementById("formularioCategoria").addEventListener("change",(event)=>{
                if (event.target.value !== 'default'){
                    const botonasCategoria = event.target.value;
                    // let subs;
                    fetch("obtenCategoria.php?categoria="+botonasCategoria).then(event => event.json()).then(sub=>{
                        sub.forEach(s =>{
                            document.getElementById("subCategoria").innerHTML += `<option>${s.s}</option>`;
                        })
                    });
                }else {
                    document.getElementById("subCategoria").innerHTML = `<option></option> `;
                }
            })
        </script>

        <div class="subtitulo"><p>Elige la subcategoria</p></div>
        <div>
            <select class="menu" name="subcategoria" id="subCategoria">

            </select>
        </div>

        <div class="subtitulo"><p>5. Sube fotos de tu producto</p></div>
        <div id="alertArchivo" class="alerta"></div>
        <div class="archivos" id="src-archivo">
            <input type="file" id="imagenProducto" name="imagenProducto[]" accept="image/*" multiple="multiple"
                   class="selecciona">
        </div>

        <div class="subtitulo"><p>6. Por último describe brevemente tu producto</p></div>
        <div id="alertDescripcion" class="alerta"></div>
        <div><input class="cajaInformacion" type="text" id="descripcion" name="descripcion" placeholder="Descripción"
                    autocomplete="off" style="width: 500px"></div>

        <input class="boton" type="submit" name="botonProducto" value="Continuar">
    </form>



</div>

</body>
<script defer src="vender.js"></script>
<script src="https://kit.fontawesome.com/e4c5f4b000.js" crossorigin="anonymous"></script>
</html>