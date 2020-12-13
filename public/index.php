<!DOCTYPE html>
<?php
session_start();
?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../vendor/fortawesome/font-awesome/css/all.min.css" rel="stylesheet" />
    <title>accesossa</title>
</head>

<body style="background-color:lightblue">
    <nav class="navbar navbar-dark bg-dark justify-content-between mt-3 ml-3 mr-3">
        <a class="navbar-brand">Accesos S.A.</a>
        
            <?php
            if (isset($_SESSION['usuario'])) {
                echo "<form class='form-inline' action='cerrarSesion.php'>";
                if ($_SESSION['perfil'] == "Admin") {
                    echo "<input class='form-control bg-danger text-light font-weight-bold'  type='text' value='{$_SESSION['usuario']}' disabled='true'>";
                    echo "<a href='cerrarSesion.php' class='ml-3 btn btn-danger my-2 my-sm-0' type='submit'><i class='fas fa-sign-out-alt'></i>Salir</a>";
                    echo "<img src='{$_SESSION['foto']}' width='50rem' height='50rem' class='ml-2 rounded-circle' />";
                    echo "</form>";
                } else {
                    echo "<input class='form-control bg-dark text-light font-weight-bold'  type='text' value='{$_SESSION['usuario']}' disabled='true'>";
                    echo "<button class='ml-3 btn btn-danger my-2 my-sm-0' type='submit'><i class='fas fa-sign-out-alt mr-2'></i>Salir</button>";
                    echo "<img src='{$_SESSION['foto']}' width='50rem' height='50rem' class='ml-2 rounded-circle' />";
                    echo "</form>";
                }
            } else {
                echo "<form class='form-inline'>";
                echo "<input class='form-control bg-dark text-light font-weight-bold mr-3' type='text' value='Invitado' disabled='true'>";
                echo "<a href='registro.php' class='mr-3 btn btn-info'><i class='fas fa-user-plus mr-2'></i>Registrar</a>";
                echo "<a href='login.php' class='btn btn-primary'><i class='fas fa-sign-in-alt mr-2'></i>Entrar</a>";
                echo "</form>";
            }
            ?>
            
    </nav>
    <h3 class="text-center mt-3">Accesos S.A.</h3>
    <div class="container mt-3">
    <p class="text-center bg-info text-dark font-weight-bold p-3">Administrar Accesos S.A.</p>
    <?php
            //var_dump($_SESSION);
            if (isset($_SESSION['mensaje'])) {
                echo "<p class='my-3 p-3 bg-dark text-danger font-weight-bold'>{$_SESSION['mensaje']}</p>";
                unset($_SESSION['mensaje']);
            }
            if(isset($_SESSION['perfil']) && $_SESSION['perfil']=="Admin"){
                echo <<<TEXTO
                    <a href="admin.php" class="btn btn-danger m-auto"><i class="fas fa-user-cog mr-2"></i>Administrar Usuarios</a>
                TEXTO;
            }
            if(isset($_SESSION['perfil']) && $_SESSION['perfil']=="Normal"){
                echo <<<TEXTO
                    <a href="editUser.php?nombre={$_SESSION['usuario']}" class="btn btn-primary m-auto"><i class="fas fa-user-edit mr-2"></i>Editar Usuario</a>
                TEXTO;
            }

        
    ?>


    </div>
</body>

</html>