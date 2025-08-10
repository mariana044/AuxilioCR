<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario'] !== 'voluntario') {
    header('Location: inicioSesion.html');
    exit;
}
$nombre = $_SESSION['usuario']['nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Voluntario - AuxilioCR</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="voluntario-container">
        <div class="voluntario-bienvenida">
            <h1>¡Bienvenido/a, <?php echo htmlspecialchars($nombre); ?>!</h1>
            <p>¡Qué alegría tenerte como voluntario/a!</p>
        </div>

        <nav class="voluntario-menu">
            <a href="eventos_disponibles.php" class="btn-voluntario">Eventos de Emergencia</a>
            <a href="historialAsistencia.php" class="btn-voluntario">Historial de Asistencia</a>
            <a href="recursos.php" class="btn-voluntario">Centro de Recursos</a>
            <a href="cerrarSesion.php" class="btn-voluntario salir">Cerrar Sesión</a>
        </nav>

        <section class="voluntario-info">
            <h2>Panel Voluntario</h2>
            <p>Podés ver emergencias cercanas, atenderlas y revisar tu historial de ayuda.</p>
        </section>
    </main>
</body>
</html>
