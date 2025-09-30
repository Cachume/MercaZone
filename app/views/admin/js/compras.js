// Abrir la ventana de detalles de la compra
document.querySelectorAll('.ver-detalle').forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('ventanaModalDetalles').style.display = 'block';
    });
});

// Cerrar la ventana de detalles
document.querySelector('#ventanaModalDetalles .cerrar-modal').addEventListener('click', function() {
    document.getElementById('ventanaModalDetalles').style.display = 'none';
});

// Abrir la ventana para aceptar la compra
document.querySelectorAll('.aceptar-compra').forEach(function(button) {
    button.addEventListener('click', function() {
        document.getElementById('ventanaModalAceptar').style.display = 'block';
    });
});

// Cerrar la ventana de aceptar
document.querySelector('#ventanaModalAceptar .cerrar-modal').addEventListener('click', function() {
    document.getElementById('ventanaModalAceptar').style.display = 'none';
});

// Abrir la ventana modal para rechazar la compra
document.querySelectorAll('.rechazar-compra').forEach(function(button) {
    button.addEventListener('click', function() {
        document.getElementById('ventanaModalRechazar').style.display = 'block';
    });
});

// Cerrar la ventana modal de rechazar
document.querySelector('#ventanaModalRechazar .cerrar-modal').addEventListener('click', function() {
    document.getElementById('ventanaModalRechazar').style.display = 'none';
});



