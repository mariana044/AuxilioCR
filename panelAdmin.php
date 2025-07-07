<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'admin') {
    header("Location: inicioSesion.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administración - AuxilioCR</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .menu-admin {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      max-width: 400px;
      margin: auto;
      margin-top: 40px;
    }

    .menu-admin a {
      display: block;
      background-color: #8a1538;
      color: white;
      padding: 15px;
      text-align: center;
      text-decoration: none;
      border-radius: 8px;
      transition: background-color 0.3s ease;
    }

    .menu-admin a:hover {
      background-color: #5c1026;
    }
  </style>
</head>
<body>
  <main class="form-section">
    <h2>Bienvenido, <?php echo $_SESSION['usuario']['nombre']; ?> (Administrador)</h2>
    <div class="menu-admin">
      <a href="revisarDocumentos.php">📋 Revisar documentos pendientes</a>
      <a href="historialEmergencias.php">📂 Historial de emergencias</a>
      <a href="usuariosRegistrados.php">👥 Usuarios registrados</a>
      <a href="logout.php">🔓 Cerrar sesión</a>
    </div>
  </main>
</body>
</html>
