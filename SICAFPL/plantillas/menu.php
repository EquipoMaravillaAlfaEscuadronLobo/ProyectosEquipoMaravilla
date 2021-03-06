<?php
//session_start();
include_once '../app/Conexion.php';
include_once '../repositorios/repositorio_notificaciones.php';
Conexion::abrir_conexion();
$numero = repositorio_notificaciones::numero_notifiaciones(Conexion::obtener_conexion());

?>
<nav class="nav-extended">
    <div class="nav-wrapper">
        <div class="brand-logo">
            <a href="../app/home.php">
                <img src="../imagenes/libros.png" alt="" width="80%" height="100%">
            </a>
        </div>

        <a class="button-collapse" data-activates="mobile-demo" href="#">
            <i class="material-icons">
                menu
            </i>
        </a>
        <ul class="right hide-on-med-and-down" id="nav-mobile">
            <li>
                <a href="../activofijo/inicio_activo.php"> 

                    <i class="fa fa-television" aria-hidden="true"></i>  Activo Fijo
                </a>
            </li>
            <li>
                <a href="../biblioteca/inicio_b.php">
                    <i class="fa fa-book" aria-hidden="true"></i> Gestión de Biblioteca
                </a>
            </li>
            <li>
                <a href="../usuario/inicio_usuario.php">
                    <i class="fa fa-users" aria-hidden="true"></i>  Gestión de Usuarios
                </a>
            </li>
            <?php if ($_SESSION['nivel'] == '0') {?>          
            <li>
                <a href="../seguridad/inicio_seguridad.php">
                    <i class="fa fa-lock" aria-hidden="true"></i>  Seguridad
                </a>
            </li>
            <?php }?>
            
            <li>
                <a href="../Cuenta/inicio_cuenta.php">
                    <i class="fa fa-bell" aria-hidden="true"></i> Notificaciones
                    <span style="font-weight: bold; font-size: 15px" class="label-count">(<?php echo $numero;?>)</span>
                </a>
            </li>
            <li>
                <a href="../Cuenta/inicio_datos.php">
                    <i class="fa fa-wrench" aria-hidden="true"></i>
                    Mi Cuenta
                </a>
            </li>

            <li>
                <a href="../sesiones/cerrar.php">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar Sesion
                </a>
            </li>




        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li>
                <a href="../activofijo/inicio_af.php">
                    <i class="fa fa-television" aria-hidden="true"></i>  Activo Fijo
                </a>
            </li>
            <li>
                <a href="../biblioteca/inicio_b.php">
                    <i class="fa fa-book" aria-hidden="true"></i>  Gestión de Biblioteca
                </a>
            </li>
            <li>
                <a href="../usuario/inicio_usuario.php">
                    <i class="fa fa-users" aria-hidden="true"></i>  Gestión de Usuarios
                </a>
            </li>
            <?php if ($_SESSION['nivel'] == '0') {?>          
            <li>
                <a href="../seguridad/inicio_seguridad.php">
                    <i class="fa fa-lock" aria-hidden="true"></i>  Seguridad
                </a>
            </li>
            <?php } ?>
            
            <li>
                <a href="../Cuenta/inicio_cuenta.php">
                    <i class="fa fa-bell" aria-hidden="true"></i>  Notificaciones
                </a>
            </li>
            <li>
                <a href="../Cuenta/inicio_datos.php">
                    <i class="fa fa-wrench" aria-hidden="true"></i>
                    Mi Cuenta
                </a>
            </li>
            <li>
                <a href="../sesiones/cerrar.php">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar Sesion
                </a>
            </li>
        </ul>
    </div>