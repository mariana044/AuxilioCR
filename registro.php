<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registro - AuxilioCR</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<?php
if (isset($_GET['status']) && $_GET['status'] === 'success') {


    $nombre = htmlspecialchars($_GET['nombre']);
    $tipo = htmlspecialchars($_GET['tipo']);
    echo "<section class='form-section'>";
    echo "<h2>Registro exitoso!</h2>";
    echo "<p>Gracias, <strong>$nombre</strong>, te hemos registrado como <strong>$tipo</strong>.</p>";
    echo "<a href='index.php' class='btn'>Volver a inicio</a>";
    echo "</section>";
} else {

?>

<main>
  <section class="form-section">
    <h2>Formulario de Registro</h2>
    <form method="post" action="procesar_registro.php" novalidate>
      <label for="nombre">Nombre completo:</label>
      <input type="text" id="nombre" name="nombre" required>

      <label for="correo">Correo electrónico:</label>
      <input type="email" id="correo" name="correo" required>

      <label for="tipo">Tipo de usuario:</label>
      <select id="tipo" name="tipo">
        <option value="ciudadano">Ciudadano</option>
        <option value="voluntario">Voluntario</option>
      </select>

      <label for="comentario">Comentarios:</label>
      <textarea id="comentario" name="comentario" rows="4"></textarea>

      <input type="submit" value="Enviar">

      <br /><br />
  <a href="index.php" class="btn-volver">Volver a Inicio</a>
    </form>
  </section>
</main>

<?php
}
?>

</body>
</html>
