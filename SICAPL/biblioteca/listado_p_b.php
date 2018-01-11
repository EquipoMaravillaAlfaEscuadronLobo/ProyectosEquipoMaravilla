<?php
include_once '../app/Conexion.php';
include_once '../repositorios/repositorio_prestamolib.inc.php';
Conexion::abrir_conexion();
$listado = Repositorio_prestamolib::ListaPrestamos(Conexion::obtener_conexion());
?>
<div>
    <row>
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-8"><h3>Listado de Prestamos</h3>
                        </div>
                        <div class="col-md-2">  <a class="btn btn_primary"  target="_blank" onclick="abrirModal()"><span aria-hidden="true" class="glyphicon glyphicon-plus">
                                </span>Nuevo Prestamo</a></div>
                    </div>       
                </div>
                <div class="panel-body">				
                    <table padding="20px" class="responsive-table display" id="tabla-paginada4">
                        <thead>
                        <th>Codigo</th>

                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Libro</th>
                        <th>Fecha Salida</th>
                        <th>Fecha Devolucion</th>
                        <th>Estado</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listado as $fila) {
                                $fdev = date_create($fila['Devolucion']);
                                $hoy = new DateTime("now");
                                ?>
                                <tr>
                                    <td><?php echo $fila['codigo'] ?></td>
                                    <td><?php echo $fila['user'] ?></td>
                                    <td><?php echo $fila['nombre'] ?></td>
                                    <td><?php echo $fila['titulo'] ?></td>
                                    <td><?php echo date_format(date_create($fila['fecha_salida']), 'd-m-Y') ?></td>
                                    <td><?php echo date_format(date_create($fila['Devolucion']), 'd-m-Y') ?></td>
                                    <td class="alert <?php
                                    if ($fdev > $hoy) {
                                        echo 'alert-warning';
                                    } else {
                                        echo 'alert-danger';
                                    }
                                    ?>  pendiente" onclick="finalizar('<?php echo $fila['codigo'] ?>')">Pendiente</td>
                                </tr>
<?php } ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </row>
</div>

<div id="nuevo" class="modal modal-fixed-footer nuevo">
    <div class="modal-content modal-lg">
<?php include('prestamo2.php'); ?>
    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col-md-6 text-right"><button onclick="enviar()" class="waves-effect btn btn-success">Guardar</button></div>
            <div class="col-md-6 text-left"><a href="#" class="modal-action modal-close waves-effect btn btn-danger">Salir</a></div>
        </div>
    </div>
</div>

<div id="finaizarPL" class="modal modal-fixed-footer nuevo">
    <div class="modal-content modal-lg">
<?php include('./ListaFinPrestamo.php'); ?>
    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col-md-6 text-right"><button onclick="enviar()" class="waves-effect btn btn-success">Guardar</button></div>
            <div class="col-md-6 text-left"><a href="#" class="modal-action modal-close waves-effect btn btn-danger">Salir</a></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function enviar() {
        if (window.event.keyCode !== 13) {
            document.getElementById('num').value = document.getElementsByName('libros').length;
            document.frmPrestamoLibro.submit();
        }
    }

    function finalizar(codigo) {
        var d=new Date()
        var dia=d.getDate();
        var mes=d.getMonth();
        var anio=d.getFullYear();
        var fecha=dia+"-"+(mes+1)+"-"+anio;
       
        
        var input=document.createElement("input");
        input.type="date";
         input.setAttribute("min",fecha);

        swal("Que desea hacer", {
        buttons: {
        cancel: "Cancelar",
                final: {
                text:"Finalizar",
                        value: "fin",
                        className: "btn-primary"
                },
                actu: {
                text: "actualizar",
                        value: "act"
                },
        },
                icon: "info",
        }).then(value => {
        switch (value){
        case "fin":
                swal("Seguro que desea finalizar el prestamo?", {
                content: {
                element: 'input',
                        attributes: {
                        placeholder: 'Escriba aqui una observacion',
                                type: 'text',
                                
                        }
                },
                        icon: "warning",
                        buttons: {
                        cancel: "Cancelar",
                                confirm: true,
                        },
                }).then((value, confirm) => {
        swal(value + confirm)
                $.ajax({
                url: 'finalizarPrestamo.php?codigo=' + codigo + '&motivo=' + value,
                        type: 'GET',
                        dataType: "html",
                        data: {codigo: codigo, motivo: value},
                        cache: false,
                        contentType: false,
                        processData: false
                }).done(function (resp) {
        if (resp == 1) {
        swal("Exito", "Prestamo Finalizado", "success")
                .then((value) => {
                location.href = "inicio_b.php";
                }
                );
        } else {
        swal("Oops", resp, "error")

        }
        });
        });
                break;
                case "act":
                
                swal({
                   
                content: input,
                        });
                break;
        }

        }
        )



    }


</script>