const modalProducto = document.getElementById('modalProducto');
const modalEliminar = document.getElementById('modalEliminar');
const formProducto = document.getElementById('formProducto');
const btnAgregar = document.getElementById('agregarProducto');
const btnCancelar = document.getElementById('btnCancelar');
const btnCancelarEliminar = document.getElementById('btnCancelarEliminar');

let productoActual = null;

// Abrir modal para agregar/editar producto
btnAgregar.addEventListener('click', () => {
    document.getElementById('tituloModal').textContent = 'Añadir Producto a [Producto]';
    formProducto.reset();
    productoActual = null;
    modalProducto.style.display = 'flex';
});

// Cerrar modal de producto
btnCancelar.addEventListener('click', () => {
    modalProducto.style.display = 'none';
});

// Cerrar modal de eliminar
btnCancelarEliminar.addEventListener('click', () => {
    modalEliminar.style.display = 'none';
});

// Abrir modal para editar producto
function abrirModalEditar(id) {
    const producto = { id: id, nombre: 'Producto ' + id, descripcion: 'producto numero uno', precio: 10.00, stock: 50 };
    document.getElementById('tituloModal').textContent = 'Editar Producto';
    document.getElementById('nombre').value = producto.nombre;
    document.getElementById('descripcion').value = producto.descripcion;
    document.getElementById('precio').value = producto.precio;
    document.getElementById('stock').value = producto.stock;
    productoActual = producto;
    modalProducto.style.display = 'flex';
}

// Abrir modal para eliminar producto
function abrirModalEliminar(id) {
    productoActual = id;
    modalEliminar.style.display = 'flex';
}
