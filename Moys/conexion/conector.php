<?php
//modificación de prueba
$mysqli = new mysqli("localhost", "root", "Loles3puntos.", "moys");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";
?>
