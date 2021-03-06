<?php
include_once '../repositorios/repositorio_administrador.inc.php';
include_once '../app/Conexion.php';
Conexion::abrir_conexion();
?>

<!--formulario usuario-->
<div class="container">
    <form id="FORMULARI" class="FORMULARI" method="post" class="form-horizontal"  autocomplete="off" enctype="multipart/form-data" action="">
        <input type="hidden" name="bandera1" id="bandera1">
        <div class="row" name="filaForm">
            <div class="panel" name="regisroAct">
                <div class="panel-heading text-center">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>Registro De Activo Fijo</h3>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-info" id="ayuda" onclick="abrirAyuda(2)"><i class="fa fa-info-circle"></i></button>
                        </div>
                    </div>
                </div>

                <div class=" text-center panel-body">
                    <div class="row">
                        <div class="col m1"></div>
                        <!--seccion del combo para encargado  -->
                        <div class="input-field col m1">
                            <div class="input-field col m1">
                                <i class="fa fa-user-circle prefix"></i>   
                            </div>
                        </div>
                        <div class="input-field col m3">

                            <select required="" name="admin" id="admin" >
                                <?php
                                Repositorio_administrador::lista_administradores2(Conexion::obtener_conexion());
                                ?>
                            </select>
                            <label for="idNombre" class="col-sm-5 control-labe" style="font-size: 18">Encargado</label>
                        </div>
                        <div class="col m1"></div>
                        <!-- termona el combo de encargado   -->
                        <div class="input-field col m5">
                            <i class="fa fa-calendar prefix"></i> 
                            <input type="date" id="fecha_adq" name="fecha_adq" class="datepicker2" required value="<?php echo date("d-m-Y"); ?>" > 
                            <label for="idNombre" class="col-sm-4 control-labe" style="font-size: 18">Fecha de Adquisición</label>
                        </div>

                    </div>
                    <div class="row" >
                        <div class="col m1"></div>
                        <!--seccion del combo para categoria  -->
                        <div class="input-field col m1">
                            <div class="input-field col m1">
                                <i class="fa fa-sitemap prefix"></i>   
                            </div>
                        </div>
                        <div class="input-field col m2" > 
                            <select name="selectCat" id="selectCat" class="selectCat" required="true">
                                <?php
                                include'select_categoria.php';
                                ?>
                            </select>
                            <label for="idNombre" class="col-sm-4 control-labe" style="font-size: 18">Tipo</label>
                        </div>
                        <div class="input-field col m1">
                            <input type="number"  min="1" max="500" id="cantidad" name="cantidad" placeholder="Cantidad" required="true" value="1">
                            <label for="catidad" style="font-size:15px ">Cantidad <small></small> </label>
                        </div>
                        <div class="input-field col m1">
                            <a class="btn btn_primary"  target="_blank" onclick="nuevaCat(1)"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span></a>
                        </div>
                        <!-- termona el combo de categoria   -->
                        <div class="input-field col m5">
                            <i class="fa fa-usd prefix"></i> 
                            <input type="number"  min="0" step="any" id="precioUnitario" name="precioUnitario" class="text-center validate" required=""   >
                            <label for="precioUnitario">Precio Unitario <small></small> </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m1"></div>
                        <!--seccion del combo para proveedor  -->
                        <div class="input-field col m1">
                            <div class="input-field col m1">
                                <i class="fa fa-truck prefix"></i>   
                            </div>
                        </div>
                        <div class="input-field col m3">
                            <select required="" name="selectPro" id="selectPro" class="selectPro">

                                <?php
                                include'select_proveedor.php';
                                ?>
                            </select>
                            <label for="idNombre" class="col-sm-4 control-labe" style="font-size: 18">Proveedor</label>
                        </div>
                        <div class="input-field col m1">
                            <a class="btn btn_primary"  target="_blank" onclick="nuevaCat(2)"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span></a>
                        </div>

                        <!-- termina el combo de proveedor   -->
                        <!-- foto  -->
                        <div class="col m5">
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span><i class="glyphicon glyphicon-picture" aria-hidden="true"></i>Foto</span>
                                    <input type="file" id="foto" required name="foto" accept="image/*">
                                </div>


                                <div class="file-path-wrapper">
                                    <input type="text" accept="image/*" required class="form-control file-path validate">
                                </div>
                            </div>
                        </div>
                        <!-- termina foto -->

                    </div>
                    <div class="row">
                        <output id="list"></output>                
                    </div>



                    <div class="row">
                        <div class="col m1"></div>
                        <div class="input-field col m5">
                            <i class="fa fa-barcode prefix"></i> 
                            <input type="text" id="nserie" name="nserie" class="text-center validate" required="" value="Sin Numero de Serie" onclick = "if (this.value == 'Sin Numero de Serie')
                                                                this.value = ''" onblur="if (this.value == '')
                                                                            this.value = 'Sin Numero de Serie'">
                            <label for="precioUnitario">Numero de Serie <small></small> </label>
                        </div>
                     

                        <div class="input-field col m5">
                            <i class="fa fa-adjust prefix"></i> 
                            <input type="text" id="color" name="color" class="text-center validate" required="" >
                            <label for="idEmail">Color<small></small> </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m1"></div>
                        <div class="input-field col m5">
                            <i class="fa fa-registered prefix"></i> 
                            <input type="text" id="marca" name="marca" class="text-center validate" required="" value="Sin Marca" onclick = "if (this.value == 'Sin Marca')
                                                                this.value = ''" onblur="if (this.value == '')
                                                                            this.value = 'Sin Marca'">
                            <label for="precioUnitario">Marca <small></small> </label>
                        </div>
                      

                        <div class="input-field col m5">
                            <i class="fa fa-windows prefix"></i> 
                            <input type="text" id="so" name="so" class="text-center validate" required="" value="Sin Sistema Operativo" onclick = "if (this.value == 'Sin Sistema Operativo')
                                                                this.value = ''" onblur="if (this.value == '')
                                                                            this.value = 'Sin Sistema Operativo'">
                            <label for="idEmail">Sistema Operativo <small></small> </label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col m1"></div>
                        <div class="input-field col m5">
                            <i class="fa fa-crop prefix"></i> 
                            <input type="text" id="dimensiones" name="dimensiones" class="text-center validate" required="" value="Sin Dimenciones" onclick = "if (this.value == 'Sin Dimenciones')
                                                                this.value = ''" onblur="if (this.value == '')
                                                                            this.value = 'Sin Dimenciones'">
                            <label for="dimensines">Dimensiones <small></small> </label>
                        </div>
                  

                        <div class="input-field col m5">
                            <i class="fa fa-circle-o-notch prefix"></i> 
                            <input type="text" id="ram" name="ram" class="text-center validate" required="" value="Sin Memoria Ram" onclick = "if (this.value == 'Sin Memoria Ram')
                                                                this.value = ''" onblur="if (this.value == '')
                                                                            this.value = 'Sin Memoria Ram'">
                            <label for="dimensines">Memoria Ram <small></small> </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m1"></div>
                        <div class="input-field col m5">
                            <i class="fa fa-laptop prefix"></i> 
                            <input type="text" id="modelo" name="modelo" class="text-center validate" required="" value="Sin Modelo" onclick = "if (this.value == 'Sin Modelo')
                                                                this.value = ''" onblur="if (this.value == '')
                                                                            this.value = 'Sin Modelo'">
                            <label for="idEmail">Modelo<small></small> </label>
                        </div>


                        <div class="input-field col m5">
                            <i class="fa fa-hdd-o prefix"></i> 
                            <input type="text" id="dd" name="dd" class="text-center validate" required="" value="Sin Disco Duro" onclick = "if (this.value == 'Sin Disco Duro')
                                                                this.value = ''" onblur="if (this.value == '')
                                                                            this.value = 'Sin Disco Duro'">
                            <label for="idEmail">Disco Duro <small></small> </label>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col m1"></div>
                        <div class="input-field col m10">
                            <i class="fa fa-microchip prefix"></i> 
                            <input type="text" id="pro" name="pro" class="text-center validate" required="" value="Sin Procesador" onclick = "if (this.value == 'Sin Procesador')
                                                                this.value = ''" onblur="if (this.value == '')
                                                                            this.value = 'Sin Procesador'">
                            <label for="idEmail">Procesador <small></small> </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m1"></div>
                        <div class="input-field col m10">
                            <i class="fa fa-pencil-square-o prefix"></i>
                            <textarea id="otro" name="otro" class="materialize-textarea" style="font-size:15px"></textarea>
                            <label for="textarea1" style="font-size:15px">&nbsp Otro</label>
                        </div>
                    </div>






                </div><!-- termina div panel center-->

                <div class="row">
                    <output id="list"></output>                
                </div>
                <!-- botones -->
                <div class="row text-center" name="botones">
                    <button  class="btn btn-success  " type="submit" form="FORMULARI" >
                        <span class="glyphicon glyphicon-floppy-disk" aria="hidden"></span>
                        Guardar</button>
                    <button type="reset" class="btn btn-danger" onclick="location.href = 'inicio_activo.php';">
                        <span class="glyphicon glyphicon-remove" aria="hidden"></span>Cancelar
                    </button>
                </div><!-- Termina botones -->

            </div> <!-- Termina panel regisroAct -->
        </div><!-- Termina filaForm -->
    </form><!--fin formulario usuario-->

