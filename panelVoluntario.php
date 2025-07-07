<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'voluntario') {
    header("Location: inicioSesion.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Voluntario - AuxilioCR</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .menu-voluntario {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      max-width: 400px;
      margin: auto;
      margin-top: 40px;
    }

    .menu-voluntario a {
      display: block;
      background-color: #006d77;
      color: white;
      padding: 15px;
      text-align: center;
      text-decoration: none;
      border-radius: 8px;
      transition: background-color 0.3s ease;
    }

    .menu-voluntario a:hover {
      background-color: #005a66;
    }
  </style>
</head>
<body>
  <main class="form-section">
    <h2>Bienvenido, <?php echo $_SESSION['usuario']['nombre']; ?> (Voluntario)</h2>
    <div class="menu-voluntario">
      <a href="cargarDocumentos.html">📄 Subir documentos</a>
      <a href="verEmergencias.php">🚨 Emergencias asignadas</a>
      <a href="logout.php">🔓 Cerrar sesión</a>
    </div>
  </main>
</body>
</html>
