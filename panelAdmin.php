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
  <title>Panel de Administracion - AuxilioCR</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .container {
      max-width: 1000px;
      margin: auto;
      padding: 2rem;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 0.75rem;
      text-align: center;
    }
    th {
      background-color: #006d77;
      color: white;
    }
    .btn {
      background-color: #008891;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .btn:hover {
      background-color: #006d77;
    }
  </style>
</head>
<body>
  <header class="header">
    <a href="index.php" class="logo">AuxilioCR</a>
    <nav>
      <ul class="nav__list">
        <li><a href="index.php" class="nav__link">Inicio</a></li>
        <li><a href="logout.php" class="nav__link">Cerrar sesión</a></li>
      </ul>
    </nav>
  </header>

  <main class="container">
    <h1>Bienvenido, <?php echo $_SESSION['usuario']['nombre']; ?> (Administrador)</h1>

    <!-- Gestión de Voluntarios -->
    <section>
      <h2>Gestión de Voluntarios</h2>
      <table>
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Estado</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody id="tablaVoluntarios"></tbody>
      </table>
    </section>

    <!-- Gestión de Emergencias -->
    <section>
      <h2>Gestión de Emergencias</h2>
      <button class="btn" onclick="mostrarEstadisticas()">Ver estadísticas</button>
      <div id="estadisticaEmergencias"></div>
    </section>

    <!-- Gestión del Sistema -->
    <section>
      <h2>Gestión del Sistema</h2>
      <button class="btn" onclick="controlUsuarios()">Control de usuarios</button>
      <div id="controlUsuariosResultado"></div>
    </section>
  </main>

  <footer class="footer">
    <p>&copy; 2025 AuxilioCR - Todos los derechos reservados</p>
  </footer>

  <script src="panelAdmin.js"></script>
</body>
</html>
