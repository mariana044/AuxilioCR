<?php
// Formulario de registro
include 'header.php';
?>
<main class="form-section">
  <h2>Registrarse</h2>
  <form method="post" action="procesarRegistro.php">
    <label for="nombre">Nombre completo:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="correo">Correo electrónico:</label>
    <input type="email" id="correo" name="correo" required>

    <label for="clave">Contraseña:</label>
    <input type="password" id="clave" name="clave" required>

    <label for="tipo">Tipo de usuario:</label>
    <select id="tipo" name="tipo">
      <option value="usuario">Ciudadano</option>
      <option value="voluntario">Voluntario</option>
    </select>

    <button type="submit" class="btn">Enviar</button>
  </form>
</main>
<?php include 'footer.php'; ?>
