<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario'] !== 'admin') {
    header('Location: inicioSesion.html');
    exit;
}
$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panel de Administración - AuxilioCR</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="panelAdmin.css" />
</head>
<body>
  <?php include 'header.php'; ?>

  <main class="form-section">
    <h2>Panel de Administración</h2>
    <p>Aquí podrá validar documentos de voluntarios y gestionar emergencias.</p>
    <ul>
      <li><a href="revisar_documentos.php">Revisar documentos pendientes</a></li>
      <li><a href="historial_emergencias.php">Historial de emergencias</a></li>
      <li><a href="usuarios_registrados.php">Usuarios registrados</a></li>
    </ul>
  </main>
</body>
</html>
