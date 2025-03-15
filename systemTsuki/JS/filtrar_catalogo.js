document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search");
    const checkboxes = document.querySelectorAll(".categoria");
    const productos = document.querySelectorAll(".producto");

    // Filtrar productos por nombre
    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.toLowerCase();

        productos.forEach(producto => {
            const nombre = producto.querySelector("h3").textContent.toLowerCase();
            producto.style.display = nombre.includes(searchTerm) ? "block" : "none";
        });
    });

    // Filtrar productos por categoría
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            filtrarProductos();
        });
    });

    function filtrarProductos() {
        const categoriasSeleccionadas = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        productos.forEach(producto => {
            const categoriaProducto = producto.getAttribute("data-categoria");
            
            // Mostrar si la categoría está seleccionada o si no hay filtros activos
            if (categoriasSeleccionadas.length === 0 || categoriasSeleccionadas.includes(categoriaProducto)) {
                producto.style.display = "block";
            } else {
                producto.style.display = "none";
            }
        });
    }
});
