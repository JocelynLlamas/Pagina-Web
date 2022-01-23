<?php

include("../configuracion/baseDatos.php");//CON ESTE SE CONECTA UWU
session_start();

if ($_SESSION["rol"] != "Premium") {
    header("location: ../index.php");
}

$verificar = $data->query("SELECT * from usuarios");

if (isset($_SESSION["email"])) {
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="administrador.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
              crossorigin="anonymous">
        <title>Administrador</title>
    </head>
    <body>
    <div class="container">
        <a href="../perfil/producto.php"><p>HOLAAAA</p></a>
        <a href="../index.php"><p class="ubicacion">Cuenta > Administrador</p></a>

        <div class="titulo"><p>Administrador</p></div>

        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "correoError") {
                ?>
                <div class="alert alert-danger" role="alert">
                    Oops! El correo ingresado ya esta ocupado por otro usuario.
                </div>
                <?php
            }
        }
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "nombreError") {
                ?>
                <div class="alert alert-danger" role="alert">
                    Oops! El nombre ingresado ya esta ocupado por otro usuario.
                </div>
                <?php
            }
        }

        ?>

        <div class="table-responsive">
            <table class="table tabla" id="table">
                <thead>
                <tr>
                    <th>NOMBRE</th>
                    <th>EMAIL</th>
                    <th>ROL</th>
                    <th>ELIMINAR</th>
                    <th>HACER PREMIUM</th>
                    <th>EDITAR NOMBRE</th>
                    <th>EDITAR EMAIL</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($usuario = $verificar->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $usuario["nombre"]; ?></td>
                        <td><?php echo $usuario["email"]; ?></td>
                        <td><?php echo $usuario["rol"]; ?></td>
                        <td>
                            <?php
                            if ($usuario["id"] != $_SESSION["id"]) {
                                ?>
                                <form method="post">
                                <input type="hidden" name="idUsuario" value="<?php echo $usuario["id"]; ?>">
                                <button type="submit" name="botonElimina" class="boton">
                                    <span class="caja">
                                        <i class="fas fa-minus-circle icono"></i>
                                        <p class="elimina">eliminar</p>
                                    </span>
                                </button>
                                </form><?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($usuario["id"] != $_SESSION["id"] && $usuario["rol"] == "Basico") {
                                ?>
                                <form method="post">
                                <input type="hidden" name="idUsuario" value="<?php echo $usuario["id"]; ?>">
                                <button type="submit" name="botonPremium" class="boton">
                                    <span class="caja">
                                        <i class="fas fa-user-tie icono"></i>
                                        <p class="elimina">premium</p>
                                    </span>
                                </button>
                                </form><?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($usuario["id"] != $_SESSION["id"]) {
                                ?>
                                <form method="post">
                                <input type="hidden" name="idUsuario" value="<?php echo $usuario["id"]; ?>">
                                <div class="caja2">
                                    <button type="submit" name="botonEditaNombre" class="boton">
                                        <i class="fas fa-user-edit icono"></i>
                                    </button>
                                    <input class="cajaInformacion" type="text" id="nombre" name="nombre"
                                           placeholder="Nuevo nombre" autocomplete="off">
                                </div>
                                </form><?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($usuario["id"] != $_SESSION["id"]) {
                                ?>
                                <form method="post">
                                <input type="hidden" name="idUsuario" value="<?php echo $usuario["id"]; ?>">
                                <div class="caja2">
                                    <button type="submit" name="botonEditaEmail" class="boton">
                                        <i class="fas fa-envelope icono"></i>
                                    </button>
                                    <input class="cajaInformacion" type="email" id="email" name="email"
                                           placeholder="Nuevo email" autocomplete="off">
                                </div>
                                </form><?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    if (isset($_POST["botonElimina"])) {
                        $idUsuario = $_POST["idUsuario"];
                        $data->query("DELETE FROM usuarios WHERE id = '$idUsuario'");
                        header("location: administrador.php");

                    } else if (isset($_POST["botonEditaNombre"])) {
                        $idUsuario = $_POST["idUsuario"];
                        $nombre = $_POST["nombre"];

                        $verificar = $data->query("SELECT * from usuarios where nombre= '$nombre'");

                        if ($verificar->num_rows == 1) {
                            header('location: administrador.php?error=nombreError');
                            die();
                        }else{
                            $data->query("UPDATE usuarios SET nombre = '$nombre' WHERE id = '$idUsuario'");
                            header("location: administrador.php");
                        }

                    } else if (isset($_POST["botonPremium"])) {
                        $idUsuario = $_POST["idUsuario"];

                        $data->query("UPDATE usuarios SET rol = 'Premium' WHERE id = '$idUsuario'");
                        header("location: administrador.php");

                    } else if (isset($_POST["botonEditaEmail"])) {
                        $idUsuario = $_POST["idUsuario"];
                        $email = $_POST["email"];

                        $verificar = $data->query("SELECT * from usuarios where email= '$email'");

                        if ($verificar->num_rows == 1) {
                            header('location: administrador.php?error=correoError');
                            die();
                        } else {
                            $data->query("UPDATE usuarios SET email = '$email' WHERE id = '$idUsuario'");
                            header("location: administrador.php");
                        }
                    }
                }
                ?>
                </tbody>
            </table>
        </div>

    </div>

    </body>
    <script src="https://kit.fontawesome.com/e4c5f4b000.js" crossorigin="anonymous"></script>
    </html>
    <?php
} else {
    header('location: ../index.php'); //REDIRECCIONAR (LOCATION)
}
?>