</div><!--fin container-->



<script crossorigin="a
        nonymous" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" src="https://code.jquery.com/jquery-2.2.4.min.js">
</script>


<div id="nuevaCat" class="modal modal-fixed-footer" ><!-- para llamar al modal PARA REGISTRAR CATEGORIA-->
    <div class="modal-heading panel-heading text-center">
        <i class="fa fa-sitemap prefix"></i><h4> &nbsp;Registrar Tipo</h4>
    </div>

    <div class="modal-content ">
        <?php include('nueva_categoria.php'); ?>

    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col-md-6 text-right"><button  class="btn btn-success  " type="submit" form="FORMULARIO2" >
                    <span class="glyphicon glyphicon-floppy-disk" aria="hidden"></span>
                    Guardar</button></div>
            <div class="col-md-6 text-left"><a href="#" class="modal-action modal-close waves-effect btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a></div>
        </div>
    </div>
</div>


<div id="nuevoProv" class="modal modal-fixed-footer" ><!-- para llamar al modal PARA REGISTRAR PROVEEDOR-->
    <div class="modal-heading panel-heading text-center">
        <i class="fa fa-truck prefix" aria-hidden="true"></i><h4>&nbsp;Registrar Proveedo</h4>
    </div>

    <div class="modal-content ">
        <?php include('nuevo_proveedor.php'); ?>

    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col-md-6 text-right"><button id="gp" class="btn btn-success modal-action " type="submit" form="FORMULARIO3">
                    <span class="glyphicon glyphicon-floppy-disk" aria="hidden"></span>
                    Guardar</button></div>
            <div class="col-md-6 text-left"><a href="#" class="modal-action modal-close waves-effect btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a></div>
        </div>
    </div>
