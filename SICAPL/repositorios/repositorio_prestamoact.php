<?php

/**
 * 
 */
class Repositorio_prestamoact {

    public static function ListaPrestamosAct($conexion) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
 (CONCAT(usuarios.nombre,' ',usuarios.apellido)) as nombre,
 prestamo_libros.codigo_plibro as codigo,
 (prestamo_libros.fecha_salida),
 (prestamo_libros.fecha_devolucion) as Devolucion,
 GROUP_CONCAT(libros.titulo SEPARATOR ' - ') as titulo
FROM
usuarios
INNER JOIN prestamo_libros ON prestamo_libros.codigo_usuario = usuarios.codigo_usuario
INNER JOIN movimiento_libros ON movimiento_libros.codigo_plibro = prestamo_libros.codigo_plibro
INNER JOIN libros ON movimiento_libros.codigo_libro = libros.codigo_libro
WHERE
prestamo_libros.estado = 0
GROUP BY prestamo_libros.fecha_devolucion
";
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }

    public static function GuardarPrestamoAct($conexion, $prestamo) {
        $autor_insertado = false;
        if (isset($conexion)) {
            try {
                $usuario = $prestamo->getUsuario();
//echo $usuario;
                $salida = $prestamo->getSalida();
                $devolucion = $prestamo->getDevolucion();
                $sql = 'INSERT INTO prestamo_activos(usuarios_codigo,fecha_salida,fecha_devolucion,estado)'
                        . ' values (:usuario,CURDATE(),:devolucion,"0")';
                ///estos son alias para que PDO pueda trabajar 
                $sentencia = $conexion->prepare($sql);




                $sentencia->bindParam(':usuario', $usuario, PDO::PARAM_STR);
                //  $sentencia->bindParam(':salida', $salida, PDO::PARAM_STR);
                $sentencia->bindParam(':devolucion', $devolucion, PDO::PARAM_STR);



                $autor_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $autor_insertado;
    }

    public static function GuardarActivos($conexion, $prestamo, $libro) {
        $autor_insertado = false;
        if (isset($conexion)) {
            try {



                //$usuario = $prestamo->getUsuario();
                // $salida = $prestamo->getSalida();
                //  $devolucion = $prestamo->getDevolucion();            



                $sql = 'INSERT INTO movimiento_actvos(codigo_activo,codigo_pactivo)'
                        . ' values (:libro,:prestamo)';
                 $sql1 = "UPDATE `actvos` SET `estado`='2' WHERE (`codigo_activo`='$libro') ";                
                $sentencia1 = $conexion->prepare($sql1);
                $sentencia1->execute();
                ///estos son alias para que PDO pueda trabajar 
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':libro', $libro, PDO::PARAM_STR);
                $sentencia->bindParam(':prestamo', $prestamo, PDO::PARAM_STR);
                //$sentencia->bindParam(':nacimiento', $nacimiento, PDO::PARAM_STR);
                // $sentencia->bindParam(':biografia', $biografia, PDO::PARAM_STR);


                $autor_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $autor_insertado;
    }

    public static function obtenerUltimoPact($conexion) {
        $codigo = "";
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT codigo_pactivo from prestamo_activos order by codigo_pactivo desc limit 1";
                $resultado = $conexion->query($sql);
                
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
            foreach ($resultado as $fila) {
                $codigo = $fila[0];
            }
        }
        return $codigo;
    }

    public static function Finalizar($conexion, $codigo, $motivo) {
        $libro_mod = 0;
        if (isset($conexion)) {
            try {


                $sql = "UPDATE prestamo_libros SET estado='1', observaciones='$motivo' where  codigo_plibro='$codigo'";                
                $sentencia = $conexion->prepare($sql);
                $libro_mod = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $libro_mod;
    }

}

?>