<?php
session_start();
require_once 'conexion.php';
include 'header.php';

$sql = "SELECT titulo, descripcion
        FROM recursos
        WHERE tipo='contacto'
        ORDER BY titulo";
$res = $conn->query($sql);
?>
<main style="padding:30px;max-width:700px;margin:auto;">
  <h2>Números de Emergencia</h2>

  <?php if ($res && $res->num_rows): ?>
    <table style="width:100%;border-collapse:collapse;box-shadow:0 2px 8px rgba(0,0,0,.06);">
      <thead>
        <tr style="background:#f5f5f5;">
          <th style="text-align:left;padding:10px;">Número</th>
          <th style="text-align:left;padding:10px;">Descripción</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($r = $res->fetch_assoc()): ?>
          <tr>
            <td style="padding:10px;font-weight:bold;"><?= htmlspecialchars($r['titulo']) ?></td>
            <td style="padding:10px;"><?= htmlspecialchars($r['descripcion']) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No hay números configurados.</p>
  <?php endif; ?>
</main>
<?php include 'footer.php'; ?>
