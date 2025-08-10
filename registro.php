<?php
include 'header.php';
?>
<main class="form-section">
  <h2>Registrarse</h2>
  <form method="post" action="procesarRegistro.php">
    <label for="nombre">Nombre completo:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="correo">Correo electrónico:</label>
    <input type="email" id="correo" name="correo" required>

    <label for="contraseña">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required>

    <label for="tipo_usuario">Tipo de usuario:</label>
    <select id="tipo_usuario" name="tipo_usuario">
      <option value="ciudadano">Ciudadano</option>
      <option value="voluntario">Voluntario</option>
       <option value="admin">Admin</option>
    </select>

    <button type="submit" class="btn">Registrarme</button>
  </form>
</main>
<?php include 'footer.php'; ?>


