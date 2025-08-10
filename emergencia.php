<?php
require 'conexion.php';

$lat = $_POST['latitud'];
$lon = $_POST['longitud'];
$fecha = date("Y-m-d H:i:s");


$voluntario = "Ed";


$sql = "INSERT INTO emergencias (fecha, latitud, longitud, voluntario, resolucion)
        VALUES ('$fecha', '$lat', '$lon', '$voluntario', 'Pendiente')";

if ($conn->query($sql) === TRUE) {
  echo "¡Emergencia registrada! Un voluntario fue notificado.";
} else {
  echo "Error al registrar emergencia: " . $conn->error;
}

$conn->close();
?>
