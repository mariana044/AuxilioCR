<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null;
?>
<?php include 'header.php'; ?>

<main>
  <section id="inicio" class="hero">
    <div class="container">
      <h1>Red Comunitaria de Primeros Auxilios</h1>
      <p>Conectamos personas en emergencia con voluntarios capacitados cerca suyo.</p>
      <a href="#registro" class="btn">Quiero ser voluntario</a>
    </div>
  </section>

  <section id="como-funciona" class="steps">
    <div class="container">
      <h2>¿Cómo funciona?</h2>
      <div class="steps__grid">
        <div class="step">
          <h3>1. Registrate</h3>
          <p>Ingresá tus datos básicos y elegí si querés recibir o brindar ayuda.</p>
        </div>
        <div class="step">
          <h3>2. Conectamos</h3>
          <p>Cuando alguien cerca lo necesita, te notificamos por ubicación.</p>
        </div>
        <div class="step">
          <h3>3. Ayudás</h3>
          <p>Brindás primeros auxilios mientras llega la asistencia oficial.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="features" class="features">
    <div class="container">
      <h2>Beneficios de usar AuxilioCR</h2>
      <div class="features__grid">
        <div class="feature-card">
          <h3>Validación de voluntarios</h3>
          <p>Aseguramos que quienes ayudan tengan conocimientos en primeros auxilios.</p>
        </div>
        <div class="feature-card">
          <h3>Geolocalización segura</h3>
          <p>Encontrá ayuda rápida y segura gracias a nuestra localización inteligente.</p>
        </div>
        <div class="feature-card">
          <h3>Comunicación directa</h3>
          <p>Contactate de inmediato con voluntarios cercanos y disponibles.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="registro" class="registro">
    <div class="container">
      <h2>Registrate como voluntario</h2>
      <a href="registro.php" class="btn">Registrarme</a>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
