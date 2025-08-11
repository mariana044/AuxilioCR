<?php
// Datos de conexión
$servername = "127.0.0.1"; // o "localhost"
$username   = "root";
$password   = ""; // sin clave
$dbname     = "AmbienteWebDbGrpo6";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Opcional: establecer charset para evitar problemas con tildes/ñ
$conn->set_charset("utf8mb4");
?>
