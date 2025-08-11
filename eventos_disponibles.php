<?php
session_start();
require_once 'conexion.php';
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario'] !== 'voluntario') {
  header("Location: iniciarSesion.php?error=auth"); exit;
}
$vol = $_SESSION['usuario'];

$conn->set_charset('utf8mb4');

/* Semilla de pruebas si no hay emergencias */
$chk = $conn->query("SELECT COUNT(*) c FROM eventos_emergencia")->fetch_assoc();
if ($chk && (int)$chk['c'] === 0) {
  $conn->query("INSERT INTO eventos_emergencia (id_usuario, ubicacion, descripcion) VALUES
    (NULL,'San José centro','Persona desmayada frente a parque'),
    (NULL,'Heredia Belén','Choque leve, posible latigazo cervical'),
    (NULL,'Cartago Tres Ríos','Corte superficial, necesita curación')");
}

$sql = "SELECT e.id, e.fecha, e.ubicacion, e.descripcion, e.estado,
               COALESCE(u.nombre,'Anónimo') AS reportante
        FROM eventos_emergencia e
        LEFT JOIN usuarios u ON u.id = e.id_usuario
        WHERE e.estado = 'pendiente'
        ORDER BY e.fecha DESC";
$res = $conn->query($sql);
?>
<?php include 'header.php'; ?>
<main style="padding:30px;max-width:1000px;margin:auto;">
  <h2>Emergencias disponibles</h2>
  <?php if ($res && $res->num_rows): ?>
    <table style="width:100%;border-collapse:collapse;box-shadow:0 2px 8px rgba(0,0,0,.06);">
      <thead>
        <tr style="background:#f5f5f5;">
          <th style="text-align:left;padding:10px;">ID</th>
          <th style="text-align:left;padding:10px;">Fecha</th>
          <th style="text-align:left;padding:10px;">Ubicación</th>
          <th style="text-align:left;padding:10px;">Descripción</th>
          <th style="text-align:left;padding:10px;">Reportante</th>
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
            <td style="padding:10px;"><?= htmlspecialchars($r['reportante']) ?></td>
            <td style="padding:10px;">
              <a href="tomar_evento.php?id=<?= urlencode($r['id']) ?>"
                 style="padding:8px 12px;border-radius:6px;background:#0b62ff;color:#fff;text-decoration:none;">
                 Tomar
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No hay emergencias pendientes por ahora.</p>
  <?php endif; ?>

  <hr style="margin:24px 0;">
  <a href="mis_emergencias.php" class="nav__link"
     style="padding:8px 12px;border-radius:6px;background:#eee;text-decoration:none;">
     Ver mis emergencias
  </a>
</main>
<?php include 'footer.php'; ?>
