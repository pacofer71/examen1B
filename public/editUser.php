<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['perfil']) || !isset($_GET['nombre'])) {
    header("Location: index.php");
    die();
}
$admin = isset($_GET['admin']);

require "../vendor/autoload.php";

use Clases\Usuarios;

function getUrl()
{
    global $admin;
    $url_0 = $_SERVER['PHP_SELF'] . "?nombre=" . $_GET['nombre'];
    return  $admin ? $url_0 . "&admin=".$_GET['admin'] : $url_0;
}

function mostrarError($t)
{
    $_SESSION['error'] = $t;
    header("Location:" . getUrl());
    die();
}
function isImage($tipo)
{
    $imagenes = ["image/gif", "image/x-icon", "image/jpeg", "image/png", "image/svg+xml", "image/tiff", "image/webp"];
    return in_array($tipo, $imagenes);
}

$esteUsuario = new Usuarios();
$esteUsuario->setNombre($_GET['nombre']);
$id = $esteUsuario->recuperarId();
$esteUsuario->setId($id);
$datos = $esteUsuario->recuperarUsuario();

$perfiles = ["Admin", "Normal"];

if (isset($_POST["editar"])) {
    $nomUsu = trim(strtolower($_POST['nombre']));
    $passUsu = trim($_POST['pass']);
    if (strlen($nomUsu) == 0 || strlen($passUsu) == 0) {
        mostrarError("Rellene los campos");
    }

    $esteUsuario->setNombre($nomUsu);
    $esteUsuario->setPass(hash("sha256", $passUsu));

    if ($esteUsuario->existeNombre() != 0) {
        mostrarError("Ese Nombre de Usuario YA existe, elige otro");
    }
    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
        if (isImage($_FILES['foto']['type'])) {
            $nombreF = "./img/" . uniqid() . "_" . $_FILES['foto']['name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], $nombreF);
            $esteUsuario->setFoto($nombreF);
            $_SESSION['foto'] = $nombreF;
            //borramos la foro anterior si no es default.jpg
            if (basename($datos->foto) != "default.jpg") {
                unlink($datos->foto);
            }
        } else {
            $mensaje = "Error la foto de perfil debe ser un archivo de imagen";
            mostrarError($mensaje);
        }
    } else {
        $esteUsuario->setFoto($datos->foto);
    }
    if (isset($_POST['perfil'])) {
        $esteUsuario->setPerfil($_POST['perfil']);
        $_SESSION['perfil']=$_POST['perfil'];
    } else {
        $esteUsuario->setPerfil("Normal");
    }
    $esteUsuario->update();
    $esteUsuario = null;
    if((isset($_GET['admin']) && $_GET['admin']==2) || !isset($_GET['admin']))
    $_SESSION['usuario'] = $nomUsu;

    $_SESSION['mensaje'] = "Usuario Actualizado Correctamente.";
    header("Location:index.php");
} else {
?>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../vendor/fortawesome/font-awesome/css/all.min.css" rel="stylesheet" />
        <title>Edit</title>
    </head>

    <body style="background-color:lightblue">
        <h3 class="text-center mt-3">Editar Usuario</h3>
        <div class="container mt-3 mb-4">
            <?php
            if (isset($_SESSION['error'])) {
                echo "<p class='my-3 p-3 bg-dark text-danger font-weight-bold'>{$_SESSION['error']}</p>";
                unset($_SESSION['error']);
            }
            ?>
            <?php
            if ($admin)
                echo "<div class='card text-white bg-danger mb-3 m-auto mt-5' style='max-width: 48rem;'>";
            else {
                echo "<div class='card text-white bg-secondary mb-3 m-auto mt-5' style='max-width: 48rem;'>";
            }
            ?>
            <div class="card-header text-center">
                <img src="<?php echo $datos->foto; ?>" width="90rem" height="90rem" class="rounded-circle">
            </div>
            <div class="card-body">
                <form name="login" action="<?php echo getUrl(); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nu">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="nu" value="<?php echo $datos->nombre; ?>" name="nombre" required>

                    </div>
                    <div class="form-group">
                        <label for="np">Password</label>
                        <input type="password" class="form-control" id="np" placeholder="Password" name="pass">
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                    <?php
                    if ($_SESSION['perfil'] == "Admin") {
                        echo "<div class='form-group'>\n";
                        echo "<label for='per'>Perfil</label>\n";
                        echo "<select name='perfil' id='per' class='form-control'>\n";
                        foreach ($perfiles as $item) {
                            if ($item == $datos->perfil) {
                                echo "<option selected>$item</option>\n";
                            } else {
                                echo "<option>$item</option>\n";
                            }
                        }

                        echo "</select>\n";
                        echo "</div>\n";
                    }
                    ?>
                    <button type="submit" class="btn btn-primary" name="editar"><i class="fas fa-user-edit mr-2"></i>Editar Usuario</button>
                    <a href="index.php" class="ml-2 btn btn-info"><i class="fas fa-home mr-2"></i>Inicio</a>
                </form>

            </div>
        </div>
        </div>
    </body>

    </html>
<?php } ?>