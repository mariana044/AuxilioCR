<?php
session_start();
require_once 'conexion.php';
include 'header.php';

$sql = "SELECT titulo, descripcion, archivo_url
        FROM recursos
        WHERE tipo = 'guia'
        ORDER BY id DESC";
$res = $conn->query($sql);
?>
<main style="padding:30px;max-width:900px;margin:auto;">
  <h2>Guías de Primeros Auxilios</h2>

  <?php if ($res && $res->num_rows): ?>
    <ul style="list-style:none;padding:0;margin:0;">
      <?php while ($r = $res->fetch_assoc()): ?>
        <li style="margin:12px 0;padding:14px;border:1px solid #eee;border-radius:10px;">
          <div style="display:flex;justify-content:space-between;gap:12px;align-items:center;flex-wrap:wrap;">
            <div>
              <strong><?= htmlspecialchars($r['titulo']) ?></strong><br>
              <small><?= htmlspecialchars($r['descripcion'] ?? '') ?></small>
            </div>
            <?php if (!empty($r['archivo_url'])): ?>
              <a href="<?= htmlspecialchars($r['archivo_url']) ?>" target="_blank" rel="noopener"
                 style="padding:8px 12px;border-radius:6px;background:#0b62ff;color:#fff;text-decoration:none;">
                 Abrir
              </a>
            <?php endif; ?>
          </div>
        </li>
      <?php endwhile; ?>
    </ul>
  <?php else: ?>
    <p>No hay guías cargadas.</p>
  <?php endif; ?>
</main>
<?php include 'footer.php'; ?>
