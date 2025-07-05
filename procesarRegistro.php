<?php

require_once 'conexion.php';  

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $conn->real_escape_string($_POST["nombre"]);
    $correo = $conn->real_escape_string($_POST["correo"]);
    $tipo = $conn->real_escape_string($_POST["tipo"]);
    $comentario = $conn->real_escape_string($_POST["comentario"]);

    if (!empty($nombre) && !empty($correo)) {
        $sql = "INSERT INTO Usuarios (nombre, correo, tipo, comentario) VALUES ('$nombre', '$correo', '$tipo', '$comentario')";
        if ($conn->query($sql) === TRUE) {
            header("Location: registro.php?status=success&nombre=" . urlencode($nombre) . "&tipo=" . urlencode($tipo));
            exit;
        } else {
            die("Error al registrar: " . $conn->error);
        }
    } else {
        die("Por favor completá todos los campos obligatorios.");
    }
} else {
    die("Acceso no permitido.");
}

$conn->close();
?>
