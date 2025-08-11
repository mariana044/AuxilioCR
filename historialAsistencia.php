<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['usuario'])) {
  header("Location: iniciarSesion.php?error=auth"); exit;
}
$user = $_SESSION['usuario'];
$conn->set_charset('utf8mb4');

$estado = $_GET['estado'] ?? 'todos';
$validos = ['todos','en proceso','resuelto'];
if (!in_array($estado, $validos, true)) $estado = 'todos';

$sqlBase = "SELECT a.id,
                   a.fecha              AS fecha_asistencia,
                   e.id                 AS id_evento,
                   e.fecha              AS fecha_evento,
                   e.ubicacion,
                   e.descripcion,
                   e.estado
            FROM asistencias a
            JOIN eventos_emergencia e ON e.id = a.id_evento ";

$params = [];
$types  = '';

if ($user['tipo_usuario'] === 'voluntario') {
  $sqlBase .= "WHERE a.id_voluntario = ? ";
  $params[] = $user['id'];
  $types   .= 'i';
} elseif ($user['tipo_usuario'] === 'admin') {
  $sqlBase .= "WHERE 1=1 ";
} else {
  // Ciudadano: muestra eventos reportados por él (si quieres)
  $sqlBase .= "JOIN usuarios u ON u.id = e.id_usuario WHERE u.id = ? ";
  $params[] = $user['id'];
  $types   .= 'i';
}

if ($estado !== 'todos') {
  $sqlBase .= "AND e.estado = ? ";
  $params[] = $estado;
  $types   .= 's';
}

$sqlBase .= "ORDER BY a.fecha DESC";

$stmt = $conn->prepare($sqlBase);
if (!$stmt) die("Error: " . $conn->error);
if ($params) $stmt->bind_param($types, ...$params);
$stmt->execute();
$res = $stmt->get_result();

include 'header.php';
?>
<main style="padding:30px;max-width:1100px;margin:auto;">
  <h2>Historial de asistencias</h2>

  <form method="get" style="margin:12px 0;">
    <label for="estado">Filtrar por estado:</label>
    <select id="estado" name="estado" onchange="this.form.submit()">
      <option value="todos"      <?= $estado==='todos'?'selected':'' ?>>Todos</option>
      <option value="en proceso" <?= $estado==='en proceso'?'selected':'' ?>>En proceso</option>
      <option value="resuelto"   <?= $estado==='resuelto'?'selected':'' ?>>Resuelto</option>
    </select>
  </form>

  <?php if ($res && $res->num_rows): ?>
    <table style="width:100%;border-collapse:collapse;box-shadow:0 2px 8px rgba(0,0,0,.06);">
      <thead>
        <tr style="background:#f5f5f5;">
          <th style="text-align:left;padding:10px;">Asistencia #</th>
          <th style="text-align:left;padding:10px;">Evento</th>
          <th style="text-align:left;padding:10px;">Tomado</th>
          <th style="text-align:left;padding:10px;">Fecha evento</th>
          <th style="text-align:left;padding:10px;">Ubicación</th>
          <th style="text-align:left;padding:10px;">Descripción</th>
          <th style="text-align:left;padding:10px;">Estado</th>
          <?php if ($user['tipo_usuario'] === 'voluntario'): ?>
          <th style="text-align:left;padding:10px;">Acción</th>
          <?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php while($r = $res->fetch_assoc()): ?>
          <tr>
            <td style="padding:10px;"><?= htmlspecialchars($r['id']) ?></td>
            <td style="padding:10px;">#<?= htmlspecialchars($r['id_evento']) ?></td>
            <td style="padding:10px;"><?= htmlspecialchars($r['fecha_asistencia']) ?></td>
            <td style="padding:10px;"><?= htmlspecialchars($r['fecha_evento']) ?></td>
            <td style="padding:10px;"><?= htmlspecialchars($r['ubicacion']) ?></td>
            <td style="padding:10px;"><?= htmlspecialchars($r['descripcion']) ?></td>
            <td style="padding:10px;"><?= htmlspecialchars($r['estado']) ?></td>
            <?php if ($user['tipo_usuario'] === 'voluntario'): ?>
            <td style="padding:10px;">
              <?php if ($r['estado'] === 'en proceso'): ?>
                <a href="finalizar_evento.php?id=<?= urlencode($r['id_evento']) ?>"
                   style="padding:6px 10px;border-radius:6px;background:#28a745;color:#fff;text-decoration:none;">
                   Marcar resuelto
                </a>
              <?php else: ?>
                —
              <?php endif; ?>
            </td>
            <?php endif; ?>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No hay asistencias registradas.</p>
  <?php endif; ?>
</main>
<?php include 'footer.php'; ?>
