document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const nombre = document.getElementById('nombre').value;
    const apellidos = document.getElementById('apellidos').value;
    const cedula = document.getElementById('cedula').value;
    const celular = document.getElementById('celular').value;
    const contraseña = document.getElementById('password').value; 
    const contraseñaConf = document.getElementById('confPassword').value;

        // Validar si las contraseñas coinciden
        if (contraseña !== contraseñaConf) {
            alert('Las contraseñas no coinciden. Por favor, verifica e intenta nuevamente.');
            return; // Detener la ejecución del script
        }
    
    // Guardar los datos en localStorage
    localStorage.setItem('nombre', nombre);
    localStorage.setItem('apellidos', apellidos);
    localStorage.setItem('cedula', cedula);
    localStorage.setItem('celular', celular);
    localStorage.setItem('contraseña', contraseña); 
    localStorage.setItem('confirmarContraseña', contraseñaConf);
    alert('Registro exitoso');
    
    // Script_login.js
window.location.href = 'index.html'; // Ruta correcta para redirigir al index principal
});