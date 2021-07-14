<?php
function mostrarErrores($errores, $campo)
{
    $alerta = "";
    if (isset($errores[$campo]) && !empty($errores[$campo])) {
        $alerta = "<div class='alerta alerta.error'><p>El campo $campo no puede estar vacio. </p></div>";
    }
    return $alerta;
}
function borraErrores()
{
    $borrado = false;
    if (isset($_SESSION['errores'])) {
        $_SESSION['errores'] = null;
        $borrado = session_unset();
    }
    if (isset($_SESSION['completado'])) {
        $_SESSION['completado'] = null;
        $borrado = session_unset();
    }


    return $borrado;
}
