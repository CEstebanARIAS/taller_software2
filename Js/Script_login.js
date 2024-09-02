document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const nombre = document.getElementById('nombre').value;
    const apellidos = document.getElementById('apellidos').value;
    const cedula = document.getElementById('cedula').value;
    const celular = document.getElementById('celular').value;
    const contraseña = document.getElementById('password').value; 
    const contraseñaConf = document.getElementById('confPassword').value;

    // Validar si todos los campos están completos
    if (!nombre || !apellidos || !cedula || !celular || !contraseña || !contraseñaConf) {
        alert('Por favor, completa todos los campos.');
        return;
    }

    // Validar si las contraseñas coinciden
    if (contraseña !== contraseñaConf) {
        alert('Las contraseñas no coinciden. Por favor, verifica e intenta nuevamente.');
        return; // Detener la ejecución del script
    }

    // Obtener usuarios guardados en localStorage
    let usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];

    // Verificar si la cédula ya está registrada
    const cedulaExistente = usuarios.find(user => user.cedula === cedula);
    if (cedulaExistente) {
        alert('La cédula ya está registrada. Por favor, usa otra.');
        return; // Detener la ejecución del script
    }

    // Crear un objeto usuario
    const usuario = {
        nombre: nombre,
        apellidos: apellidos,
        cedula: cedula,
        celular: celular,
        contraseña: contraseña
    };

    // Agregar el nuevo usuario al array de usuarios
    usuarios.push(usuario);

    // Guardar el array actualizado en localStorage
    localStorage.setItem('usuarios', JSON.stringify(usuarios));

    alert('Registro exitoso');
    
    // Redirigir al index principal
    window.location.href = 'registar.html';
});
