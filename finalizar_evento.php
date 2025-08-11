<?php
session_start();
require_once 'conexion.php';
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario'] !== 'voluntario') {
  header("Location: iniciarSesion.php?error=auth"); exit;
}
$volId = $_SESSION['usuario']['id'] ?? 0;
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) { header("Location: mis_emergencias.php"); exit; }

$conn->set_charset('utf8mb4');
$conn->begin_transaction();
try {
  // verificar que el evento pertenece al voluntario
  $stmt = $conn->prepare("SELECT 1
                          FROM asistencias a
                          JOIN eventos_emergencia e ON e.id=a.id_evento
                          WHERE a.id_voluntario=? AND e.id=? FOR UPDATE");
  $stmt->bind_param("ii", $volId, $id);
  $stmt->execute();
  $ok = $stmt->get_result()->num_rows > 0;
  $stmt->close();
  if (!$ok) throw new Exception("No autorizado.");

  // actualizar estado
  $stmt = $conn->prepare("UPDATE eventos_emergencia SET estado='resuelto' WHERE id=?");
  $stmt->bind_param("i", $id);
  if (!$stmt->execute()) throw new Exception("No se pudo finalizar.");
  $stmt->close();

  $conn->commit();
  header("Location: mis_emergencias.php?fin=1"); exit;
} catch (Exception $e) {
  $conn->rollback();
  header("Location: mis_emergencias.php?error=" . urlencode($e->getMessage())); exit;
}
