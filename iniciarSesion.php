<?php
session_start();
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo      = $conn->real_escape_string($_POST["correo"]);
    $contrasena  = $_POST["contrasena"];

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' LIMIT 1";
    $res = $conn->query($sql);

    if ($res && $res->num_rows === 1) {
        $usuario = $res->fetch_assoc();
        if (password_verify($contrasena, $usuario['contrasena'])) {
            $_SESSION['usuario'] = [
              'id'           => $usuario['id'],
              'nombre'       => $usuario['nombre'],
              'correo'       => $usuario['correo'],
              'tipo_usuario' => $usuario['tipo_usuario']
            ];

            switch ($usuario['tipo_usuario']) {
                case 'ciudadano':
                    header("Location: panelCiudadano.php");
                    break;
                case 'voluntario':
                    header("Location: panelVoluntario.php");
                    break;
                case 'admin':
                    header("Location: panelAdmin.php");
                    break;
                default:
                    echo "Tipo de usuario no reconocido.";
                    exit;
            }
            exit;
        }

        
    }
        header("Location: inicioSesion.html?error=1");
    exit;
} else {
    echo "Acceso denegado.";
<<<<<<< HEAD
}
=======
}

>>>>>>> origin/main
