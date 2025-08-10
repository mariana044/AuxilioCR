<?php
require_once 'conexionTemplate.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $n   = $conn->real_escape_string($_POST["nombre"]);
    $e   = $conn->real_escape_string($_POST["correo"]);
    $t   = $conn->real_escape_string($_POST["tipo"]);
    $p   = $_POST["clave"];
    $h   = password_hash($p, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Usuarios (nombre, correo, contrasena, tipo_usuario)
            VALUES ('$n','$e','$h','$t')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error al registrar: " . $conn->error;
    }
}
