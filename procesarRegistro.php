<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $n   = $conn->real_escape_string($_POST["nombre"]);
    $e   = $conn->real_escape_string($_POST["correo"]);
    $t   = $conn->real_escape_string($_POST["tipo_usuario"]);
    $p   = $_POST["contrasena"];
    $h   = password_hash($p, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, correo, contrasena, tipo_usuario)
>>>>>>> origin/main
            VALUES ('$n','$e','$h','$t')";
    if ($conn->query($sql) === TRUE) {
        header("Location: registro_exitoso.php");
        exit;
    } else {
        echo "Error al registrar: " . $conn->error;
    }
}
