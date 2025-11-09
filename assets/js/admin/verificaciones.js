$(document).ready(function(){
    fetch(`/admin/getVerificaciones`)
        .then(response => response.json())
        .then(data => {
            if(data.success === true){
                console.log(data)
                const productsTableBody = $('#products-table-body');
                productsTableBody.empty(); 
                data.product.forEach(product => {
                    const productRow = `
                        <tr>
                            <td>${product.correo}</td>
                            <td>${product.type_dni}</td>
                            <td>${product.cedula}</td>
                            <td>${product.estado}</td>
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