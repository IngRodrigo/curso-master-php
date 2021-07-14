<?php
if (isset($_POST)) {

    require_once("./includes/Conexion.php");

    $email = isset($_POST['email']) ? $_POST['email'] : false;
    $password = isset($_POST['password']) ? $_POST['password'] : false;

    $usuario = traerUsuario($email, $password, $conexion);
    if (isset($_SESSION['error_login'])) {
        session_unset();
    }
    if (!$usuario == null) {
        $_SESSION['login_correcto'] = "Login correcto.";
        $_SESSION['usuario'] = $usuario;
    } else {
        $_SESSION['error_login'] = "El usuario o la contraseña no son validos.";
    }
}

function traerUsuario($email, $password, $conexion)
{
    $sql = "Select * from usuarios where email='$email'";
    $consulta = mysqli_query($conexion, $sql);
    //si existe un solo registro
    if ($consulta && mysqli_num_rows($consulta) == 1) {
        $resultado = mysqli_fetch_assoc($consulta);
        if (comprobarPassword($password, $resultado['password'])) {
            return $resultado;
        } else {
            return null;
        }
    }
}
function comprobarPassword($password, $password_bd)
{
    $resultado = false;
    if (password_verify($password, $password_bd)) {
        $resultado = true;
    }
    return $resultado;
}
header('Location: index.php');
