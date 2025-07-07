// Datos simulados
const voluntarios = [
  { nombre: "Carlos", tipo: "Socorrista", estado: "Aprobado" },
  { nombre: "Laura", tipo: "Básico", estado: "Pendiente" },
  { nombre: "María", tipo: "Paramédico", estado: "Rechazado" }
];

function cargarVoluntarios() {
  const tabla = document.getElementById("tablaVoluntarios");
  tabla.innerHTML = "";

  voluntarios.forEach((v, i) => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${v.nombre}</td>
      <td>${v.tipo}</td>
      <td id="estado-${i}">${v.estado}</td>
      <td>
        <select onchange="cambiarEstado(${i}, this.value)">
          <option value="">--Cambiar--</option>
          <option value="Aprobado">Aprobar</option>
          <option value="Pendiente">Pendiente</option>
          <option value="Rechazado">Rechazar</option>
        </select>
      </td>
    `;
    tabla.appendChild(row);
  });
}

function cambiarEstado(index, nuevoEstado) {
  voluntarios[index].estado = nuevoEstado;
  document.getElementById(`estado-${index}`).textContent = nuevoEstado;
}

function mostrarEstadisticas() {
  const div = document.getElementById("estadisticaEmergencias");
  div.innerHTML = `
    <p>Total de emergencias atendidas: 42</p>
    <p>Zonas con más reportes: San José, Alajuela</p>
  `;
}

function controlUsuarios() {
  const div = document.getElementById("controlUsuariosResultado");
  div.innerHTML = `
    <p>Usuarios activos: 25</p>
    <p>Usuarios bloqueados: 3</p>
    <button onclick="alert('Redirigir a configuración avanzada')">Ver más</button>
  `;
}

window.onload = cargarVoluntarios;
