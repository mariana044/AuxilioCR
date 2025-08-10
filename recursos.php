<?php
include 'header.php';
include 'conexionTemplate.php'; 

// Guías
$guias = $conn->query("SELECT titulo, archivo_url FROM recursos WHERE tipo='guia'");
$contactos = $conn->query("SELECT titulo, descripcion FROM recursos WHERE tipo='contacto'");
$faqs = $conn->query("SELECT pregunta, respuesta FROM preguntas_frecuentes");
?>

<main class="contenedor-recursos">
  <title>Centro de recursos</title>

  <!-- Guías -->
<section class="card guia">
  <h3>Guías De Primeros Auxilios</h3>
  <ul>
    <?php while($g = $guias->fetch_assoc()): ?>
      <li>
      <?= htmlspecialchars($g['titulo']) ?>
      <a href="<?= htmlspecialchars($g['archivo_url']) ?>" target="_blank">[PDF]</a>
      </li>
    <?php endwhile; ?>
  </ul>
</section>

<!-- Números de emergencia -->
<section class="card emergencias">
  <h3>Números De Emergencia</h3>
  <ul>
    <?php while($c = $contactos->fetch_assoc()): ?>
    <li><?=htmlspecialchars($c['titulo']) ?> - <?= htmlspecialchars($c['descripcion']) ?></li>
    <?php endwhile; ?>
  </ul>
</section>

<!-- Preguntas frecuentes -->
<section class="card preguntas">
  <h3>Preguntas Frecuentes</h3>
  <ul>
    <?php while($p = $faqs->fetch_assoc()): ?>
      <li><strong><?= htmlspecialchars($p['pregunta']) ?></strong> <?= htmlspecialchars($p['respuesta']) ?></li>
    <?php endwhile; ?>
  </ul>
</section>
</main>
<?php include 'footer.php'; ?>