<?php
session_start();
require_once 'conexionTemplate.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $conn->real_escape_string($_POST["correo"]);
    $clave = $_POST["clave"];

    $sql = "SELECT * FROM Usuarios WHERE correo = '$correo' LIMIT 1";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Verificamos la contraseña con password_verify()
        if (password_verify($clave, $usuario['clave'])) {
            $_SESSION['usuario'] = [
                'id' => $usuario['id_usuario'],
                'nombre' => $usuario['nombre'],
                'tipo' => $usuario['tipo']
            ];

            // Redirección según tipo
            if ($usuario['tipo'] === 'admin') {
                header("Location: panelAdmin.php");
            } else {
                header("Location: panelVoluntario.php");
            }
            exit;
        } else {
            echo "❌ Contraseña incorrecta.";
        }
    } else {
        echo "❌ Usuario no encontrado.";
    }
} else {
    echo "Acceso no autorizado.";
}

$conn->close();
?>
