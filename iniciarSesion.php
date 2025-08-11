<?php
session_start();
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo     = $conn->real_escape_string($_POST["correo"]);
    $contrasena = $_POST["contrasena"];

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' LIMIT 1";
    $res = $conn->query($sql);
}
    if ($res && $res->num_rows === 1) {
        $usuario = $res->fetch_assoc();
        if (password_verify($contrasena, $usuario['contrasena'])) {
            $_SESSION['usuario'] = [
                'id'           => $usuario['id'],
                'nombre'       => $usuario['nombre'],
                'correo'       => $usuario['correo'],
                'tipo_usuario' => $usuario['tipo_usuario']
            ];
          }
    switch ($usuario['tipo_usuario']) {
  case 'usuario':
    header("Location: panelCiudadano.php");
    break;
  case 'voluntario':
    header("Location: panelVoluntario.php");
    break;
  case 'admin':
    header("Location: panelAdmin.php");
    break;
  default:
    header("Location: iniciarSesion.php?error=2");
}
exit;

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Iniciar Sesión - AuxilioCR</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<?php include 'header.php'; ?>

<main class="form-section">
  <h2>Iniciar Sesión</h2>
  <?php if (isset($_GET['error'])): ?>
    <p style="color: red;">Correo o contraseña incorrectos.</p>
  <?php endif; ?>
  <form method="post" action="iniciarSesion.php">
    <label for="correo">Correo electrónico:</label>
    <input type="email" id="correo" name="correo" required />

    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required />

    <button type="submit" class="btn">Iniciar Sesión</button>
  </form>
  <p><a href="registro.php">¿No tenés cuenta? Registrate</a></p>
</main>

</body>
</html>

