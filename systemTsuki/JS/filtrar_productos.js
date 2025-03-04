document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search");
    let allProducts = [];
    let currentPage = 1;
    const itemsPerPage = 5;
    let products = [];

    function fetchProducts() {
        fetch("obtener_productos.php")
            .then(response => response.json())
            .then(data => {
                allProducts = data;
                renderTable(allProducts);
            });
    }

    function renderTable(products) {
        const tableBody = document.getElementById("productTableBody");
        tableBody.innerHTML = "";
        
        products.forEach(product => {
            const row = `<tr>
                <td class='border p-2'>${product.id_producto}</td>
                <td class='border p-2'>${product.nombre_producto}</td>
                <td class='border p-2'>${product.descripcion}</td>
                <td class='border p-2'>$${product.precio}</td>
                <td class='border p-2'>${product.stock}</td>
                <td class='border p-2'>${product.categoria}</td>
                <td class='border p-2'>
                    ${product.imagen ? `<img src="${product.imagen}" width="50" class="clickable-image cursor-pointer">` : ""}
                </td>
                <td class='flex space-x-2'>
                    <a href='../modulo_inventario/editar_producto.html?id=${product.id_producto}'>
                        <img src='../imagenes/editar_producto.png' alt='Editar' width='30' height='30'>
                    </a>
                    <a href='#' onclick='eliminarProducto(${product.id_producto}); return false;'>
                        <img src='../imagenes/eliminar_producto.png' alt='Eliminar' width='30' height='30'>
                    </a>
                </td>
            </tr>`;
            tableBody.innerHTML += row;
        });
    }

    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.toLowerCase();
        const filteredProducts = allProducts.filter(product => 
            product.nombre_producto.toLowerCase().includes(searchTerm) ||
            product.precio.toString().includes(searchTerm) ||
            product.categoria.toLowerCase().includes(searchTerm)
        );
        renderTable(filteredProducts);
    });

    fetchProducts();
});
