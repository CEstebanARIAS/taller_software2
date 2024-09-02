// model.js
document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("taxForm");
  if (form) {
      form.addEventListener("submit", function(event) {
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
      });
  } else {
      console.error("Formulario 'taxForm' no encontrado");
  }
});