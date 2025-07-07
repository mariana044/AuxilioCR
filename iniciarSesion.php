<?php
session_start();
require_once 'conexionTemplate.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $conn->real_escape_string($_POST["correo"]);
    $clave  = $_POST["clave"];

    $sql    = "SELECT * FROM Usuarios WHERE correo = '$correo' LIMIT 1";
    $res    = $conn->query($sql);

    if ($res && $res->num_rows === 1) {
        $u = $res->fetch_assoc();
        if (password_verify($clave, $u['clave'])) {
            $_SESSION['usuario'] = [
              'id'     => $u['id_usuario'],
              'nombre' => $u['nombre'],
              'tipo'   => $u['tipo']
            ];
            header("Location: index.php");
            exit;
        }
    }
    header("Location: inicioSesion.html?error=1");
    exit;
} else {
    echo "Acceso denegado.";
}
