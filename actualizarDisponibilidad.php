
<?php
session_start();
require_once 'conexionTemplate.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'voluntario') {
    header("Location: inicioSesion.html");
    exit;
}

$id = $_SESSION['usuario']['id'];
$disponible = isset($_POST['disponible']) ? 1 : 0;

$sql = "UPDATE Usuarios SET disponible = $disponible WHERE id_usuario = $id";
$conn->query($sql);

header("Location: perfilUsuario.php");
exit;
?>
