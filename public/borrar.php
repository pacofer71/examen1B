<?php
session_start();
if (!isset($_POST['id']) || !isset($_SESSION['perfil']) || $_SESSION['perfil'] != "Admin") {
    header("Location:admin.php");
}
require "../vendor/autoload.php";

use Clases\Usuarios;

$id = $_POST['id'];
$usuario = new Usuarios();
$usuario->setId($id);
$datos = $usuario->recuperarUsuario();
if ($_SESSION['usuario'] == $datos->nombre) {
    $_SESSION['mensaje'] = "No se puede eliminar al usuario con es que estás logeado.";
    header("Location:admin.php");
    die();
}
if (basename($datos->imagen) != "default.jpg") {
    unlink($datos->imagen);
}
$usuario->delete();
$usuario = null;
$_SESSION['mensaje'] = "Usuario Eliminado.";
header("Location:admin.php");
