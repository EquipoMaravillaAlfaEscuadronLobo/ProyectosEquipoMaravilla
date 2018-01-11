<html>
<head>
<title>Efecto de zoom en una imagen y texto con CSS3</title>
<style type="text/css">
    .zoom{
        /* Aumentamos la anchura y altura durante 2 segundos */
        transition: width 2s, height 2s, transform 2s;
        -moz-transition: width 2s, height 2s, -moz-transform 2s;
        -webkit-transition: width 2s, height 2s, -webkit-transform 2s;
        -o-transition: width 2s, height 2s,-o-transform 2s;
    }
    .zoom:hover{
        /* tranformamos el elemento al pasar el mouse por encima al doble de
           su tamaño con scale(2). */
        transform : scale(2);
        -moz-transform : scale(2);      /* Firefox */
        -webkit-transform : scale(2);   /* Chrome - Safari */
        -o-transform : scale(2);        /* Opera */
    }
</style>
</head>
 
<body>
<h2>Efecto zoom</h2>
<div style='text-align:center;'>
    <div class="zoom">Efecto de zoom con CSS3</div>
    <img class="zoom" src="http://www.lawebdelprogramador.com/logolwp100x25.jpg" />
</div>
</body>
</html>