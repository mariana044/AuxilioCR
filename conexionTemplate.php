<?php
$servername = "localhost";
$username = "root";
$password = "TU_CONTRASEÑA_AQUI";  // Cada quien pone su propia contraseña
$dbname = "AuxilioCR";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
