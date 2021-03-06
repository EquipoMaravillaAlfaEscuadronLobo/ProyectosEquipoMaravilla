<?php
$titulo1 = 'Seguridad';
include_once '../plantillas/cabecera.php';
include_once '../plantillas/menu.php';
//echo $_SESSION['nivel'];

?>
<div class="nav-content nav-pills" name="">
    <ul class="tabs tabs-transparent">
        <li class="tab">
            <a class="" href="#test1" id="idRegistroAdministrador">
                <i class="fa fa-user" aria-hidden="true"></i> Registro Administradores
            </a>
        </li>
        <li class="tab">
            <a class="active" href="#test5" id="idListarAdmnistrador">
                <i class="fa fa-edit" aria-hidden="true"></i> Editar Administradores
            </a>
        </li>
        <li class="tab">
            <a href="#test9" class="">
                <i class="fa fa-trash-o" aria-hidden="true"></i> Administradores Eliminados
            </a>
        </li>
        <li class="tab">
            <a href="#test3" class="">
                <i class="fa fa-compass" aria-hidden="true"></i> Bitacora
            </a>
        </li>
        <li class="tab">
            <a href="#test4" class="">
                <i class="fa fa-save" aria-hidden="true"></i> Backup/Restaurar
            </a>
        </li>
        
        

    </ul>
</div>
</nav>

<div class="col s12" id="test1">
    <?php include_once './registro_administrador.php'; ?>
</div>
<div class="col s12" id="test5">
    <?php include_once './listado_administrador.php'; ?>
</div>

<div class="col s12" id="test3">
    <?php include_once './bitacora.php'; ?>
</div>
<div class="col s12" id="test4">
    <?php  include_once './backup_restore.php'; ?>
</div>
<div class="col s12" id="test9">
    <?php include_once './administradores_eliminados.php'; ?>
</div>

<?php
include_once '../plantillas/pie_de_pagina.php';
?>

<script>
    
    function abrirAyuda(opcion){
        var direccion;
        switch(opcion){
            case 1:
                direccion="../ayuda/regAdmin.php";
                break;
            case 2:
                direccion="../ayuda/listAdmin.php";
                break;
            case 3:
                direccion="../ayuda/listAdminBaja.php";
                break;
            case 4:
                direccion="../ayuda/backup.php";
                break;    
        }
        window.open(direccion, "_blank", "toolbar=no,scrollbars=yes,resizable=no,top=0,left=500,width=700,height=600");
    }

</script>


