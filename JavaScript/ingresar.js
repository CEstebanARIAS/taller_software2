// ingresar.js
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const cedula = document.getElementById('cedula').value;
    const contraseña = document.getElementById('password').value;

    // Validar si la cédula y la contraseña están presentes
    if (!cedula || !contraseña) {
        alert('Por favor, completa todos los campos.');
        return; // Detener la ejecución del script
    }
    
    // Guardar los datos en localStorage
    localStorage.setItem('cedula', cedula);
    localStorage.setItem('contraseña', contraseña); 
    alert('Bienvenido');
    
    // Redirigir al index principal
    window.location.href = 'index.html'; // Ruta correcta para redirigir al index principal
});