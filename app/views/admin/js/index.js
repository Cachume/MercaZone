// Abrir y cerrar la barra lateral
document.getElementById('botonMenu').addEventListener('click', function () {

    var barraLateral = document.getElementById('barraLateral');
    var fondoOscuro = document.getElementById('fondoOscuro');

    if (barraLateral.style.left === '-250px' || barraLateral.style.left === '') {

        barraLateral.style.left = '0px'; // Abre la barra lateral
        fondoOscuro.style.display = 'block';

    } else {
        
        barraLateral.style.left = '-250px'; // Cierra la barra lateral
        fondoOscuro.style.display = 'none';
    }
});

// Cerrar la barra lateral al hacer clic por fuera de la barra lateral 
//funcionalidad para movil
document.getElementById('fondoOscuro').addEventListener('click', function () {

    var barraLateral = document.getElementById('barraLateral');
    var fondoOscuro = document.getElementById('fondoOscuro');

    barraLateral.style.left = '-250px'; // Cierra la barra lateral
    fondoOscuro.style.display = 'none'; 

});