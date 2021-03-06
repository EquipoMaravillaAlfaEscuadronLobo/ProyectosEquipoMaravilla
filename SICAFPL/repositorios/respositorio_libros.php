<?php

/**
 *
 */
class Repositorio_libros {
    //registra libros en la base de datos
    public static function insertarLibros($conexion, $libro, $a, $autores) {
        $libro_insertado = false;
        if (isset($conexion)) {
            try {
                $resultado = self::getCantidad($conexion, $libro->getCodigo_libro());

                // $cantidad=0;
                foreach ($resultado as $row) {
                    $cantidad = $row[0];
                }
                // echo $cantidad;
                for ($i = $cantidad + 1; $i <= $a + $cantidad; $i++) {
                    $titulo = $libro->getTitulo();
                    $codigo = $libro->getCodigo_libro() . "-" . str_pad($i, 4, "0", STR_PAD_LEFT);
                    //echo $codigo."<br>";
                    $editorial = $libro->getEditoriales_codigo();
                    $publicacion = $libro->getFecha_publicacion();
                    $foto = $libro->getFoto();
                    $estado = $libro->getEstado();


                    $sql = 'INSERT INTO libros(codigo_libro,titulo,editoriales_codigo,fecha_publicacion,foto,estado)'
                            . ' values (:codigo,:titulo,:editorial,:publicacion,:foto, :estado)';
                    ///estos son alias para que PDO pueda trabajar
                    $sentencia = $conexion->prepare($sql);
                    $sentencia->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                    $sentencia->bindParam(':editorial', $editorial, PDO::PARAM_STR);
                    $sentencia->bindParam(':publicacion', $publicacion, PDO::PARAM_STR);
                    $sentencia->bindParam(':foto', $foto, PDO::PARAM_STR);
                    $sentencia->bindParam(':estado', $estado, PDO::PARAM_STR);
                    $sentencia->bindParam(':codigo', $codigo, PDO::PARAM_STR);


                    $libro_insertado = $sentencia->execute();
                    for ($j = 0; $j < count($autores); $j++) {
                        $codAutor = $autores[$j];
                        $sql = "INSERT into movimiento_autores (codigo_libro, codigo_autor) values('$codigo', '$codAutor')";
                        $sentencia = $conexion->prepare($sql);
                        $sentencia->execute();
                    }
                }
                $accion = "Se hizo el registro de " .$a ." libros con el Titulo de " . $titulo ;
                //echo 'la accion es ' .$accion;
                self::insertar_bitacora($conexion, $accion);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $libro_insertado;
    }
    //retorna una lista de los libros disponibles
    public static function ListaLibros($conexion) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
GROUP_CONCAT(DISTINCT autores.nombre,' ',autores.apellido SEPARATOR ' - ') AS autor,
SUBSTR(libros.codigo_libro,1,19) as codigo,
(libros.titulo) as titulo,
libros.fecha_publicacion as fecha_publicacion,
libros.estado,
libros.foto as foto,
libros.motivo as motivo,
libros.editoriales_codigo as cedit,
editoriales.nombre as editorial,
count(titulo) as cantidad
FROM
libros
INNER JOIN editoriales ON libros.editoriales_codigo = editoriales.codigo_editorial
INNER JOIN movimiento_autores ON movimiento_autores.codigo_libro = libros.codigo_libro
INNER JOIN autores ON movimiento_autores.codigo_autor = autores.codigo_autor
where libros.estado=0
GROUP BY
codigo


";
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    //retorna el catalogo de libros
    public function CatalogoLibros($conexion) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
GROUP_CONCAT(DISTINCT autores.nombre,' ',autores.apellido SEPARATOR ' - ') AS autor,
SUBSTR(libros.codigo_libro,1,19) as codigo,
(libros.titulo) as titulo,
libros.fecha_publicacion as fecha_publicacion,
libros.estado,
libros.foto as foto,
libros.motivo as motivo,
libros.editoriales_codigo as cedit,
editoriales.nombre as editorial,
count(titulo) as cantidad
FROM
libros
INNER JOIN editoriales ON libros.editoriales_codigo = editoriales.codigo_editorial
INNER JOIN movimiento_autores ON movimiento_autores.codigo_libro = libros.codigo_libro
INNER JOIN autores ON movimiento_autores.codigo_autor = autores.codigo_autor

GROUP BY
titulo


";
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    //lista de libros mas simple
    public function ListaLibros2($conexion) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
libros.codigo_libro as codigo,
(libros.titulo) as titulo,
libros.estado,
libros.foto as foto
FROM
libros
INNER JOIN editoriales ON libros.editoriales_codigo = editoriales.codigo_editorial
INNER JOIN movimiento_autores ON movimiento_autores.codigo_libro = libros.codigo_libro
INNER JOIN autores ON movimiento_autores.codigo_autor = autores.codigo_autor
where libros.estado=0
";
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    //busca un libro por el codigo
    public static function BuscarLibro($conexion, $codigo) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
libros.titulo,
libros.fecha_publicacion,
CONCAT(autores.nombre,' ',autores.apellido) as autor,
libros.foto as foto
FROM
libros
INNER JOIN movimiento_autores ON movimiento_autores.codigo_libro = libros.codigo_libro
INNER JOIN autores ON movimiento_autores.codigo_autor = autores.codigo_autor
WHERE
libros.codigo_libro ='$codigo' and libros.estado=0";

                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    //retorna lista de usuarios
    public static function BuscarUsuarios($conexion) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuarios where usuarios.estado=1";
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    //retorna la informacion de un usurio segun su codigo
    public static function BuscarUsuario($conexion, $codigo) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
DISTINCT usuarios.*,(case when usuarios.codigo_usuario in (select DISTINCT (prestamo_libros.codigo_usuario) from prestamo_libros where prestamo_libros.estado=0) or usuarios.codigo_usuario in (select DISTINCT (prestamo_activos.usuarios_codigo) from prestamo_activos where prestamo_activos.estado=0)  then 'si' else 'no' end) as 'esta',
GROUP_CONCAT(prestamo_libros.observaciones SEPARATOR '</li><li>') as obsP
 
FROM
usuarios
inner JOIN prestamo_libros on usuarios.codigo_usuario=prestamo_libros.codigo_usuario


WHERE
usuarios.codigo_usuario  ='$codigo'";
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    //modifica la informacion de un libro
    public static function EditarLibro($conexion, $libro) {
        $libro_mod = 0;
        if (isset($conexion)) {
            try {

                $titulo = $libro->getTitulo();
                $codigo = $libro->getCodigo_libro();
                $foto = $libro->getFoto();
                $publicacion = $libro->getFecha_publicacion();
                //$biografia = $libro->getBiografia();


                $sql = "UPDATE libros SET titulo='$titulo', foto='$foto', fecha_publicacion='$publicacion' where  codigo_libro like '%$codigo%'";
                ///estos son alias para que PDO pueda trabajar
                $sentencia = $conexion->prepare($sql);

                //$sentencia->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                //$sentencia->bindParam(':foto', $foto, PDO::PARAM_STR);
                //$sentencia->bindParam(':publicacion', $publicacion, PDO::PARAM_STR);
                //$sentencia->bindParam(':biografia', $biografia, PDO::PARAM_STR);
                //$sentencia->bindParam(':codigo', $codigo, PDO::PARAM_STR);

                $libro_mod = $sentencia->execute();
                $accion = 'Se editaron los datos del libro ' .$titulo;
                self::insertar_bitacora($conexion, $accion);
                
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $libro_mod;
    }
    //cambia el estado de los libros a 1 que es dado de baja
    public static function DarBaja($conexion, $codigo, $motivo) {
        $libro_mod = 0;
        if (isset($conexion)) {
            try {


                $sql = "UPDATE libros SET estado='1', motivo='$motivo' where  codigo_libro='$codigo'";
                ///estos son alias para que PDO pueda trabajar
                $sentencia = $conexion->prepare($sql);




                //$sentencia->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                //$sentencia->bindParam(':foto', $foto, PDO::PARAM_STR);
                //$sentencia->bindParam(':publicacion', $publicacion, PDO::PARAM_STR);
                //$sentencia->bindParam(':biografia', $biografia, PDO::PARAM_STR);
                //$sentencia->bindParam(':codigo', $codigo, PDO::PARAM_STR);


                $libro_mod = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $libro_mod;
    }
    //obtiene la cantidad de libros de un mismo titulo
    public static function getCantidad($conexion, $codigo) {
        $resultado = "";
        // echo $codigo;
        if (isset($conexion)) {
            try {
                $sql = "SELECT
Count(libros.codigo_libro)
FROM
libros
WHERE
libros.codigo_libro like '%" . $codigo . "%'";

                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    //obtiene la lista de libros del mismo titulo para dar baja
    public static function ListaDarBaja($conexion, $codigo) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
libros.codigo_libro,
libros.titulo
FROM
libros
WHERE
codigo_libro like '%$codigo%' and libros.estado=0;

";
                //echo $codigo;
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    //obtiene una lista de libros dados de baja
    public static function LibrosDadosBaja($conexion) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
libros.titulo as titulo,
libros.codigo_libro as codigo,
libros.motivo as motivo
FROM
libros
INNER JOIN editoriales ON libros.editoriales_codigo = editoriales.codigo_editorial
INNER JOIN movimiento_autores ON movimiento_autores.codigo_libro = libros.codigo_libro
INNER JOIN autores ON movimiento_autores.codigo_autor = autores.codigo_autor
WHERE
libros.estado=1
GROUP BY
titulo
ORDER BY
titulo

";
                //echo $codigo;
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    
    public static function LibrosDadosBaja2($conexion, $titulo) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
libros.titulo as titulo,
libros.codigo_libro as codigo,
libros.motivo as motivo
FROM
libros
INNER JOIN editoriales ON libros.editoriales_codigo = editoriales.codigo_editorial
INNER JOIN movimiento_autores ON movimiento_autores.codigo_libro = libros.codigo_libro
INNER JOIN autores ON movimiento_autores.codigo_autor = autores.codigo_autor
WHERE
libros.estado=1 and titulo='$titulo'
ORDER BY
titulo
";
                //echo $codigo;
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    //obitne la lista de libros danados
    public static function LibrosDanados($conexion) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
libros.titulo as titulo,
libros.codigo_libro as codigo,
libros.motivo as motivo,
libros.fecha_publicacion as fecha
FROM
libros
INNER JOIN editoriales ON libros.editoriales_codigo = editoriales.codigo_editorial
INNER JOIN movimiento_autores ON movimiento_autores.codigo_libro = libros.codigo_libro
INNER JOIN autores ON movimiento_autores.codigo_autor = autores.codigo_autor
WHERE
libros.estado=1 and libros.motivo='Dañado'
GROUP BY
titulo
ORDER BY
titulo

";
                //echo $codigo;
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    
    public static function LibrosDanados2($conexion, $titulo) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
libros.titulo as titulo,
libros.codigo_libro as codigo,
libros.motivo as motivo
FROM
libros
INNER JOIN editoriales ON libros.editoriales_codigo = editoriales.codigo_editorial
INNER JOIN movimiento_autores ON movimiento_autores.codigo_libro = libros.codigo_libro
INNER JOIN autores ON movimiento_autores.codigo_autor = autores.codigo_autor
WHERE
libros.estado=1 and titulo='$titulo' and motivo='Dañado'
ORDER BY
titulo
";
                //echo $codigo;
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    //obtiene la lista de libros extraviados
    public static function LibrosExtraviados($conexion) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
libros.titulo as titulo,
libros.codigo_libro as codigo,
libros.motivo as motivo
FROM
libros
INNER JOIN editoriales ON libros.editoriales_codigo = editoriales.codigo_editorial
INNER JOIN movimiento_autores ON movimiento_autores.codigo_libro = libros.codigo_libro
INNER JOIN autores ON movimiento_autores.codigo_autor = autores.codigo_autor
WHERE
libros.estado=1 and libros.motivo='Extraviado'
GROUP BY
titulo
ORDER BY
titulo

";
                //echo $codigo;
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    
    public static function LibrosExtraviados2($conexion, $titulo) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
libros.titulo as titulo,
libros.codigo_libro as codigo,
libros.motivo as motivo
FROM
libros
INNER JOIN editoriales ON libros.editoriales_codigo = editoriales.codigo_editorial
INNER JOIN movimiento_autores ON movimiento_autores.codigo_libro = libros.codigo_libro
INNER JOIN autores ON movimiento_autores.codigo_autor = autores.codigo_autor
WHERE
libros.estado=1 and titulo='$titulo' and motivo='Extraviado'
ORDER BY
titulo
";
                //echo $codigo;
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    //obtiene la lista de los libros mas prestados
    public static function LibrosMasPrestados($conexion) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
	prestamo_libros.codigo_plibro as codigo,
	libros.codigo_libro as cl,
	libros.titulo,
	(select count(*) from movimiento_libros where movimiento_libros.codigo_libro=cl) as veces
	
FROM
	prestamo_libros
INNER JOIN movimiento_libros ON movimiento_libros.codigo_plibro = prestamo_libros.codigo_plibro
INNER JOIN libros ON movimiento_libros.codigo_libro = libros.codigo_libro
GROUP BY
cl
ORDER BY
veces desc
";
                //echo $codigo;
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    
    public static function LibrosMasPrestados2($conexion, $titulo) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
	prestamo_libros.codigo_plibro as codigo,
	libros.codigo_libro as cl,
	libros.titulo,
	(select count(*) from movimiento_libros where movimiento_libros.codigo_libro=cl) as veces
	
FROM
	prestamo_libros
INNER JOIN movimiento_libros ON movimiento_libros.codigo_plibro = prestamo_libros.codigo_plibro
INNER JOIN libros ON movimiento_libros.codigo_libro = libros.codigo_libro
where
libros.titulo='$titulo'
ORDER BY
veces desc
";
                //echo $codigo;
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    //obitiene la lista de los libros para imprimir el codigo de barras
    public static function CodigoBarras($conexion) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "select * from libros group by titulo";
                //echo $codigo;
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    
    public static function CodigoBarras2($conexion, $titulo) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "select * from libros where libros.titulo='$titulo'";
                //echo $codigo;
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }

    public static function insertar_bitacora($conexion, $accion) {
        $administrador_insertado = false;
        if (isset($conexion)) {
            try {
                session_start();
                $administrador = $_SESSION['user'];
                ini_set('date.timezone', 'America/El_Salvador');
                $hora = date("Y/m/d ") . date("h:i:s");

                $sql = "INSERT INTO bitacora (codigo_administrador, accion, fecha) VALUES ('$administrador', '$accion', '$hora');";

                ///estos son alias para que PDO pueda trabajar 
                $sentencia = $conexion->prepare($sql);
                $administrador_insertado = $sentencia->execute();

//                echo 'la bitacora ha sido guardada';
            } catch (PDOException $ex) {
                //echo '<script>swal("No se puedo realizar el registro", "Favor revisar los datos e intentar nuevamente", "warning");</script>';
                print 'ERROR: ' . $ex->getMessage();
            }
        }
    }

}

?>
