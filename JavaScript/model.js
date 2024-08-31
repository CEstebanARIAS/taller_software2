// Función para manejar el formulario de declaración de renta
function handleTaxForm(event) {
    event.preventDefault();
  
    const patrimonio = parseFloat(document.getElementById("patrimonio").value);
    const ingresos = parseFloat(document.getElementById("ingresos").value);
    const tarjeta = parseFloat(document.getElementById("tarjeta").value);
    const compras = parseFloat(document.getElementById("compras").value);
    const consignaciones = parseFloat(document.getElementById("consignaciones").value);
  
    const topePatrimonio = 190854000;
    const topeIngresos = 59377000;
    const topeTarjeta = 59377000;
    const topeCompras = 59377000;
    const topeConsignaciones = 59377000;
  
    let debeDeclarar = false;
  
    if (
      patrimonio >= topePatrimonio ||
      ingresos >= topeIngresos ||
      tarjeta >= topeTarjeta ||
      compras >= topeCompras ||
      consignaciones >= topeConsignaciones
    ) {
      debeDeclarar = true;
    }
  
    const resultDiv = document.getElementById("result");
    if (debeDeclarar) {
      resultDiv.textContent = "Debes declarar renta.";
    } else {
      resultDiv.textContent = "No debes declarar renta.";
    }
  }
  
  // Función para manejar el formulario de login
  function handleLoginForm(event) {
    event.preventDefault();
    const cedula = document.getElementById('loginCedula').value;
    const celular = document.getElementById('loginCelular').value;
    fetch('/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        cedula: cedula,
        celular: celular
      })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        window.location.href = '/inicio';
      } else {
        alert('Credenciales incorrectas');
      }
    })
    .catch(error => console.error('Error:', error));
  }
  
  // Función para manejar el formulario de registro
  function handleRegisterForm(event) {
    event.preventDefault();
    const nombre = document.getElementById('nombre').value;
    const apellidos = document.getElementById('apellidos').value;
    const cedula = document.getElementById('cedula').value;
    const celular = document.getElementById('celular').value;
    fetch('/register', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        nombre: nombre,
        apellidos: apellidos,
        cedula: cedula,
        celular: celular
      })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        window.location.href = '/inicio';
      } else {
        alert('Error al registrar usuario');
      }
    })
    .catch(error => console.error('Error:', error));
  }
  
  // Agregar eventos de envío de formularios
  document.getElementById("taxForm").addEventListener("submit", handleTaxForm);
  document.getElementById("loginForm").addEventListener("submit", handleLoginForm);
  document.getElementById("registerForm").addEventListener("submit", handleRegisterForm);