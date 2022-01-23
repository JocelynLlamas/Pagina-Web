<?php
include('configuracion/baseDatos.php');
session_start();
//var_dump($_SESSION);

if (!isset($_POST['buscar'])){
    $_POST['buscar'] = '';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" ; charset="utf-8">
    <title>Lolita Nabokov</title>
    <link rel="stylesheet" href="index.css">
    <script defer src="index.js"></script>
    <script src="https://kit.fontawesome.com/e4c5f4b000.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
<div class="container-fluid fondo">
    <div class="row">
        <div class="col"><img class="img" src="static/logoBlanco.png" alt=""></div>
        <div class="col containerIconos">

            <form method="get" action="buscador.php" style="">
                <input class="form-control me-2 barraBusqueda" type="search" placeholder="Busca aquí"
                       aria-label="Busca aquí" name="buscar" id="buscar" value="" autocomplete="off" style="float: left">
                <button type="text" class="btn" style="float: left"><i class="fas fa-search icono"></i></button>
            </form>

            <div class="dropdown">
                <i class="fas fa-user icono" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                   aria-expanded="false"></i>
                <ul class="dropdown-menu menuUsuario" aria-labelledby="dropdownMenuButton1">
                    <?php
                    if (!isset($_SESSION["email"])) {
                        ?>
                        <li><a class="dropdown-item" href="logIn/logIn.php">Iniciar Sesión</a></li>
                        <?php
                    } else {
                        ?>
                        <li><a class="dropdown-item" href="perfil/perfil.php">Perfil</a></li>
                        <li><a class="dropdown-item" href="configuracion/configuracion.php">Configuración</a></li>
                        <?php if ($_SESSION["rol"] == "Premium") { ?>
                            <li><a class="dropdown-item" href="admin/administrador.php">Administrador</a></li>
                            <?php
                        } ?>
                        <li><a class="dropdown-item" href="perfil/favoritos.php">Favoritos</a></li>
                        <li><a class="dropdown-item" href="perfil/comentarios.php">Comentarios</a></li>
                        <li><a class="dropdown-item" href="perfil/vender.php">Vender</a></li>
                        <li><a class="dropdown-item" href="logIn/cerrarSesion.php">Cerrar Sesión</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <a href="perfil/carrito.php"><i class="fas fa-shopping-cart icono"></i></a>
        </div>
    </div>
</div>
<div class="container-fluid fondo">
    <div class="row">
        <nav class="menu col">

            <?php

            $obtenCategoria = $data->query("SELECT * FROM categoria");

            while ($categoria = $obtenCategoria->fetch_assoc()) {

                $id_categoria = $categoria['id_categoria'];
                $obtenSubcategoria = $data->query("SELECT * FROM subcategoria WHERE id_categoria = '$id_categoria'");

                ?>
                <div class="item" id="<?php echo $categoria['nombre']; ?>"
                     onmouseover="mostrarSM('s<?php echo $categoria['nombre']; ?>','<?php echo $categoria['nombre']; ?>')"
                     onmouseout="ocultaSM('s<?php echo $categoria['nombre']; ?>')">

                    <a href="producto/<?php echo strtolower($categoria['nombre']); ?>/<?php echo $categoria['nombre']; ?>T.php"><?php echo $categoria['nombre']; ?></a>

                </div>
                <div class="subMenu" id="s<?php echo $categoria['nombre']; ?>" style="padding: 0px; width: 20%;"
                     onmouseover="mostrarSM('s<?php echo $categoria['nombre']; ?>','<?php echo $categoria['nombre']; ?>')"
                     onmouseout="ocultaSM('s<?php echo $categoria['nombre']; ?>')"><?php
                    while ($subcategoria = $obtenSubcategoria->fetch_assoc()) { ?>
                        <a
                        href="producto/<?php echo strtolower($categoria['nombre']); ?>/<?php echo $subcategoria['nombre'] ?>.php"><?php echo $subcategoria['nombre']; ?></a><?php
                    } ?>
                </div>
                <?php
            }
            ?>
            <div class="item" id="Sale"
                 onmouseover="mostrarSM('sSale','Sale')"
                 onmouseout="ocultaSM('sSale')">

                <a href="producto/sale/saleT.php">Sale</a>

            </div>
        </nav>

    </div>
</div>
<!--VIDEO-->
<div>
    <video width="100%" autoplay muted loop>
        <source src="static/media/video.mp4" type="video/mp4">
        No es compatible :c
    </video>
</div>
<!--SLIDER-->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="static/slider/slider1.jpg" class="d-block w-100 imagenSlider" alt="...">
        </div>
        <div class="carousel-item">
            <img src="static/slider/slider2.jpg" class="d-block w-100 imagenSlider" alt="...">
        </div>
        <div class="carousel-item">
            <img src="static/slider/slider3.jpg" class="d-block w-100 imagenSlider" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!--GALERIA-->
<div><h3 class="tituloGaleria">¡Inspírate con nuestra galería de looks!</h3></div>
<div class="row" style="width: 100%">
    <!--PRIMER CAJA CONTENEDORA-->
    <div class="col-md cajaContenedora" style="margin-left: 10px">
        <img class="imagenGaleria" src="static/galeria/galeria1.jpg" alt="img1">
        <div class="transparencia"></div>
        <div class="cajaContenedoraTexto">
            <p class="textoCaja">Recrea este look</p>
            <p>Lolita Nabokov</p>
        </div>
    </div>

    <!--SEGUNDA CAJA CONTENEDORA-->
    <div class="col-md cajaContenedora">
        <img class="imagenGaleria" src="static/galeria/galeria2.jpg" alt="img2">
        <div class="transparencia"></div>
        <div class="cajaContenedoraTexto">
            <p class="textoCaja">Recrea este look</p>
            <p>Lolita Nabokov</p>
        </div>
    </div>

    <!--TERCER CAJA CONTENEDORA-->
    <div class="col-md cajaContenedora">
        <img class="imagenGaleria" src="static/galeria/galeria3.jpg" alt="img3">
        <div class="transparencia"></div>
        <div class="cajaContenedoraTexto">
            <p class="textoCaja">Recrea este look</p>
            <p>Lolita Nabokov</p>
        </div>
    </div>

    <!--CUARTA CAJA CONTENEDORA-->
    <div class="col-md cajaContenedora">
        <img class="imagenGaleria" src="static/galeria/galeria4.jpg" alt="img4">
        <div class="transparencia"></div>
        <div class="cajaContenedoraTexto">
            <p class="textoCaja">Recrea este look</p>
            <p>Lolita Nabokov</p>
        </div>
    </div>
</div>
<div class="row" style="width: 100%;margin-top: 10px">
    <!--PRIMER CAJA CONTENEDORA-->
    <div class="col-md cajaContenedora" style="margin-left: 10px">
        <img class="imagenGaleria" src="static/galeria/galeria5.jpg" alt="img1">
        <div class="transparencia"></div>
        <div class="cajaContenedoraTexto">
            <p class="textoCaja">Recrea este look</p>
            <p>Lolita Nabokov</p>
        </div>
    </div>

    <!--SEGUNDA CAJA CONTENEDORA-->
    <div class="col-md cajaContenedora">
        <img class="imagenGaleria" src="static/galeria/galeria6.jpg" alt="img2">
        <div class="transparencia"></div>
        <div class="cajaContenedoraTexto">
            <p class="textoCaja">Recrea este look</p>
            <p>Lolita Nabokov</p>
        </div>
    </div>

    <!--TERCER CAJA CONTENEDORA-->
    <div class="col-md cajaContenedora">
        <img class="imagenGaleria" src="static/galeria/galeria7.jpg" alt="img3">
        <div class="transparencia"></div>
        <div class="cajaContenedoraTexto">
            <p class="textoCaja">Recrea este look</p>
            <p>Lolita Nabokov</p>
        </div>
    </div>

    <!--CUARTA CAJA CONTENEDORA-->
    <div class="col-md cajaContenedora">
        <img class="imagenGaleria" src="static/galeria/galeria8.jpg" alt="img4">
        <div class="transparencia"></div>
        <div class="cajaContenedoraTexto">
            <p class="textoCaja">Recrea este look</p>
            <p>Lolita Nabokov</p>
        </div>
    </div>
</div>
<!--LINEA SEPARADORA-->
<div class="separador"></div>
<!--CAJA CONTACTO-->
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-lg-2">
            <img src="static/logoBlanco.png" alt="" width="200" style="margin-top: 10px; margin-bottom: 10px">
        </div>
        <div class="col-md-auto">
            <h1 class="acercaDeTitulo">¿Necesitas ayuda?</h1>
            <div>
                <i class="fas fa-phone-volume iconoBarraInfo"></i>
                <a href="#" class="numeroTel">418 - 118 - 92 - 99</a>
            </div>
            <p class="texto">De lunes a viernes de 09:00 a 19:00.</p>

        </div>
        <div class="col col-lg-2">
            <h1 class="acercaDeTitulo">
                LOLITA NABOKOV<p class="acercaDeDescripcion">es una empresa familiar que ofrece calzado de moda para
                    mujeres. Nuestra comunidad adopta
                    las tendencias actuales y lanzar estilos de vanguardia, haciendo olas en el mundo de la moda
                    joven.</p>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1 class="acercaDeTitulo">Siguenos en redes sociales</h1>
            <div class="cajaRedes">
                <div class="circuloFb"><a href="https://www.facebook.com/"><i
                                class="fab fa-facebook-f iconoFacebook"></i></a></div>
                <div class="circuloIG"><a href="https://www.instagram.com/"><i class="fab fa-instagram iconoIG"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</html>