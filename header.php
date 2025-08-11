<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/config.php';
$usuario = $_SESSION['usuario'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AuxilioCR</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>style.css" />
  <style>
    .nav__list{display:flex;align-items:center;gap:15px;list-style:none;margin:0;padding:0;}
    .nav__link{text-decoration:none;color:#fff;}
    .nav__link:hover{text-decoration:underline;}
    .btn-login,.btn-register,.btn-logout{background:transparent!important;color:#fff!important;padding:6px 12px;border-radius:4px;font-weight:bold;transition:.3s;border:none;}
    .btn-login:hover,.btn-register:hover,.btn-logout:hover{background:#fff!important;color:#333!important;cursor:pointer;}
    .right-buttons{margin-left:auto;display:flex;gap:10px;}
  </style>
</head>
<body>
<header class="header">
  <div class="container">
    <a href="<?= BASE_URL ?>index.php" class="logo">AuxilioCR</a>
    <nav>
      <ul class="nav__list">
        <?php if ($usuario): ?>
          <li><a class="nav__link" href="#"><?= htmlspecialchars($usuario['nombre']) ?></a></li>

          <?php if ($usuario['tipo_usuario'] === 'admin'): ?>
            <li><a class="nav__link" href="<?= BASE_URL ?>panelAdmin.php">Panel Admin</a></li>
            <li><a class="nav__link" href="<?= BASE_URL ?>gestionar_voluntarios.php">Voluntarios</a></li>
            <li><a class="nav__link" href="<?= BASE_URL ?>gestionar_emergencias.php">Emergencias</a></li>

          <?php elseif ($usuario['tipo_usuario'] === 'voluntario'): ?>
            <li><a class="nav__link" href="<?= BASE_URL ?>eventos_disponibles.php">Eventos</a></li>

          <?php elseif ($usuario['tipo_usuario'] === 'ciudadano'): ?>
            <li><a class="nav__link" href="<?= BASE_URL ?>panelCiudadano.php">Inicio</a></li>
            <li><a class="nav__link" href="<?= BASE_URL ?>index.php#como-funciona">¿Cómo Funciona?</a></li>
            <li><a class="nav__link" href="<?= BASE_URL ?>index.php#features">Beneficios</a></li>
            <li><a class="nav__link" href="<?= BASE_URL ?>sobreNosotros.html">Sobre Nosotros</a></li>
            <li><a class="nav__link" href="<?= BASE_URL ?>emergencia.php">Emergencia</a></li>
          <?php endif; ?>

          <li><a class="nav__link" href="<?= BASE_URL ?>historialAsistencia.php">Historial</a></li>
          <li><a class="nav__link" href="<?= BASE_URL ?>recursos.php">Recursos</a></li>
          <li><a class="nav__link" href="<?= BASE_URL ?>perfilUsuario.php">Perfil</a></li>

          <div class="right-buttons">
            <li><a class="nav__link btn-logout" href="<?= BASE_URL ?>cerrarSesion.php">Cerrar Sesión</a></li>
          </div>

        <?php else: ?>
          <li><a class="nav__link" href="<?= BASE_URL ?>index.php">Inicio</a></li>
          <li><a class="nav__link" href="<?= BASE_URL ?>index.php#como-funciona">¿Cómo Funciona?</a></li>
          <li><a class="nav__link" href="<?= BASE_URL ?>index.php#features">Beneficios</a></li>
          <li><a class="nav__link" href="<?= BASE_URL ?>sobreNosotros.html">Sobre Nosotros</a></li>

          <div class="right-buttons">
            <li><a class="nav__link btn-register" href="<?= BASE_URL ?>registro.php">Registrarme</a></li>
            <li><a class="nav__link btn-login" href="<?= BASE_URL ?>iniciarSesion.php">Iniciar Sesión</a></li>
          </div>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</header>
