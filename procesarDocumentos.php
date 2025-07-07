<?php
session_start();
require_once 'conexionTemplate.php';

// Asegurar que el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    echo "Acceso denegado.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_usuario = $_SESSION['usuario']['id'];
    $tipo = $_POST['tipo'];

    // Verificamos que haya archivo subido
    if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
        echo "Error al subir el archivo.";
        exit;
    }

    $archivo = $_FILES['archivo'];
    $nombreOriginal = basename($archivo['name']);
    $ext = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
    $permitidos = ['pdf', 'jpg', 'jpeg', 'png'];

    if (!in_array($ext, $permitidos)) {
        echo "Formato no permitido. Solo PDF, JPG, PNG.";
        exit;
    }

    // Crear nombre único y mover el archivo
    $nuevoNombre = uniqid('doc_') . "." . $ext;
    $rutaDestino = "uploads/" . $nuevoNombre;

    if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
        // Insertar en base de datos
        $sql = "INSERT INTO Documentos (id_usuario, tipo_documento, archivo, estado)
                VALUES ($id_usuario, '$tipo', '$rutaDestino', 'pendiente')";
        if ($conn->query($sql)) {
            echo "✅ Documento subido correctamente.";
        } else {
            echo "❌ Error al registrar en BD: " . $conn->error;
        }
    } else {
        echo "❌ No se pudo mover el archivo.";
    }
} else {
    echo "Método no permitido.";
}
?>
