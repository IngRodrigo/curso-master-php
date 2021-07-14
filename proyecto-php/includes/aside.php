<aside id="sidebar">
    <?php if (isset($_SESSION['usuario'])) : ?>
        <div id="login" class="bloque">
            <h3><?php echo "Bienvenido: " . $_SESSION['usuario']['nombre']; ?></h3>
            <a href="Cerrar.php" class="boton boton-verde">Crear Entradas</a>
            <a href="Cerrar.php" class="boton boton-naranja">Mis Datos</a>
            <a href="Cerrar.php" class="boton">Cerrar sesion</a>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_login'])) : ?>
        <div class="alerta alerta-error">
            <h3><?= $_SESSION['error_login']; ?></h3>
        </div>
    <?php endif; ?>
    <div id="usuario-login" class="bloque">
        <h3>Identificate</h3>
        <form action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Acceso">
        </form>
    </div>
    <div id="registrar" class="bloque">
        <?php if (isset($_SESSION['completado'])) : ?>
            <div class="alerta alerta-exito">
                <?= $_SESSION['completado']; ?>
            </div>
        <?php elseif (isset($_SESSION['errores']['general'])) : ?>
            <div class="alerta alerta.error">
                <?= $_SESSION['errores']['general']; ?>
            </div>
        <?php endif; ?>
        <h3>Registrate</h3>
        <form action="registrar.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], "nombre") : ''; ?>
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], "apellidos") : ''; ?>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], "email") : ''; ?>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], "password") : ''; ?>
            <input type="submit" value="Registrate">

        </form>
        <!-- funcion para borrar la sessio de errores si se creo pero se corrigieron los errores -->
        <?php borraErrores(); ?>
    </div>
</aside>
<!-- Barra lateral - FIN -->