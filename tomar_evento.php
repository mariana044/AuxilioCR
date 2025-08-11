<?php
session_start();
require_once 'conexion.php';
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario'] !== 'voluntario') {
  header("Location: iniciarSesion.php?error=auth"); exit;
}
$volId = $_SESSION['usuario']['id'] ?? 0;

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) { header("Location: eventos_disponibles.php"); exit; }

$conn->set_charset('utf8mb4');
$conn->begin_transaction();

try {
  // Verifica que exista y esté pendiente
  $stmt = $conn->prepare("SELECT estado FROM eventos_emergencia WHERE id=? FOR UPDATE");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $row = $stmt->get_result()->fetch_assoc();
  $stmt->close();

  if (!$row) throw new Exception("Evento no existe.");
  if ($row['estado'] !== 'pendiente') throw new Exception("Evento ya no está disponible.");

  // Evitar doble registro en asistencias
  $stmt = $conn->prepare("SELECT 1 FROM asistencias WHERE id_evento=? LIMIT 1");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $ya = $stmt->get_result()->num_rows > 0;
  $stmt->close();

  if ($ya) throw new Exception("Evento ya fue tomado.");

  // Insert asistencia
  $stmt = $conn->prepare("INSERT INTO asistencias (id_evento, id_voluntario, fecha, observaciones)
                          VALUES (?, ?, NOW(), NULL)");
  $stmt->bind_param("ii", $id, $volId);
  if (!$stmt->execute()) throw new Exception("No se pudo asignar.");
  $stmt->close();

  // Actualiza estado
  $stmt = $conn->prepare("UPDATE eventos_emergencia SET estado='en proceso' WHERE id=?");
  $stmt->bind_param("i", $id);
  if (!$stmt->execute()) throw new Exception("No se pudo actualizar estado.");
  $stmt->close();

  $conn->commit();
  header("Location: mis_emergencias.php?ok=1"); exit;

} catch (Exception $e) {
  $conn->rollback();
  header("Location: eventos_disponibles.php?error=" . urlencode($e->getMessage())); exit;
}
