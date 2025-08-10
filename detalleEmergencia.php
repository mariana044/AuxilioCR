<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: inicioSesion.html');
    exit;
}

include 'conexionTemplate.php';
include 'header.php';

if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>ID de emergencia no válido</p>";
    include 'footer.php';
    exit;
}

$idEvento = intval($_GET['id']);
$sql = "SELECT e.ubicacion, e.descripcion, e.fecha, e.estado,
               u.nombre AS nombre_reportante, u.telefono AS tel_reportante, u.correo AS correo_reportante,
               v.nombre AS nombre_voluntario, v.telefono AS tel_voluntario, v.correo AS correo_voluntario,
               a.observaciones
        FROM eventos_emergencia e
        INNER JOIN usuarios u ON e.id_usuario = u.id
        LEFT JOIN asistencias a ON e.id = a.id_evento
        LEFT JOIN usuarios v ON a.id_voluntario = v.id
        WHERE e.id = $idEvento";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $detalle = $result->fetch_assoc();
    ?>
    <main class="detalle-box">
        <h2>Detalles de la emergencia</h2>
        <p><strong>Ubicación:</strong> <?= htmlspecialchars($detalle['ubicacion']) ?></p>
        <p><strong>Descripción:</strong> <?= htmlspecialchars($detalle['descripcion']) ?></p>
        <p><strong>Fecha:</strong> <?= htmlspecialchars($detalle['fecha']) ?></p>
        <p><strong>Estado:</strong> <?= htmlspecialchars($detalle['estado']) ?></p>

        <hr>
        <h3>tel_reportante</h3>
        <p><strong>Nombre:</strong> <?= htmlspecialchars($detalle['nombre_reportante']) ?></p>
        <p><strong>Teléfono:</strong> <?= htmlspecialchars($detalle['tel_reportante']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($detalle['correo_reportante']) ?></p>

        <hr>
        <h3>Voluntario que asistió</h3>
        <p><strong>Nombre:</strong> <?= htmlspecialchars($detalle['nombre_voluntario']) ?></p>
        <p><strong>Teléfono:</strong> <?= htmlspecialchars($detalle['tel_voluntario']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($detalle['correo_voluntario']) ?></p>

        <?php if (!empty($detalle['observaciones'])): ?>
            <p><strong>Observaciones</strong> <?= htmlspecialchars($detalle['observaciones']) ?></p>
        <?php endif; ?>
        </main>
        <?php
} else {
    echo "<p>No se encontraron los detalles para esta emergencia</p>";

}

include 'footer.php';
$conn->close();
?>