const form = document.getElementById('loginForm');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const emailError = document.getElementById('emailError');
const passwordError = document.getElementById('passwordError');

form.addEventListener('submit', function (e) {
  let valid = true;


  const emailValue = emailInput.value.trim();
  if (!emailValue || !emailValue.includes('@')) {
    emailError.style.display = 'block';
    valid = false;
  } else {
    emailError.style.display = 'none';
  }
  
  const passwordValue = passwordInput.value.trim();
  if (!passwordValue || passwordValue.length < 6) {
    passwordError.style.display = 'block';
    valid = false;
  } else {
    passwordError.style.display = 'none';
  }

  if (!valid) {
    e.preventDefault();
  } else {
    alert('Formulario válido, enviando...');
  }
});
