<?php

if (isset($_POST)) {

    include_once('./includes/Conexion.php');
    //session_start();
    $nombre = isset($_POST['nombre']) ?  mysqli_real_escape_string($conexion, $_POST['nombre']) : false; //si existe lo asigna si no solo devuelve false 
    $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($conexion, $_POST['apellido']) : false; //si existe lo asigna si no solo devuelve false 
    $email = isset($_POST['email']) ? $_POST['email'] : false; //si existe lo asigna si no solo devuelve false 
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conexion, $_POST['password']) : false; //si existe lo asigna si no solo devuelve false 
    $error = [];

    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0,9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $error['nombre'] = "El nombre no es valido.";
    }

    if (!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0,9]/", $apellido)) {
        $apellido_validado = true;
    } else {
        $apellido_validado = false;
        $error['apellidos'] = "Los apellidos no son validos.";
    }
    if (empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validado = true;
        $error['email'] = "El email no es valido";
    }
    if (empty($password)) {
        $password_valido = true;
        $error['password'] = "El password no es valido";
    }

    $guardarUsuario = false;
    if (count($error) == 0) {
        //cifrar la contraseña
        //password_hash requiere 3 parametros. La cadena, el tipo de cifrado, y un array con
        //el cost, que seria la cantidad de veces que lo cifrara en este caso use 4 veces
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
        //Insertar usuario
        $query = "Insert into usuarios values(null, '$nombre', '$apellido', '$email', '$password_segura', CURDATE());";

        $guadar = mysqli_query($conexion, $query);
        // var_dump(mysqli_error($conexion));
        // die();
        if (mysqli_error($conexion) == "") {
            $_SESSION['completado'] = "Registro exitoso!";
        } else {
            $_SESSION['errores']['general'] = "Fallo al registrar el usuario";
        }
    } else {
        $_SESSION['errores'] = $error;
    }
}

header("Location: index.php");
