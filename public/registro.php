<?php
session_start();

require "../vendor/autoload.php";

use Clases\Usuarios;

function mostrarError($t)
{
    $_SESSION['error'] = $t;
    header("Location:{$_SERVER['PHP_SELF']}");
    die();
}
function isImage($tipo)
{
    $imagenes = ["image/gif", "image/x-icon", "image/jpeg", "image/png", "image/svg+xml", "image/tiff", "image/webp"];
    return in_array($tipo, $imagenes);
}

if (isset($_POST['crear'])) {
    $usuario = new Usuarios();
    $nombre = trim(strtolower($_POST['nombre']));
    $pass = trim($_POST['pass']);
    if (strlen($nombre) == 0 || strlen($pass) == 0) {
        mostrarError("Rellene los campos");
    }
    $usuario->setNombre($nombre);
    if($usuario->existeNombre()){
        mostrarError("Ese Nombre de Usuario YA existe, elige otro");
    }
    $usuario->setPass(hash("sha256", $pass));

    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
        if (isImage($_FILES['foto']['type'])) {
            $nombreF = "./img/" . uniqid() . "_" . $_FILES['foto']['name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], $nombreF);
            $usuario->setFoto($nombreF);
        } else {
            $mensaje = "Error la foto de perfil debe ser un archivo de imagen";
            mostrarError($mensaje);
        }
    }
    else{
        $usuario->setFoto("./img/default.jpg");
    }
    if(isset($_POST['perfil'])){
        $usuario->setPerfil($_POST['perfil']);
    }
    else{
        $usuario->setPerfil("Normal");
    }
    $usuario->create();
    $usuario=null;
    $_SESSION['mensaje']="Usuario Creado Correctamente, inicie sesión";
    header("Location:index.php");




    
} else {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../vendor/fortawesome/font-awesome/css/all.min.css" rel="stylesheet" />
        <title>Registro</title>
    </head>

    <body style="background-color:lightblue">
        <h3 class="text-center mt-3">Accesos S.A.</h3>

        <div class="container mt-3 mb-4">
            <?php
            if (isset($_SESSION['error'])) {
                echo "<p class='my-3 p-3 bg-dark text-danger font-weight-bold'>{$_SESSION['error']}</p>";
                unset($_SESSION['error']);
            }
            ?>
            <div class="card text-white bg-secondary mb-3 m-auto mt-5" style="max-width: 48rem;">
                <div class="card-header text-center">Registro</div>
                <div class="card-body">
                    <form name="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nu">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="nu" placeholder="Ingrese su nombre" name="nombre" required>

                        </div>
                        <div class="form-group">
                            <label for="np">Password</label>
                            <input type="password" class="form-control" id="np" placeholder="Password" name="pass" required>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                        <?php
                        if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == "Admin") {
                            echo <<<TEXTO
                            <div class="form-group">
                                <label for="per">Perfil</label>
                                <select name="perfil" id="per" class="form-control">
                                <option selected>Normal</option>
                                <option>Admin</option>
                                </select>
                            </div>
                            TEXTO;
                        }
                        ?>
                        <button type="submit" class="btn btn-primary" name="crear"><i class="fas fa-user-plus mr-2"></i>Registrar Usuario</button>
                        <button type="reset" class="ml-2 btn btn-warning"><i class="fas fa-hand-sparkles mr-2"></i>Limpiar</button>
                        <a href="index.php" class="ml-2 btn btn-info"><i class="fas fa-home mr-2"></i>Inicio</a>
                    </form>

                </div>
            </div>
        </div>
    </body>

    </html>
<?php } ?>