<?php
session_start();
require "../vendor/autoload.php";
use Clases\Usuarios;
function mostrarError($t){
    $_SESSION['error']=$t;
    header("Location:{$_SERVER['PHP_SELF']}");
    die();
}
if(isset($_POST['login'])){
    $usuario=trim(strtolower($_POST['nombre']));
    $pass=trim($_POST['pass']);
    if(strlen($usuario)==0 || strlen($pass)==0){
        mostrarError("Rellene los campos");
    }
    $usu=new Usuarios();
    $id=$usu->isValido($usuario, $pass);
    if($id!=null){
        $usu->setId($id);
        $datosUsu=$usu->recuperarUsuario();
        $_SESSION['usuario']=$usuario;
        $_SESSION['perfil']=$datosUsu->perfil;
        $_SESSION['foto']=$datosUsu->foto;
        $usu=null;
        setcookie('error', "", time()-100);  //reseteo los errores
        header("Location: index.php");
    }
    else{
        $usu=null;
        if(isset($_COOKIE['error'])){
            $cont=(int)($_COOKIE['error'])+1;
            if($cont==3){
                setcookie('error', $cont, time()+30);
            }else{
                setcookie('error', $cont, time()+24*3600);
            }
        }
        else{
            setcookie('error', "1", time()+24*3600);
        }
        mostrarError("Error de Validación");
    }
}
else{
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../vendor/fortawesome/font-awesome/css/all.min.css" rel="stylesheet" />
    <title>Login</title>
</head>

<body style="background-color:lightblue">
    <h3 class="text-center mt-3">Accesos S.A.</h3>

    <div class="container mt-3 mb-4">
        <?php
        if(isset($_SESSION['error'])){
            echo "<p class='my-3 p-3 bg-dark text-danger font-weight-bold'>{$_SESSION['error']}, te quedan ".(3-$_COOKIE['error'])." intentos</p>";
            unset($_SESSION['error']);
        }
        ?>
        <div class="card text-white bg-secondary mb-3 m-auto mt-5" style="max-width: 48rem;">
            <div class="card-header text-center">Login</div>
            <div class="card-body">
                <form name="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="form-group">
                        <label for="nu">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="nu" placeholder="Ingrese su nombre" name="nombre" required>
                        
                    </div>
                    <div class="form-group">
                        <label for="np">Password</label>
                        <input type="password" class="form-control" id="np" placeholder="Password" name="pass" required>
                    </div>
                   <?php
                        if(isset($_COOKIE['error']) && $_COOKIE['error']==3){
                                echo "<button type='submit' class='btn btn-primary' name='login' disabled><i class='fas fa-sign-in-alt mr-2'></i>Login (espere 30s)</button>";
                            
                        }
                        else{
                            echo "<button type='submit' class='btn btn-primary' name='login'><i class='fas fa-sign-in-alt mr-2'></i>Login</button>";
                        }

                    ?> 
                   
                    <a href="registro.php" class="ml-2 btn btn-info"><i class="fas fa-user-plus mr-2"></i>Registrarse</a>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
<?php } ?>