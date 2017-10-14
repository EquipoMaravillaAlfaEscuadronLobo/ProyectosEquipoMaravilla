<?php
include_once '../app/Conexion.php';
include_once '../modelos/Usuario.php';
include_once '../modelos/Institucion.php';
Conexion::abrir_conexion();
include_once '../repositorios/repositorio_usuario.inc.php';
include_once '../repositorios/repositorio_institucion.php';

?>

<!--formulario usuario-->
<div class="container">
    <form id="FORMULARIO" method="post" class="form-horizontal" action="" autocomplete="off">
        <input type="hidden" name="banderaRegistro" id="banderaRegistro"/>
        <div class="row">
            <div class="panel" name="libros">
                <div class="panel-heading text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Registro De Usuarios</h3>
                        </div>
                    </div>
                </div>
                <div class=" text-center panel-body">
                    <div class="row">
                        <div class="col m1"></div>
                        <div class="input-field col m5">
                            <i class="fa fa-user-circle prefix"></i> 
                            <input type="text" id="idNombre" name="nameNombre"  class="text-center validate" maxlength="25" minlength="3" required>
                            <label for="idNombre" class="col-sm-4 control-labe">Nombre <small> (Ej: Nombre1 Nombre2)</small></label>
                        </div>
                        <div class="input-field col m5">
                            <i class="fa fa-user-circle  prefix"></i> 
                            <input type="text" id="idApellido" name="nameApellido"  class="text-center validate" maxlength="25" minlength="3" required>
                            <label for="idApellido">Apellido <small>(Ej: Apellido1 Apellido2)</small></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m1"></div>
                        <div class="input-field col m5">
                            <i class="fa fa-map-marker  prefix"></i> 
                            <input type="text" id="idDireccion" name="nameDireccion" class="text-center validate" minlength="10" required="">
                            <label for="idDireccion">Direccion <small>(Ej: Verapaz, Colonia Mercenenes)</small> </label>
                        </div>

                        <div class="input-field col m5">
                            <i class="fa fa-envelope-o prefix"></i> 
                            <input type="email" id="idEmail" name="nameEmail" class="text-center validate" required="" >
                            <label for="idEmail">Email <small>(Ej: correo@gmail.com)</small> </label>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col m1"></div>
                        <div class="input-field col m5">
                            <i class="fa fa-phone prefix"></i> 
                            <input type="text" id="idTelefono" name="nameTelefono" class="text-center" required="" minlength="8" >
                            <label for="idTelefono">Numero Telefonico <small>(Ej: 2255-5555)</small></label>
                        </div>

                        <div class="input-field col m1">
                            <div class="input-field col m1">
                                <i class="fa fa-hospital-o prefix"></i> 
                            </div>
                        </div>
                        <div class="input-field col m4">
                            <select required="" name="nameInstitucion" id="institucion">
                                <option value = "" disabled selected>Seleccione Institucion</option>
                                <?php
                                $lista_instituciones = Repositorio_institucion::lista_institucion(Conexion::obtener_conexion());

                                foreach ($lista_instituciones as $lista_ins) {
                                    ?>
                                <option value = '<?php echo $lista_ins->getCodigo_institucion();?>' ><?php echo $lista_ins->getNombre(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m5">
                            <i class="fa fa-intersex prefix"></i> 
                            <div class="radio-inline">
                                <span>Sexo</span>
                                <input type="radio" id="idHombre"  name="NameSexo"  class="text-center with-gap" checked="" value="Masculino">
                                <label for="idHombre">Masculino</label>

                                <input type="radio" id="idMujer" name="NameSexo"  class="text-center with-gap" value="Femenino">
                                <label for="idMujer">Femenino</label>
                            </div>
                            <div class="col 1"></div>
                        </div>
                        <div class="col m6">
                            <div class="col m2"></div>
                            <div class="file-field input-field col m10">
                                <div class="btn btn-primary">
                                    <span class="glyphicon glyphicon-picture" aria="hidden"></span> Foto                          
                                    <input type="file">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" name="nameFoto" id="idFoto">
                                    <input type="file" id="files" name="files[]">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <output id="list"></output>                
                    </div>
                    <div class="row text-center">
                        <button class="btn btn-success">
                            <span class="glyphicon glyphicon-floppy-disk" aria="hidden"></span>                            
                            Guardar</button>
                        <button type="reset" class="btn btn-danger" onclick="location.href='inicio_usuario.php';">
                            <span class="glyphicon glyphicon-remove" aria="hidden"></span>Cancelar
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
<!--fin formulario usuario-->
<script>
    $('#FORMULARIO').attr('autocomplete', 'off');
    document.getElementById('FORMULARIO').setAttribute('autocomplete', 'off');
</script>

<?php
if (isset($_REQUEST["banderaRegistro"])) {
    Conexion::abrir_conexion();
    $usuario= new Usuario();

    $usuario->setApellido($_REQUEST["nameApellido"]);
    $usuario->setDireccion($_REQUEST["nameDireccion"]);
    $usuario->setNombre($_REQUEST["nameNombre"]);
    $usuario->setObservacion("");
    $usuario->setSexo($_REQUEST['NameSexo']);
    $usuario->setEmail($_REQUEST['nameEmail']);
    $usuario->setTelefono($_REQUEST['nameTelefono']);
    $usuario->setCodigo_institucion($_REQUEST['nameInstitucion']);
    

     Repositorio_usuario::insertar_usuario(Conexion::obtener_conexion(), $usuario);

}
?>








