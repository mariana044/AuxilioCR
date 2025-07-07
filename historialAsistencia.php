<?php
// historialAsistencia.php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: inicioSesion.html');
    exit;
}
include 'conexionTemplate.php';
include 'header.php';

$id = $_SESSION['usuario']['id'];

// Recuperar emergencias en las que participó este usuario (voluntario)
$sql = "SELECT id_emergencia, ubicacion, descripcion, fecha, estado
        FROM Emergencias
        WHERE id_voluntario = $id
        ORDER BY fecha DESC";
$result = $conn->query($sql);
?>
<main class="historial-box">
  <h2>📅 Historial de Asistencias</h2>

  <?php if ($result && $result->num_rows > 0): ?>
    <?php while ($fila = $result->fetch_assoc()): ?>
      <div class="historial-item">
        <strong>Ubicación:</strong> <?= htmlspecialchars($fila['ubicacion']) ?><br>
        <strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion']) ?><br>
        <strong>Fecha:</strong> <?= htmlspecialchars($fila['fecha']) ?><br>
        <strong>Estado:</strong> <?= htmlspecialchars($fila['estado']) ?>
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
