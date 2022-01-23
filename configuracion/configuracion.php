<?php
include("baseDatos.php");//CON ESTE SE CONECTA UWU
session_start();

if (isset($_SESSION["email"])) {
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="configuracion.css">
        <title>Configuración</title>
    </head>
    <body>
    <div class="container">
        <a href="../index.php"><p class="ubicacion">Cuenta > Configuración</p></a>
        <div class="titulo"><p>Configuración de la cuenta</p></div>
        <div class="descripcion"><p>Cambia los datos de identificación de tu cuenta.</p></div>


        <form id="formularioNombre" method="post" action="cambia.php">
            <div style="text-align: center">
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "correoNombreError") {
                        ?>
                        <div class="alerta">
                            Oops! El nombre ingresado ya esta ocupado por otro usuario.
                        </div>
                        <?php
                    } else if ($_GET["error"] == "nombreError") {
                        ?>
                        <div class="alerta">
                            Oops! El nombre ingresado ya esta ocupado por otro usuario.
                        </div>
                        <?php
                    }
                }
                ?>
                <div id="alertNombreUsuario" class="alerta"></div>
                <input class="cajaInformacion" type="text" id="nombre" name="nombre"
                       placeholder="<?php echo $_SESSION['nombre'] ?>"
                       autocomplete="off">
                <div><input class="boton" type="submit" name="cambiaNombre" value="Cambiar"></div>
            </div>
        </form>

        <form id="formularioCorreo" method="post" action="cambia.php">
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "correoNombreError") {
                    ?>
                    <div class="alerta">
                        Oops! El correo ingresado ya esta ocupado por otro usuario.
                    </div>
                    <?php
                } else if ($_GET["error"] == "correoError") {
                    ?>
                    <div class="alerta">
                        Oops! El nombre ingresado ya esta ocupado por otro usuario.
                    </div>
                    <?php
                }
            } ?>
            <div style="text-align: center">
                <div id="alertEmail" class="alerta"></div>
                <input class="cajaInformacion" type="email" id="email" name="email"
                       placeholder="<?php echo $_SESSION['email'] ?>"
                       autocomplete="off">
                <div><input class="boton" type="submit" name="cambiaCorreo" value="Cambiar"></div>
            </div>

        </form>

        <form id="formularioPassword" method="post" action="cambia.php">
            <div class="input-group mb-3" style="text-align: center">
                <div id="alertPassword" class="alerta"></div>
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "passwordError") {
                        ?>
                        <div class="alerta">
                            Oops! Las contraseñas no coinciden.
                        </div>
                        <?php
                    }
                } ?>
                <input type="password" id="password" class="form-control cajaInformacion" name="password"
                       placeholder="Contraseña" aria-describedby="button-addon1" autocomplete="off">
                <button class="btn btn-outline-secondary mostrarContraseña" type="button" id="button-addon1"
                        onclick="mostrarContraseña('password')" style="margin-left: -45px">
                    <i class="fas fa-eye icono"></i>
                </button>
                <div>
                    <input type="password" id="password2" class="form-control cajaInformacion" name="password2"
                           placeholder="Repite tu contraseña" aria-describedby="button-addon1" autocomplete="off">
                    <button class="btn btn-outline-secondary mostrarContraseña" type="button" id="button-addon1"
                            onclick="mostrarContraseña('password2')" style="margin-left: -45px">
                        <i class="fas fa-eye icono"></i>
                    </button>
                    <div style="margin-bottom: 153px"><input class="boton" type="submit" name="cambiaPassword" value="Cambiar"></div>
                </div>

            </div>
        </form>

    </div>

    </body>
    <script defer src="configuracion.js"></script>
    <script src="https://kit.fontawesome.com/e4c5f4b000.js" crossorigin="anonymous"></script>
    </html>
    <?php
} else {
    header('location: ../index.php'); //REDIRECCIONAR (LOCATION)
}
?>