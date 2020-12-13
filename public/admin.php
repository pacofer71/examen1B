<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] != "Admin") {
    header("Location:index.php");
}
require "../vendor/autoload.php";

use Clases\Usuarios;

$usuario = new Usuarios();
$todos = $usuario->read();
$usuario = null;
?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../vendor/fortawesome/font-awesome/css/all.min.css" rel="stylesheet" />
    <title>admin</title>
</head>

<body style="background-color:lightblue">
    <nav class="navbar navbar-dark bg-dark justify-content-between mt-3 ml-3 mr-3">
        <a class="navbar-brand">Accesos S.A.</a>
        <form class='form-inline' action='cerrarSesion.php'>
            <input class='form-control bg-danger text-light font-weight-bold' type='text' value='<?php echo $_SESSION['usuario']; ?>' disabled='true'>
            <a href='cerrarSesion.php' class='ml-3 btn btn-danger my-2 my-sm-0' type='submit'><i class='fas fa-sign-out-alt'></i>Salir</a>
            <img src='<?php echo $_SESSION['foto'] ?>' width='50rem' height='50rem' class='ml-2 rounded-circle' />
        </form>



    </nav>
    <h3 class="text-center mt-3">Administración de Usuarios</h3>
    <div class="container mt-3">
        <?php
        if (isset($_SESSION['mensaje'])) {
            echo "<p class='my-3 p-3 bg-dark text-danger font-weight-bold'>{$_SESSION['mensaje']}</p>";
            unset($_SESSION['mensaje']);
        }
        ?>
        <a href="registro.php" class="btn btn-info my-2"><i class="fas fa-user-plus mr-2"></i>Crear Usuario</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Perfil</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = $todos->fetch(PDO::FETCH_OBJ)) {
                    echo <<<FIN
                        <tr>
                        <th scope="row">{$fila->id}</th>
                        <td>{$fila->nombre}</td>
                        <td>{$fila->perfil}</td>
                        <td>
                        <img src="{$fila->foto}" height="80rem" width="80rem" class="img-thumbnail" /> 
                        </td>
                        <td>
                        <form class="form form-inline" name="ac" method="POST" action="borrar.php">
                        <input type="hidden" name="id" value="{$fila->id}" />
                    FIN;
                    if ($fila->nombre == $_SESSION['usuario']) {
                        echo "<a href='editUser.php?nombre={$fila->nombre}&admin=2' class='btn btn-warning mr-2'><i class='fas fa-user-edit mr-2'></i>Editar</a>";
                        echo "<button class='btn btn-danger' type='submit' disabled><i class='fas fa-trash-alt mr-2'></i>Borrar</button>";
                    } else {
                        echo "<a href='editUser.php?nombre={$fila->nombre}&admin=1' class='btn btn-warning mr-2'><i class='fas fa-user-edit mr-2'></i>Editar</a>";
                        echo "<button class='btn btn-danger' type='submit'><i class='fas fa-trash-alt mr-2'></i>Borrar</button>";
                    }
                    echo "</form> </td></tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
</body>

</html>