CREATE DATABASE taller_software2; 

CREATE TABLE usuarios (     
    id INT AUTO_INCREMENT PRIMARY KEY,     
    nombre VARCHAR(100) NOT NULL,     
    apellidos VARCHAR(100) NOT NULL,     
    cedula VARCHAR(20) NOT NULL UNIQUE,     
    celular VARCHAR(20),     
    contraseña VARCHAR(255) NOT NULL 
    ); 
    
    CREATE TABLE declaraciones (     
        id INT AUTO_INCREMENT PRIMARY KEY,     
        usuario_id INT,     patrimonio DECIMAL(15,2),     
        ingresos DECIMAL(15,2),     tarjeta DECIMAL(15,2),     
        compras DECIMAL(15,2),     consignaciones DECIMAL(15,2),     
        debe_declarar BOOLEAN,     
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id) 
        );