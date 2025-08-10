<?php
include 'header.php';
require_once 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: inicioSesion.html");
    exit;
}

$id = $_SESSION['usuario']['id'];
$nom= $_SESSION['usuario']['nombre'];
$tip= $_SESSION['usuario']['tipo_usuario'];


$r = $conn->query("SELECT 1 FROM Documentos WHERE id_usuario=$id AND estado='aprobado' LIMIT 1");
$ver = $r && $r->num_rows ? 'Verificado' : 'No verificado';


$hist = $conn->query("SELECT ubicacion,descripcion,fecha,estado
                      FROM Emergencias
                      WHERE id_voluntario=$id
                      ORDER BY fecha DESC");
?>
<main class="perfil-box">
  <h2> Perfil de <?php echo htmlspecialchars($nom); ?></h2>
  <p><strong>Tipo:</strong> <?php echo htmlspecialchars($tip); ?></p>
  <p><strong>Verificación:</strong> <?php echo $ver; ?></p>

  <h3>Historial de Asistencias</h3>
  <?php if ($hist && $hist->num_rows): ?>
    <?php while($f = $hist->fetch_assoc()): ?>
      <div class="historial-item">
        <strong>Ubicación:</strong> <?php echo htmlspecialchars($f['ubicacion']); ?><br>
        <strong>Fecha:</strong> <?php echo htmlspecialchars($f['fecha']); ?><br>
        <strong>Estado:</strong> <?php echo htmlspecialchars($f['estado']); ?><br>  
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No hay asistencias registradas.</p>
  <?php endif; ?>
</main>
<?php include 'footer.php'; ?>
