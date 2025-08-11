<?php
session_start();
require_once 'conexion.php';
include 'header.php';
?>
<main class="recursos-section" style="text-align:center; padding:30px;">
  <h2>Centro de Recursos</h2>

  <div style="display:flex;justify-content:center;gap:20px;flex-wrap:wrap;margin-top:20px;">
    <!-- Guías (desde BD, se listan en guias.php) -->
    <a href="guias.php"
       class="recurso-card"
       style="display:block;width:260px;background:#fff;padding:20px;text-decoration:none;color:inherit;border-radius:10px;box-shadow:0 4px 8px rgba(0,0,0,.1);border-top:4px solid green;cursor:pointer;">
      <h3 style="color:#003366;margin:0 0 6px;">Guías De Primeros Auxilios</h3>
      <small>Ver todas las guías</small>
    </a>

    <!-- Números (desde BD) -->
    <a href="numeros_emergencia.php"
       class="recurso-card"
       style="display:block;width:260px;background:#fff;padding:20px;text-decoration:none;color:inherit;border-radius:10px;box-shadow:0 4px 8px rgba(0,0,0,.1);border-top:4px solid red;cursor:pointer;">
      <h3 style="color:#003366;margin:0 0 6px;">Números De Emergencia</h3>
      <small>Directorio nacional</small>
    </a>

    <!-- FAQ (desde BD) -->
    <a href="preguntas_frecuentes.php"
       class="recurso-card"
       style="display:block;width:260px;background:#fff;padding:20px;text-decoration:none;color:inherit;border-radius:10px;box-shadow:0 4px 8px rgba(0,0,0,.1);border-top:4px solid blue;cursor:pointer;">
      <h3 style="color:#003366;margin:0 0 6px;">Preguntas Frecuentes</h3>
      <small>Respuestas rápidas</small>
    </a>
  </div>
</main>
<?php include 'footer.php'; ?>
