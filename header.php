<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AuxilioCR</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <header class="header">
    <div class="container">
      <a href="index.php" class="logo">AuxilioCR</a>
      <nav>
        <ul class="nav__list">
          <li><a href="index.php#inicio"          class="nav__link">Inicio</a></li>
          <li><a href="index.php#como-funciona"   class="nav__link">¿Cómo Funciona?</a></li>
          <li><a href="index.php#features"        class="nav__link">Beneficios</a></li>
          <li><a href="index.php#registro"        class="nav__link">Registro</a></li>
          <li><a href="index.php#sobreNosotros"   class="nav__link">Sobre Nosotros</a></li>

          <?php if (isset($_SESSION['usuario'])): ?>
            <li><a href="perfilUsuario.php"       class="nav__link">Mi Perfil</a></li>
            <li><a href="historialAsistencia.php" class="nav__link">Historial</a></li>
            <li><a href="recursos.php"            class="nav__link">Recursos</a></li>
            <li><a href="paneladmin.html"         class="nav__link">Panel Admin</a></li>
            <li><a href="paneladmin.php"         class="nav__link">Panel Admin</a></li>
            <li><a href="logout.php"              class="nav__link">Cerrar Sesión</a></li>
          <?php else: ?>
            <li><a href="inicioSesion.html"       class="nav__link">Iniciar Sesión</a></li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </header>
