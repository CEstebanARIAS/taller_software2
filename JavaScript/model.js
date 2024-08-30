<<<<<<< HEAD
function luisito(){
print('luissssss')
}

function otraFuncion(){
    print('mensaje');
    print('Segundo Mensaje')
}

function unoDOS(){
print("nooooooooooo")
print('Hola Como estan')
print('Arias Gaste Tinto')
print('mañana tomamos tinto')

function arias(){
    print('ariassss Gaste Tinto')
    print("djskjdskfjsdfjlsd")
    print('Hola')
}
}
=======
document.getElementById('taxForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const patrimonio = parseFloat(document.getElementById('patrimonio').value);
    const ingresos = parseFloat(document.getElementById('ingresos').value);
    const tarjeta = parseFloat(document.getElementById('tarjeta').value);
    const compras = parseFloat(document.getElementById('compras').value);
    const consignaciones = parseFloat(document.getElementById('consignaciones').value);
    
    const topePatrimonio = 190854000;
    const topeIngresos = 59377000;
    const topeTarjeta = 59377000;
    const topeCompras = 59377000;
    const topeConsignaciones = 59377000;
    
    let debeDeclarar = false;
    
    if (patrimonio >= topePatrimonio || ingresos >= topeIngresos || tarjeta >= topeTarjeta || compras >= topeCompras || consignaciones >= topeConsignaciones) {
        debeDeclarar = true;
    }
    
    const resultDiv = document.getElementById('result');
    if (debeDeclarar) {
        resultDiv.textContent = 'Debes declarar renta.';
    } else {
        resultDiv.textContent = 'No debes declarar renta.';
    }
});
>>>>>>> fe1406d2411087edaf7433d26fa16f2d8e8610ae
