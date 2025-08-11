<?php
session_start();
require_once 'conexion.php';
$conn->set_charset('utf8mb4');

// Objetivo: 10 pendientes
$target = 10;
$pending = (int)($conn->query("SELECT COUNT(*) c FROM eventos_emergencia WHERE estado='pendiente'")->fetch_assoc()['c'] ?? 0);
$toAdd = max(0, $target - $pending);

if ($toAdd > 0) {
  $samples = [
    ['San José centro', 'Persona desmayada frente al parque'],
    ['Heredia Belén', 'Choque leve, dolor cervical'],
    ['Cartago Tres Ríos', 'Corte superficial, necesita curación'],
    ['Alajuela centro', 'Quemadura leve en mano'],
    ['Pavas', 'Atragantamiento en restaurante'],
    ['Desamparados', 'Caída con posible esguince'],
    ['Escazú', 'Reacción alérgica leve'],
    ['Curridabat', 'Herida en la ceja por golpe'],
    ['Moravia', 'Dolor torácico, evaluar y llamar 911'],
    ['Guadalupe', 'Hipoglucemia, administrar azúcar si procede'],
    ['La Uruca', 'Convulsión, despejar y proteger cabeza'],
    ['Sabanilla', 'Hemorragia nasal persistente'],
  ];

  $stmt = $conn->prepare("INSERT INTO eventos_emergencia (id_usuario, ubicacion, descripcion, estado) VALUES (NULL, ?, ?, 'pendiente')");
  for ($i=0; $i<$toAdd; $i++) {
    $p = $samples[array_rand($samples)];
    $stmt->bind_param("ss", $p[0], $p[1]);
    $stmt->execute();
  }
  $stmt->close();
}

header("Location: eventos_disponibles.php?seed=$toAdd");
exit;
