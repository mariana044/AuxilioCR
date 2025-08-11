<?php
session_start();
require_once 'conexion.php';
include 'header.php';

$sql = "SELECT pregunta, respuesta
        FROM preguntas_frecuentes
        ORDER BY id";
$res = $conn->query($sql);
?>
<main style="padding:30px;max-width:900px;margin:auto;">
  <h2>Preguntas Frecuentes</h2>

  <?php if ($res && $res->num_rows): ?>
    <?php while ($r = $res->fetch_assoc()): ?>
      <details style="margin:12px 0;border:1px solid #eee;border-radius:8px;padding:12px;">
        <summary style="cursor:pointer;font-weight:600;">
          <?= htmlspecialchars($r['pregunta']) ?>
        </summary>
        <div style="margin-top:8px;color:#333;">
          <?= nl2br(htmlspecialchars($r['respuesta'])) ?>
        </div>
      </details>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No hay preguntas frecuentes cargadas.</p>
  <?php endif; ?>
</main>
<?php include 'footer.php'; ?>
