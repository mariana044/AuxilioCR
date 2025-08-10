<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario'] !== 'ciudadano') {
    header('Location: inicioSesion.html');
    exit;
}
$nombre = $_SESSION['usuario']['nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Ciudadano - AuxilioCR</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="ciudadano">
 

    <main class="container">
        <section class="hero">
            <div class="container">
                <h1>¡Bienvenido/a, <?php echo htmlspecialchars($nombre); ?>!</h1>
                <p>Este es tu panel como <strong>ciudadano</strong>. Aquí podrás acceder a herramientas útiles para situaciones de emergencia.</p>
                <a href="emergencia.php" class="btn">Reportar Emergencia</a>
            </div>
        </section>

        <section class="features">
            <h2>¿Qué podés hacer?</h2>
            <div class="features__grid">
                <div class="feature-card">
                    <h3>Historial de Asistencia</h3>
                    <p>Revisá tus reportes anteriores y el seguimiento dado.</p>
                    <a href="historial_asistencia.php" class="btn-volver">Ver Historial</a>
                </div>
                <div class="feature-card">
                    <h3>Centro de Recursos</h3>
                    <p>Accedé a documentos y consejos útiles para emergencias.</p>
                    <a href="centro_recursos.php" class="btn-volver">Ir al Centro</a>
                </div>
                <div class="feature-card">
                    <h3>Cerrar Sesión</h3>
                    <p>Terminá tu sesión de forma segura.</p>
                    <a href="cerrarSesion.php" class="btn-volver">Cerrar Sesión</a>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>

