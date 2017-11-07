<?php
include_once '../app/Conexion.php';
include_once '../modelos/Activo.php';
include_once '../modelos/Administrador.inc.php';
include_once '../repositorios/repositorio_activo.php';
include_once '../repositorios/repositorio_categoria.php';
include_once '../repositorios/repositorio_administrador.inc.php';
Conexion::abrir_conexion();

$listado = Repositorio_activo::obtener_activo(Conexion::obtener_conexion(), $_POST['libro']);
//$numero=$_POST['numero'];

foreach ($listado as $fila) {
    ?>
    <script type="text/javascript">
        
        document.getElementById('catPrestAct').value = "<?php echo Repositorio_categoria::obtener_categoria(Conexion::obtener_conexion(), $fila['codigo_tipo']); ?>";
        document.getElementById('codPrestAct').value = "<?php echo $fila['codigo_activo']; ?>";
        document.getElementById('codTipo').value = "<?php echo $fila['codigo_tipo']; ?>";
        activar();  
        document.getElementById('codigoActivoA').innerHTML = "<?php echo $fila['codigo_activo']; ?>";
        document.getElementById('tipoActivoA').innerHTML = "<?php echo Repositorio_categoria::obtener_categoria(Conexion::obtener_conexion(), $fila['codigo_tipo']); ?>";
    //document.getElementById('edad').innerHTML = "<?php echo $fila['titulo'] ?>";
        document.getElementById('encargadoA').innerHTML = "<?php echo Repositorio_administrador::obtener_administrador(Conexion::obtener_conexion(), $fila['codigo_administrador'])->getNombre() . " " . Repositorio_administrador::obtener_administrador(Conexion::obtener_conexion(), $fila['codigo_administrador'])->getApellido();?>";
    
    //document.getElementById('estado').setAttribute("src", "../imagenes/tipo.jpg")


    //	document.getElementById('titulo<?php echo $numero ?>').value = <?php echo $fila['titulo'] ?>;
    ////   document.getElementById('autor<?php echo $numero ?>').value = <?php echo $fila[2] ?>;
    // document.getElementById('genero<?php echo $numero ?>').value = "Epopeya";
    //   document.getElementById('fecha_pub<?php echo $numero ?>').value = <?php echo $fila['fecha_publicacion'] ?>;
    
    </script>


    <?php
}
?>