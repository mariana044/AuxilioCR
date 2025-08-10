<?php
$servername = $servername = "127.0.0.1:3306"; 
$username = "root";
$password = "3Qarelo81*";
$dbname = "AmbienteWebDbGrpo6";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}