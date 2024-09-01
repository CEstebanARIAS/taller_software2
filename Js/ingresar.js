document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const cedula = document.getElementById('cedula').value;
    const contraseña = document.getElementById('password').value;

    // Obtener usuarios guardados en localStorage
    let usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];

    // Buscar al usuario con la cédula y contraseña proporcionadas
    const usuario = usuarios.find(user => user.cedula === cedula && user.contraseña === contraseña);

    if (usuario) {
        alert('Bienvenido');
        // Redirigir a la página de inicio o dashboard
        console.log("si inicio sesion")
        window.location.href = 'index.html'; // Ruta correcta para redirigir a la página principal o dashboard
    } else {
        alert('Cédula o contraseña incorrectas');
    }
});
