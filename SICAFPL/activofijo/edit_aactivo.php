<?php
include_once '../repositorios/repositorio_administrador.inc.php';
include_once '../app/Conexion.php';
?>


<div class="panel" >


    <div class=" text-center panel-body">
        <form  name="actAct" id="ActAct" method="post" action="" enctype="multipart/form-data">
            <input type="hidden" id="banderaActiv" name="banderaActiv">
            <input type="hidden" id="codActivo" name="codActivo">
            <input type="hidden" id="codDetalle" name="codDetalle">
            <input type="hidden" id="codamin" name="codamin">
            
            <div class="input-field col m8">
                        <i class="fa fa-barcode prefix"></i> 
                        <input type="text" id="codActivo1" style="font-size: 22px" name="codActivo1" value="" placeholder="" class="text-center " maxlength="25" minlength="3" required disabled="">
                        <label for="idCarnetEliminado" style="font-size: 20px">Codigo de activo</label>
                    </div>
          
            <div class="row">
                <div class="col-md-6">
                    <!--                    <div class="col m1"></div>-->
                    <!--seccion del combo para encargado  -->
                    <div class="row">
                        <div class="col m1"></div>
                        <div class="input-field col m6">
                            <i class="fa fa-info-circle prefix "></i> 
                        
                    
                            <input type="text" id="estadoE" name="estadoE" class="text-center validate" placeholder="" required="" readonly=""
                                   value="" 
                                   >
                            
                            <label for="estadoE" style="font-size: 16px">Estado <small></small> </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col m1"></div>
                        <div class="input-field col m6">
                            <i class="fa fa-user-circle prefix"></i> 
                            <input type="text" id="nadmin" name="nadmin" class="text-center validate" placeholder=""  readonly="" style="font-size: 19px"

                                   >
                            <label for="estadoE" style="font-size: 16px"> Encargado Actual <small></small> </label>
                        </div>

                    </div>

                    <div class="row"> 
                        <div class="col m1"></div>
                        <div class="input-field col m1">
                            <div class="input-field col m1">
                                <i class="fa fa-user-circle prefix"></i>   
                            </div>
                        </div>
                        <div class="input-field col m6">
                            <select required="" name="adminedit" id="adminEdit" onchange="cambiarAdmin(this.value)" >
                                <option value="0,0" disabled selected>Nuevo Encargado</option>
                                <?php
                                Conexion::abrir_conexion();
                                Repositorio_administrador::lista_administradores3(Conexion::obtener_conexion());
                                ?>
                            </select>
                            <label for="estadoE" style="font-size: 12px">Nuevo Encargado  <small></small> </label>
                        </div>

                    </div>
                    <!-- termina el combo de encargado   -->
                   
                    <!-- foto  -->


                    <!-- termina foto -->
                </div><!-- col md 7 -->
                
                <div class="col-md-6">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span><i class="glyphicon glyphicon-picture" aria-hidden="true"></i>Foto</span>
                            <input type="file" id="fotoEdit" name="fotoEdit" accept="image/*">
                        </div>


                        <div class="file-path-wrapper">
                            <input type="text" accept="image/*" id="file_fotoEdAct"  class="form-control file-path validate">
                        </div>
                    </div>

                    <!-- botones -->
                    <div class="row" id="fotoActual">
                        <img src="" id="fotoEdActsrc" width="30%">
                    </div>
                    <div class="row">
                        <output id="listA"></output>                
                    </div>

                </div>
            </div><!--fin row  -->
             <div class="row text-center"  >
                 <div class="col-md-4">
                        <button class="btn btn_primary" type="button"  >
                            <a   onclick="llamarMantenimiento() ">
                                <span aria-hidden="true" class="glyphicon glyphicon-plus">
                                </span>MANTENIMIENTO</a>
                        </button>
                     </div>
                 <div class="col-md-4">
                     <button class="btn btn-info" id="ipm" type="button" onclick="impCod()"><i class="fa fa-barcode" aria-hidden="true"></i>  Imprimir</button>
                 </div>
                 <div class="col-md-4">
                        <button class="btn btn-danger"  type="button" > 
                            <i class="Medium material-icons prefix" onclick="delA()" >delete</i> 
                        </button>
                 </div>


                    </div><!-- Termina botones -->



            <div class="row"><!--  panel de Caracteristicas   -->

                <div class="col m1"></div><!--  para dejar espacio en los lados   -->
                <div class="col-md-10"> <!--  div para centralizar      -->
                    <!--                    <div class="panel-group" id="accordion">
                                            <div class="panel" name="caracteristicas">
                                               
                                                <div id="caracteristicasMod" class="panel-collapse collapse in">-->
                    <div class="panel-heading"><a data-toggle="collapse" data-parent="#accordion" href="#caracteristicasMod">Detalles  </a></div>                               
                    <div class="panel-body">                                            

                        <div class="row">

                            <div class="input-field col m5">
                                <i class="fa fa-barcode prefix"></i> 
                                <input type="text" id="nserieE" name="nserieE" class="text-center validate" required="" value="Sin Numero de Serie" onclick = "if (this.value == 'Sin Numero de Serie')
                                            this.value = ''" onblur="if (this.value == '')
                                                        this.value = 'Sin Numero de Serie'">
                                <label for="precioUnitario">Numero de Serie <small></small> </label>
                            </div>
                            <div class="col m1"></div>

                            <div class="input-field col m5">
                                <i class="fa fa-adjust prefix"></i> 
                                <input type="text" id="colorE" name="colorE" class="text-center validate" required="" >
                                <label for="idEmail">Color<small></small> </label>
                            </div>
                        </div>
                        <div class="row">

                            <div class="input-field col m5">
                                <i class="fa fa-registered prefix"></i> 
                                <input type="text" id="marcaE" name="marcaE" class="text-center validate" required="" value="Sin Marca" onclick = "if (this.value == 'Sin Marca')
                                            this.value = ''" onblur="if (this.value == '')
                                                        this.value = 'Sin Marca'">
                                <label for="precioUnitario">Marca <small></small> </label>
                            </div>
                            <div class="col m1"></div>

                            <div class="input-field col m5">
                                <i class="fa fa-windows prefix"></i> 
                                <input type="text" id="soE" name="soE" class="text-center validate" required="" value="Sin Sistema Operativo" onclick = "if (this.value == 'Sin Sistema Operativo')
                                            this.value = ''" onblur="if (this.value == '')
                                                        this.value = 'Sin Sistema Operativo'">
                                <label for="idEmail">Sistema Operativo <small></small> </label>
                            </div>

                        </div>
                        <div class="row">

                            <div class="input-field col m5">
                                <i class="fa fa-crop prefix"></i> 
                                <input type="text" id="dimensionesE" name="dimensionesE" class="text-center validate" required="" value="Sin Dimenciones" onclick = "if (this.value == 'Sin Dimenciones')
                                            this.value = ''" onblur="if (this.value == '')
                                                        this.value = 'Sin Dimenciones'">
                                <label for="dimensines">Dimensiones <small></small> </label>
                            </div>
                            <div class="col m1"></div>

                            <div class="input-field col m5">
                                <i class="fa fa-circle-o-notch prefix"></i> 
                                <input type="text" id="ramE" name="ramE" class="text-center validate" required="" value="Sin Memoria Ram" onclick = "if (this.value == 'Sin Memoria Ram')
                                            this.value = ''" onblur="if (this.value == '')
                                                        this.value = 'Sin Memoria Ram'">
                                <label for="dimensines">Memoria Ram <small></small> </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m5">
                                <i class="fa fa-laptop prefix"></i> 
                                <input type="text" id="modeloE" name="modeloE" class="text-center validate" required="" value="Sin Modelo" onclick = "if (this.value == 'Sin Modelo')
                                            this.value = ''" onblur="if (this.value == '')
                                                        this.value = 'Sin Modelo'">
                                <label for="idEmail">Modelo<small></small> </label>
                            </div>


                            <div class="col m1"></div>
                            <div class="input-field col m5">
                                <i class="fa fa-hdd-o prefix"></i> 
                                <input type="text" id="ddE" name="ddE" class="text-center validate" required="" value="Sin Disco Duro" onclick = "if (this.value == 'Sin Disco Duro')
                                            this.value = ''" onblur="if (this.value == '')
                                                        this.value = 'Sin Disco Duro'">
                                <label for="idEmail">Disco Duro <small></small> </label>
                            </div> 
                        </div>
                        <div class="row">

                            <div class="input-field col m11">
                                <i class="fa fa-microchip prefix"></i> 
                                <input type="text" id="proE" name="proE" class="text-center validate" required="" value="Sin Procesador" onclick = "if (this.value == 'Sin Procesador')
                                            this.value = ''" onblur="if (this.value == '')
                                                        this.value = 'Sin Procesador'">
                                <label for="idEmail">Procesador <small></small> </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m11">
                                <textarea id="otroE" name="otroE" class="materialize-textarea" style="font-size:15px"></textarea>
                                <label for="textarea1" style="font-size:15px"><i class="  fa fa-pencil-square-o"></i>&nbsp Otro</label>
                            </div>
                        </div>


                    </div>
                    <!--                            </div>
                                            </div>
                                        </div>-->

                </div>
                <div class="col m1"></div><!--  para dejar espacio en los lados   -->

            </div> <!-- termina el div row de Caracteristicas     -->
        </form>
    </div><!-- termina div panel center-->




