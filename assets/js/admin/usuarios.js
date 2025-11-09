$(document).ready(function(){
    fetch(`/admin/getUsers`)
        .then(response => response.json())
        .then(data => {
            if(data.success === true){
                console.log(data)
                const productsTableBody = $('#products-table-body');
                productsTableBody.empty(); // Limpiar la tabla antes de agregar nuevos productos
                data.product.forEach(product => {
                    const productRow = `
                        <tr>
                            <td>${product.nombre}</td>
                            <td>${product.apellidos}</td>
                            <td>${product.correo}</td>
                            <td>${product.cedula}</td>
                            <td>${product.rol_name}</td>
                        </tr>
                    `;
                    productsTableBody.append(productRow);
                });
            }
        })
        .catch(error => {
            console.error('Error al cargar los Usuarios:', error);
            Swal.fire({
                icon: 'error',
                position : 'top-end',
                title: 'Error',
                text: 'No se pudieron cargar los Usuarios.',
                showConfirmButton: false,
                timer: 1500
            })//.then(() => {location.reload();});
        });

})