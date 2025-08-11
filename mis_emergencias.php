<?php
session_start();
require_once 'conexion.php';
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario'] !== 'voluntario') {
  header("Location: iniciarSesion.php?error=auth"); exit;
}
$volId = $_SESSION['usuario']['id'];
$conn->set_charset('utf8mb4');

$sql = "SELECT e.id, e.fecha, e.ubicacion, e.descripcion, e.estado
        FROM asistencias a
        JOIN eventos_emergencia e ON e.id = a.id_evento
        WHERE a.id_voluntario = ? AND e.estado IN ('en proceso')
        ORDER BY e.fecha DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $volId);
$stmt->execute();
$res = $stmt->get_result();
$stmt->close();
?>
<?php include 'header.php'; ?>
<main style="padding:30px;max-width:1000px;margin:auto;">
  <h2>Mis emergencias en proceso</h2>
  <?php if ($res && $res->num_rows): ?>
    <table style="width:100%;border-collapse:collapse;box-shadow:0 2px 8px rgba(0,0,0,.06);">
      <thead>
        <tr style="background:#f5f5f5;">
          <th style="text-align:left;padding:10px;">ID</th>
          <th style="text-align:left;padding:10px;">Fecha</th>
          <th style="text-align:left;padding:10px;">Ubicación</th>
          <th style="text-align:left;padding:10px;">Descripción</th>
          <th style="text-align:left;padding:10px;">Estado</th>
          <th style="text-align:left;padding:10px;">Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php while($r = $res->fetch_assoc()): ?>
          <tr>
            <td style="padding:10px;"><?= htmlspecialchars($r['id']) ?></td>
            <td style="padding:10px;"><?= htmlspecialchars($r['fecha']) ?></td>
            <td style="padding:10px;"><?= htmlspecialchars($r['ubicacion']) ?></td>
            <td style="padding:10px;"><?= htmlspecialchars($r['descripcion']) ?></td>
            <td style="padding:10px;"><?= htmlspecialchars($r['estado']) ?></td>
            <td style="padding:10px;">
              <a href="finalizar_evento.php?id=<?= urlencode($r['id']) ?>"
                 style="padding:8px 12px;border-radius:6px;background:#28a745;color:#fff;text-decoration:none;">
                 Marcar resuelto
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No tenés emergencias en proceso ahora mismo.</p>
  <?php endif; ?>

  <hr style="margin:24px 0;">
  <a href="eventos_disponibles.php" class="nav__link"
     style="padding:8px 12px;border-radius:6px;background:#eee;text-decoration:none;">
     Ver disponibles
  </a>
</main>
<?php include 'footer.php'; ?>
