<?php
session_start();
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $conn->real_escape_string($_POST["correo"]);
    $clave = $_POST["contrasena"];

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' LIMIT 1";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($clave, $usuario['contrasena'])) {
            $_SESSION['usuario'] = [
                'id' => $usuario['id_usuario'],
                'nombre' => $usuario['nombre'],
                'tipo' => $usuario['tipo_usuario']
            ];

            if ($usuario['tipo_usuario'] === 'admin') {
                header("Location: panelAdmin.php");
            } else {
                header("Location: panelVoluntario.php");
            }
            exit;
        } else { c 
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
} else {
    echo "Acceso no autorizado.";
}

$conn->close();
?>