</div>


<?php
if (isset($_REQUEST["bandera1"])) {


    include_once '../app/Conexion.php';
    include_once '../modelos/Activo.php';
    include_once '../modelos/Detalles.php';
    include_once '../modelos/Bitacora.php';
    include_once '../modelos/Categoria.php';
    include_once '../repositorios/repositorio_activo.php';
    include_once '../repositorios/repositorio_categoria.php';
    include_once '../repositorios/repositorio_detalles.php';
    include_once '../repositorios/repositorio_bitacora.php';
    Conexion::abrir_conexion();
    $cant = $_REQUEST['cantidad'];

    $codigo = array();
    $detalle = new Detalles();
    $detalle->setSeri($_REQUEST["nserie"]);
    $detalle->setColor($_REQUEST["color"]);
    $detalle->setMarca($_REQUEST["marca"]);
    $detalle->setSistema($_REQUEST["so"]);
    $detalle->setDimencione($_REQUEST["dimensiones"]);
    $detalle->setRam($_REQUEST["ram"]);
    $detalle->setModelo($_REQUEST["modelo"]);
    $detalle->setMemoria($_REQUEST["dd"]);
    $detalle->setProcesador($_REQUEST["pro"]);
    $detalle->setOtros($_REQUEST["otro"]);

    $activo = new Activo();
    $activo->setCodigo_activo($_REQUEST["selectCat"]);
    $activo->setCodigo_administrador($_REQUEST["admin"]);

    //DANDO FORMATO A LA FECHA
    $fecha = $_POST["fecha_adq"];
    $fecha = date_format(date_create($fecha), 'Y-m-d');
    //fin fecha

    $activo->setFecha_adquicision($fecha);
    $activo->setCodigo_tipo($_REQUEST["selectCat"]);
    $activo->setPrecio($_REQUEST["precioUnitario"]);
    $activo->setCodigo_proveedor($_REQUEST['selectPro']);

    //para la foto
    $ruta = '../fotoActivos/';
    $foto = $ruta . basename($_FILES["foto"]["name"]);

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $foto)) {
        $activo->setFoto($foto);
    } else {
        $activo->setFoto("");
    }

    //fin para foto

    $activo->setEstado('1');
    $correlativo = Repositorio_activo::obtener_nactivo(Conexion::obtener_conexion(), $_REQUEST["selectCat"]);
    if ($correlativo == "") {
        $correlativo = 0;
    }


    for ($i = 1; $i <= $cant; $i++) {
        Repositorio_detalle::insertar_detalle(Conexion::obtener_conexion(), $detalle);
        $R = Repositorio_detalle::obtener_ultimo_detale(Conexion::obtener_conexion());
        $activo->setCodigo_detalle($R);
        $correlativo++;
        if (($correlativo / 10) < 1) {
            $cod = $_REQUEST["selectCat"] . "-000" . $correlativo;
        } else {
            if (($correlativo / 10) < 10) {
                $cod = $_REQUEST["selectCat"] . "-00" . $correlativo;
            } else {
                if (($correlativo / 10) < 100) {
                    $cod = $_REQUEST["selectCat"] . "-0" . $correlativo;
                } else {

                    $cod = $_REQUEST["selectCat"] . "-" . $correlativo;
                }
            }
        }
        //$cod=$_REQUEST["selectCat"]."-".$correlativo; 
        $activo->setCodigo_activo($cod);
        $codigo[$i-1]=$cod;
         Repositorio_activo::insertar_activo(Conexion::obtener_conexion(), $activo);
    }

    ////esto es para la bitacora 
    $idca = $_REQUEST["selectCat"];
    $nombre_categoria = Repositorio_categoria::obtener_nombre_categoria(Conexion::obtener_conexion(), $idca);
    $accion = 'se registraron ' . $cant . ' item tipo ' . $nombre_categoria . ' con las siguientes características: color '
            . $_REQUEST["color"] . ', marca ' . $_REQUEST['marca'] . ", dimensiones " . $_REQUEST['dimensiones']
            . ', sistema operativo ' . $_REQUEST["so"] . ", Memoria Ram " . $_REQUEST["ram"] . ", Modelo " . $_REQUEST["modelo"];
    Repositorio_Bitacora::insertar_bitacora(Conexion::obtener_conexion(), $accion);
    echo '<script language="javascript">swal({
        title: "Exito!",
        text: "Activos Registrados desea imprimir el codigo de barras?",
        type: "success",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Sí, Imprimir",
        cancelButtonText: "No, Salir",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
        var arre = '.json_encode( $codigo ).';
            var url = "../reportesActivo/imprimir_barcode.php?codigo="+arre ;

            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url;
            a.click();
        } else {
            location.href = "inicio_activo.php";
        }
    });</script>'; 
    
}
?>