<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AuxilioCR</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <header class="header">
    <div class="container">
      <a href="#" class="logo">AuxilioCR</a>
      <nav>
        <ul class="nav__list">
          <li><a href="#inicio" class="nav__link">Inicio</a></li>
          <li><a href="#como-funciona" class="nav__link">¿Cómo Funciona?</a></li>
          <li><a href="#features" class="nav__link">Beneficios</a></li>
          <li><a href="#registro" class="nav__link">Registro</a></li>
          <li><a href="#sobreNosotros" class="nav__link">Sobre Nosotros</a></li>
           <li><a href="inicioSesion.html" class="nav__link">Iniciar Sesión</a></li>


        </ul>
      </nav>
    </div>
  </header>

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

  <footer class="footer">
    <div class="container">
      <p>&copy; 2025 AuxilioCR - Universidad Fidélitas</p>
    </div>
  </footer>

  <script>

    document.querySelectorAll('a[href^="#"]').forEach(link => {
      link.addEventListener('click', e => {
        e.preventDefault();
        document.querySelector(link.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });
  </script>
</body>
</html>
