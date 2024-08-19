document.addEventListener('DOMContentLoaded', function () {

	let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
	actualizarContadorCarrito();
	
	document.querySelectorAll('.btn-outline-dark').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const producto = this.closest('.card');
            const id = producto.getAttribute('data-id');
            const nombre = producto.querySelector('.fw-bolder').textContent;
            const precio = producto.querySelector('.precio').textContent;
            const imagen = producto.querySelector('.image').getAttribute('src');

            const productoEnCarrito = carrito.find(item => item.id === id);

            if (productoEnCarrito) {
                productoEnCarrito.cantidad += 1;
            } else {
                carrito.push({ id, nombre, precio, imagen, cantidad: 1 });
            }

            localStorage.setItem('carrito', JSON.stringify(carrito));
            actualizarContadorCarrito();
        });
});

function actualizarContadorCarrito() {
	const contador = carrito.reduce((acc, producto) => acc + producto.cantidad, 0);
	const contadorElemento = document.getElementById('contador-productos');
	if (contadorElemento) {
		contadorElemento.textContent = contador;
	} else {
		console.error('Elemento con ID "contador-productos" no encontrado.');
	}
}
function mostrarProductosEnCarrito() {
	const listaCarrito = document.getElementById('lista-carrito');
	listaCarrito.innerHTML = ''; // Limpiar la tabla antes de agregar los productos

	carrito.forEach(producto => {
		const row = document.createElement('tr');

		// Imagen del producto
		const imgCell = document.createElement('td');
		const imgElement = document.createElement('img');
		imgElement.src = producto.imagen;
		imgElement.style.width = '50px';
		imgElement.style.height = 'auto';
		imgCell.appendChild(imgElement);
		row.appendChild(imgCell);

		// Nombre del producto
		const nameCell = document.createElement('td');
		nameCell.textContent = producto.nombre;
		row.appendChild(nameCell);

		// Precio del producto
		const priceCell = document.createElement('td');
		priceCell.textContent = `${producto.precio}`;
		row.appendChild(priceCell);

		// Cantidad del producto
		const qtyCell = document.createElement('td');
		qtyCell.textContent = producto.cantidad;
		row.appendChild(qtyCell);

		// Total del producto
		const totalCell = document.createElement('td');
		const totalPrice = (parseFloat(producto.precio.replace('$', '')) * producto.cantidad).toFixed(2);
		totalCell.textContent = `$${totalPrice}`;
		row.appendChild(totalCell);

		// Acciones (botón para eliminar)
		const actionCell = document.createElement('td');
		const removeButton = document.createElement('button');
		removeButton.className = 'btn btn-danger btn-sm remove-product';
		removeButton.setAttribute('data-id', producto.id);
		removeButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
		actionCell.appendChild(removeButton);
		row.appendChild(actionCell);

		// Agregar la fila a la tabla
		listaCarrito.appendChild(row);
	});

	// Añadir funcionalidad de eliminación a los botones
	document.querySelectorAll('.remove-product').forEach(button => {
		button.addEventListener('click', function () {
			const id = this.getAttribute('data-id');
			const producto = carrito.find(producto => producto.id === id);

			if (producto.cantidad > 1) {
				producto.cantidad -= 1; // Reducir la cantidad
			} else {
				carrito = carrito.filter(producto => producto.id !== id); // Eliminar el producto si la cantidad es 1
			}

			localStorage.setItem('carrito', JSON.stringify(carrito));
			actualizarContadorCarrito();
			mostrarProductosEnCarrito(); // Refrescar la lista
		});
	});
}
	// Añadir funcionalidad de eliminación a los botones
	document.querySelectorAll('.remove-product').forEach(button => {
		button.addEventListener('click', function () {
			const id = this.getAttribute('data-id');
			carrito = carrito.filter(producto => producto.id !== id);
			localStorage.setItem('carrito', JSON.stringify(carrito));
			actualizarContadorCarrito();
			mostrarProductosEnCarrito(); // Refrescar la lista
		});
	});


	// Add event listener to remove buttons
	document.querySelectorAll('.remove-product').forEach(button => {
		button.addEventListener('click', function () {
			const id = this.getAttribute('data-id');
			carrito = carrito.filter(producto => producto.id !== id);
			localStorage.setItem('carrito', JSON.stringify(carrito));
			actualizarContadorCarrito();
			mostrarProductosEnCarrito(); // Refresh the list
		});
	});


function eliminarProductoDelCarrito(index) {
    carrito.splice(index, 1); // Elimina el producto del carrito
    mostrarProductosEnCarrito(); // Actualiza la vista del carrito
}

window.openCartModal = function () {
var myModal = new bootstrap.Modal(document.getElementById('carritoModal'), {
	keyboard: true // No permitir que el modal se cierre con la tecla Esc
});
myModal.show();
mostrarProductosEnCarrito();
};

function generarOrden() {
    // Retrieve cart from localStorage
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    // Check if there are products in the cart
    if (carrito.length === 0) {
        alert('El carrito está vacío.');
        return;
    }
    
    // Prepare data to be sent to the server
    let productos = carrito.map(producto => ({
        id: producto.id,
        cantidad: producto.cantidad,
        precio: parseFloat(producto.precio.replace('$', ''))
    }));
	console.log(productos);
    
    // Create a form and submit it to the server
    let form = document.createElement('form');
    form.method = 'POST';
    form.action = generateOrderUrl; // Use the URL from the Blade template
    
    // Add CSRF token
    let csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = document.querySelector('meta[name="csrf-token"]').content;
    form.appendChild(csrfInput);
    
    // Add products data
    let productosInput = document.createElement('input');
    productosInput.type = 'hidden';
    productosInput.name = 'productos';
    productosInput.value = JSON.stringify(productos);
    form.appendChild(productosInput);
    
    document.body.appendChild(form);
    form.submit();
    // Clear localStorage after the form submission
    localStorage.removeItem('carrito');

    // Optionally, clear the cart display in the UI
    document.getElementById('lista-carrito').innerHTML = '';
    // Fetch and handle the response
    fetch(generateOrderUrl, {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
		},
		body: JSON.stringify({ productos: carrito })
	})
	.then(response => response.json())
.then(data => {
    if (data.redirect_url) {
        window.location.href = data.redirect_url;
    } else if (data.message) {
        // Mostrar el error en una ventana emergente
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: data.message
        });
    }
})
.catch(error => {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Ocurrió un error inesperado.'
    });
    console.error('Error:', error);
});
}

document.getElementById('generarOrdenButton').addEventListener('click', function() {
    generarOrden();
});



}
);



