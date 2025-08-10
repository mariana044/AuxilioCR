<?php
//historialAsistencia.php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: inicioSesion.html');
    exit;
}
include 'conexion.php';
include 'header.php';

$id = $_SESSION['usuario']['id'];

$sql = "SELECT e.id, e.ubicacion, e.descripcion, e.fecha, e.estado,
               u.nombre AS nombre_reportante
          FROM asistencias a 
          INNER JOIN eventos_emergencia e ON a.id_evento = e.id
          INNER JOIN usuarios u ON e.id_usuario = u.id
          WHERE a.id_voluntario = $id
          ORDER BY e.fecha DESC";
$result = $conn->query($sql);
?>
<main class="historial-box">
  <h2>Historial de Asistencias</h2>

  <?php if ($result && $result->num_rows > 0): ?>
    <?php while ($fila = $result->fetch_assoc()): ?>
      <div class="historial-item">
        <strong>Ubicación:</strong> <?= htmlspecialchars($fila['ubicacion']) ?><br>
        <strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion']) ?><br>
        <strong>Fecha:</strong> <?= htmlspecialchars($fila['fecha']) ?><br>
        <strong>Estado:</strong> <?= htmlspecialchars($fila['estado']) ?>
        <strong>Reportado por:</strong> <?= htmlspecialchars($fila['nombre_reportante']) ?><br>
        <a href="detalleEmergencia.php?id=<?= $fila['id'] ?>" class="btn-detalle">Ver detalles</a>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No se han registrado asistencias aún.</p>
  <?php endif; ?>
</main>
<?php
include 'footer.php';
$conn->close();
?>
