
<div class="row">
    <div class="col-md-6">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default" name="libros">
                <div class="panel-heading p_libro">

                <div class="row">
                <div class="col-md-11">

                 <div class="input-field"><i class="fa fa-barcode prefix" aria-hidden="true"></i><label for="">Codigo</label><input type="text" id="codigo" autofocus onkeypress="buscarLibro(event)"></div>
                
                </div>
                <div class="col-md-1">
                   <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                   <i class="fa fa-sort-desc" id="despliegue" aria-hidden="true"></i>
                </a>
                </div>
                    </div>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <label for="titulo">titulo</label>
                        <input type="text" id="titulo" placeholder="titulo" disabled>
                        <label for="autor">autor</label>
                        <input type="text" id="autor" placeholder="Autor" disabled>
                        <label for="genero">genero</label>
                        <input type="text" id="genero" placeholder="Genero" disabled>
                        <label for="fecha_pub">fecha_pub</label>
                        <input type="text" id="fecha_pub" placeholder="Fecha de Publicacion" disabled>
                    </div>
                </div>
            </div>
        </div>
        <but class="btn" onClick="addLibro()"><span aria-hidden="true" class="glyphicon glyphicon-plus">
            </span>Agregar Libro</button>
    </div>


    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">Datos de Usuario</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4" id="foto">

                    </div>
                </div>
                <input type="text" id="codigo" placeholder="codigo" autofocus>
                <input type="text" id="nombre" placeholder="Nombre" readonly="">
                <input type="text" id="edad" placeholder="Edad" disabled>
                <input type="text" id="telefono" placeholder="Telefono" disabled>
                <input type="text" id="fecha_sal" placeholder="Fecha de Salida" value="31/08/2017">
                <input type="date" id="fecha_dev" placeholder="Fecha de Devolucion" >
            </div>
        </div>
    </div>
</div>

<script>
    function addLibro() {
        var imagenes = document.getElementsByName('libros').length + 1;
        var script = document.createElement("div");
        script.innerHTML = "<div class='panel' name='libros'><div class='panel-heading'><a data-toggle='collapse' data-parent='#accordion" + imagenes + "' href='#collapse" + imagenes + "'>Datos de libros</a></div><div id='collapse" + imagenes + "' class='panel-collapse collapse in'><div class='panel-body'><input type='text' placeholder='codigo' autofocus><input type='text' placeholder='titulo' disabled><input type='text' placeholder='Autor' disabled><input type='text' placeholder='Gener' disabled><input type='text' placeholder='Fecha de Publicacion' disabled></div></div></div>";
        var fila = document.getElementById("accordion");
        fila.appendChild(script);
    }
    function buscarLibro(event) {
        if (event.keyCode == 13) {
            document.getElementById('titulo').value = "Iliada";
            document.getElementById('autor').value = "Homero";
            document.getElementById('genero').value = "Epopeya";
            document.getElementById('fecha_pub').value = "762 A.C";

            document.getElementById('titulo').disabled = false;
            document.getElementById('autor').disabled = false;
            document.getElementById('genero').disabled = false;
            document.getElementById('fecha_pub').disabled = false;

            $('#titulo').prop('readonly', true);
            $('#autor').prop('readonly', true);
            $('#genero').prop('readonly', true);
            $('#fecha_pub').prop('readonly', true);
            //$("#collapse1").removeClass("out");
             //$("#collapse1").removeClass("in");
             $("#collapse1").addClass("in");
             $("#collapse1").attr('aria-expanded', true)

            // $("#despliegue").removeClass("fa-sort-desc");
            // $("#despliegue").addClass("fa-sort-asc");

        }


    }
</script>