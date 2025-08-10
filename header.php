<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$usuario = $_SESSION['usuario'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AuxilioCR</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .nav__list {
      display: flex;
      align-items: center;
      gap: 15px;
      list-style: none;
      margin: 0;
      padding: 0;
    }
    .nav__link {
      text-decoration: none;
      color: #fff;
    }
    .nav__link:hover {
      text-decoration: underline;
    }
   
    .btn-login, .btn-register, .btn-logout {
      background-color: transparent !important;
      color: #fff !important;
      padding: 6px 12px;
      border-radius: 4px;
      font-weight: bold;
      transition: background-color 0.3s ease, color 0.3s ease;
      border: none;
    }
    .btn-login:hover, .btn-register:hover, .btn-logout:hover {
      background-color: #fff !important;
      color: #333 !important;
      cursor: pointer;
    }
    
    .right-buttons {
      margin-left: auto;
      display: flex;
      gap: 10px;
    }
  </style>
</head>
<body>
  <header class="header">
    <div class="container">
      <a href="index.php" class="logo">AuxilioCR</a>

      <nav>
        <ul class="nav__list">
          <?php if ($usuario): ?>
            <li><a href="#" class="nav__link">Hola, <?= htmlspecialchars($usuario['nombre']) ?></a></li>

            <?php if ($usuario['tipo_usuario'] === 'admin'): ?>
              <li><a href="panelAdmin.php" class="nav__link">Panel Admin</a></li>
              <li><a href="gestionar_voluntarios.php" class="nav__link">Voluntarios</a></li>
              <li><a href="gestionar_emergencias.php" class="nav__link">Emergencias</a></li>

            <?php elseif ($usuario['tipo_usuario'] === 'voluntario'): ?>
              <li><a href="eventos_disponibles.php" class="nav__link">Eventos</a></li>

            <?php elseif ($usuario['tipo_usuario'] === 'ciudadano'): ?>
              <li><a href="panelCiudadano.php" class="nav__link">Inicio</a></li>
              <li><a href="index.php" class="nav__link">¿Cómo Funciona?</a></li>
              <li><a href="index.php" class="nav__link">Beneficios</a></li>
              <li><a href="sobreNosotros.html" class="nav__link">Sobre Nosotros</a></li>
              <li><a href="emergencia.php" class="nav__link">Emergencia</a></li>
            <?php endif; ?>

            <li><a href="historialAsistencia.php" class="nav__link">Historial</a></li>
            <li><a href="recursos.php" class="nav__link">Recursos</a></li>
            <li><a href="perfilUsuario.php" class="nav__link">Perfil</a></li>

            <div class="right-buttons">
              <li><a href="cerrarSesion.php" class="nav__link btn-logout">Cerrar Sesión</a></li>
            </div>

          <?php else: ?>
            <li><a href="index.php" class="nav__link">Inicio</a></li>
            <li><a href="index.php#como-funciona" class="nav__link">¿Cómo Funciona?</a></li>
            <li><a href="index.php#features" class="nav__link">Beneficios</a></li>
            <li><a href="sobreNosotros.html" class="nav__link">Sobre Nosotros</a></li>

            <div class="right-buttons">
              <li><a href="registro.php" class="nav__link btn-register">Registrarme</a></li>
              <li><a href="iniciarSesion.php" class="nav__link btn-login">Iniciar Sesión</a></li>
            </div>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </header>
