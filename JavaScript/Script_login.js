document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const nombre = document.getElementById('nombre').value;
    const apellidos = document.getElementById('apellidos').value;
    const cedula = document.getElementById('cedula').value;
    const celular = document.getElementById('celular').value;
    
    // Guardar los datos en localStorage
    localStorage.setItem('nombre', nombre);
    localStorage.setItem('apellidos', apellidos);
    localStorage.setItem('cedula', cedula);
    localStorage.setItem('celular', celular);
    
    alert('Registro exitoso');
    window.location.href = 'Index/index.html';
});