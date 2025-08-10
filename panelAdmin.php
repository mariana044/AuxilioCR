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
  <?php include 'header.php'; ?>

  <main class="container">
    <h1>Bienvenido, <?php echo htmlspecialchars($usuario['nombre']); ?> (Administrador)</h1>


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

    <section>
      <h2>Gestión de Emergencias</h2>
      <button class="btn" onclick="mostrarEstadisticas()">Ver estadísticas</button>
      <div id="estadisticaEmergencias"></div>
    </section>

   
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
