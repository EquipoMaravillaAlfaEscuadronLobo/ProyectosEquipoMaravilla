<form  method="post" action="" autocomplete="off" id="eliminar_formulario">
    <input type="hidden" name="banderaEliminacion" id="banderaEliminacion"/>
    <input type="hidden" id="idSecretoEL" value="" name="nameSecretoELiminar">
    <input type="hidden" id="idOtroCarnet" name="nameOtroCarnet">

    <!--este es el modal-->
    <div id="eliminacion_administradores" class="modal modal-fixed-footer nuevo">
        <div class="modal-heading panel-heading">
            <h3 class="text-center">Dar de Baja Administradores</h3>
        </div>

        <div class="modal-content modal-lg">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="input-field col m5 input-group">
                                <i class="fa fa-user-circle prefix"></i> 
                                <input type="text" id="idNombreEl" name="nameNombreEl"  class="text-center" value="nombre" disabled="">
                                <label for="idNombreEl" class="col-sm-4 control-labe">Nombre Completo</label>
                            </div>
                            <div class="input-field col m5">
                                <i class="fa fa-vcard prefix"></i> 
                                <input type="text" id="idUsuarioEl" name="nameUsuarioEl"  class="text-center" disabled="" value="nombre">
                                <label for="idUsuarioEl">Nombre de Usuario</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="input-field text-center">
                                    <i class="fa fa-edit prefix" aria-hidden="true"></i>
                                    <label for="idMotivoEliminacion" class="text-center">Escriba el motivo por el que se le da de baja</label>
                                    <textarea  id="idMotivoEliminacion" name="nameMotivoEliminacion" class="text-center materialize-textarea text-center validate"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="input-field col m1">
                                <div class="input-field col m1">
                                    <i class="fa fa-star prefix"></i> 
                                </div>
                            </div>
                            <div class="input-field col m4">

                                <select  class="validate" required="" id="idSelectedAdministrador" name="nameSelectedAdministrador">
                                    <option value = "admin01"  selected>Seleccione Nuevo encargado de Activos</option>
                                    <?php
                                    echo '';
                                    if ($_SESSION['seleccionado'] != NULL) {
//                                        echo 'el seleccionado es este ' . $_SESSION['seleccionado'];
                                        $codigo = $_SESSION['seleccionado'];
                                        
                                    $lista_sin_actual = Repositorio_administrador::lista_administradores_para_baja(Conexion::obtener_conexion(), $codigo);
                                   
                                    if (($lista_sin_actual) != NULL) {
                                        foreach ($lista_sin_actual as $filaz) {
                                            ?>

                                            <option value="<?php echo $filaz->getCodigo_administrador(); ?>"><?php echo $filaz->getNombre() . ' ' . $filaz->getApellido(); ?></option>
                                            <?php
                                        }
                                    }
                                    }
                                    ?>


                                </select>
                            </div>
                            <div class="input-field col m5 text-center">
                                <i class="fa fa-expeditedssl prefix"></i> 
                                <input type="password" id="idVerificacion" name="nameVerificacionE" class="text-center validate" required="" autocomplete="off" >
                                <label for="idVerificacion">Para continuar por favor ingrese su contraseña</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-md-6 text-right"><button href="#" class="btn btn-success"><span class="glyphicon glyphicon-trash" aria="hidden"></span>Eliminar</button></div>
                <div class="col-md-6 text-left"><a href="#" class="modal-action modal-close waves-effect btn btn-danger"><span class="glyphicon glyphicon-remove" aria="hidden"></span>Salir</a></div>
            </div>
        </div>
    </div>
    <!--este es el fin de modal-->
</form>

<?php
if (isset($_REQUEST["banderaEliminacion"])) {

    $administrador = new Administrador();
    $administrador->setObservacion($_REQUEST['nameMotivoEliminacion']);
    $administrador->setEstado(0);
    $codigo_eliminar = $_REQUEST['nameOtroCarnet'];
    $verificacion = $_REQUEST['nameVerificacionE'];
    $codigo_administrador2 = $_REQUEST['nameSelectedAdministrador'];

    Repositorio_administrador::actualizar_activos_administradir(Conexion::obtener_conexion(), $codigo_eliminar, $codigo_administrador2);
    
    Repositorio_administrador::eliminar_administrador(Conexion::obtener_conexion(), $administrador, $codigo_eliminar, $verificacion);
}
?>