document.getElementById('botonEmergencia').addEventListener('click', function () {
  const estado = document.getElementById('estado');
  estado.textContent = "Obteniendo ubicación...";

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
      const lat = position.coords.latitude;
      const lon = position.coords.longitude;

    
      fetch('emergencia.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `latitud=${lat}&longitud=${lon}`
      })
      .then(res => res.text())
      .then(data => estado.textContent = data)
      .catch(err => estado.textContent = "Error al enviar emergencia");
    }, () => {
      estado.textContent = "No se pudo obtener la ubicación";
    });
  } else {
    estado.textContent = "Geolocalización no disponible";
  }
});
