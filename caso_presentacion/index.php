<?php
echo "<h1>Memcached</h1>";

// instancia la clase dMemcached
$m = new Memcached();
// agrego el servidor configurado y el puerto que escucha
$m->addServer('localhost', 11211);

// guardo el contenido de la clabe "pagina" si existe
$archivo = $m->get("pagina");

if ($archivo === false)
{
    // NO EXISTE!!!
    // configuro el nombre del archivo
	$nombre = './pagina.html';
    // abro el archvio en modo escritura
	$manejador = fopen($nombre, 'r');
    // leo el contenido del archivo y lo guardo en la variable
	$contenido = fread($manejador, filesize($nombre));
    // seteo el contenido de la variables en memcached con la clave "pagina"
	$m->set('pagina', $contenido, 15);
	echo "<h3>Leo desde el archivo:</h3";
	echo $contenido;
}
else
{
    // SI EXISTE!!!
    // En caso de existir la clave, imprimo su contenido, 
    // y aviso que la vida de la variable sera de 15 segundos
	echo "<h3>Leo desde cache por 15 segundo.</h3>";
	echo $archivo;
}
?>