</div> <!-- Termina panel regisroAct -->




<script crossorigin="anonymous" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" src="https://code.jquery.com/jquery-2.2.4.min.js">
</script>
<script type="text/javascript">
function llamarMantenimiento(){
    nuevoMant(document.getElementById('codActivo').value, "no");
    return false;
}
 
    function cambiarAdmin(valor) {
        valor = valor.split(",");
        document.getElementById('codamin').value= valor[0];
       
    }

//PARA VER LAS NUEVAS FOTOS
    function archivo(evt) {// fuente:  http://blog.reaccionestudio.com/previsualizar-imagen-antes-de-subirla-con-html5-y-javascript/
        document.getElementById('fotoActual').style.display = 'none';
        var files = evt.target.files; // FileList object

        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {
                    // Insertamos la imagen
                    document.getElementById("listA").innerHTML = ['<img class="thumb" width="30%" src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);

            reader.readAsDataURL(f);
        }
    }
   
        document.getElementById('fotoEdit').addEventListener('change', archivo, false);
    


</script>

<?php
if (isset($_REQUEST["banderaActiv"])) {


    include_once '../app/Conexion.php';
    include_once '../modelos/Activo.php';
    include_once '../modelos/Detalles.php';
    include_once '../repositorios/repositorio_activo.php';
    include_once '../repositorios/repositorio_detalles.php';
    Conexion::abrir_conexion();

    $detalle = new Detalles();
    $detalle->setCodigo_detalle($_REQUEST["codDetalle"]);
    $detalle->setSeri($_REQUEST["nserieE"]);
    $detalle->setColor($_REQUEST["colorE"]);
    $detalle->setMarca($_REQUEST["marcaE"]);
    $detalle->setSistema($_REQUEST["soE"]);
    $detalle->setDimencione($_REQUEST["dimensionesE"]);
    $detalle->setRam($_REQUEST["ramE"]);
    $detalle->setModelo($_REQUEST["modeloE"]);
    $detalle->setMemoria($_REQUEST["ddE"]);
    $detalle->setProcesador($_REQUEST["proE"]);
    $detalle->setOtros($_REQUEST["otroE"]);


    $activo = new Activo();


    $activo->setCodigo_administrador($_REQUEST["codamin"]);

    // echo '<script>swal("Excelente!", "' . $_REQUEST["codActivo"] . '", "success");</script>';
    //para la foto
    $ruta = '../fotoActivos/';
    $foto = $ruta . basename($_FILES["fotoEdit"]["name"]);

    if (move_uploaded_file($_FILES['fotoEdit']['tmp_name'], $foto)) {
        $activo->setFoto($foto);
    } else {
        $activo->setFoto("");
    }
    Repositorio_activo::actualizar_activo(Conexion::obtener_conexion(), $activo, $_REQUEST["codActivo"]);
    Repositorio_detalle::actualizar_detalle(Conexion::obtener_conexion(), $detalle, $_REQUEST["codDetalle"]);
   
    echo '<script>swal({
                    title: "Exito",
                    text: "Activo actualizado!",
                    type: "success",
                    confirmButtonText: "ok",
                    closeOnConfirm: true
                },
                function () {
                swal.close();
                 location.href="inicio_activo.php";
                $("#ttest2").reload();
                    
                });</script>';
}
?>
