document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const cedula = document.getElementById('cedula').value;
    const contraseña = document.getElementById('password').value; 

        // Validar si las contraseñas coinciden
        if (contraseña !== contraseña) {
            alert('La contraseñas no coincide');
            return; // Detener la ejecución del script
        }
    
    // Guardar los datos en localStorage
    localStorage.setItem('cedula', cedula);
    localStorage.setItem('contraseña', contraseña); 
    alert('Registro exitoso');
    
    // Script_login.js
window.location.href = 'login.html'; // Ruta correcta para redirigir al index principal
});