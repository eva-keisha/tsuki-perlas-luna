document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search");
    const tableBody = document.getElementById("proveedorTableBody");

    let proveedores = [];

    // Cargar todos los proveedores al iniciar
    fetch("obtener_proveedores.php")
        .then(response => response.json())
        .then(data => {
            proveedores = data;
            renderProveedores(proveedores);
        });

    // Escuchar el evento input para filtrar
    searchInput.addEventListener("input", function () {
        const query = this.value.toLowerCase();
        const resultados = proveedores.filter(prov => 
            prov.nombre.toLowerCase().includes(query) ||
            prov.telefono.toLowerCase().includes(query) ||
            prov.email.toLowerCase().includes(query) ||
            (prov.materiales && prov.materiales.toLowerCase().includes(query))
        );
        renderProveedores(resultados);
    });

    function renderProveedores(data) {
        tableBody.innerHTML = "";
        data.forEach(proveedor => {
            const row = `
                <tr>
                    <td class="border p-2">${proveedor.id}</td>
                    <td class="border p-2">${proveedor.nombre}</td>
                    <td class="border p-2">${proveedor.telefono}</td>
                    <td class="border p-2">${proveedor.email}</td>
                    <td class="border p-2">${proveedor.direccion}</td>
                    <td class="border p-2">${proveedor.materiales}</td>
                    <td class="flex space-x-2">
                        <a href="editar_proveedor.html?id=${proveedor.id}">
                            <img src="../imagenes/editar_producto.png" alt="Editar" width="30" height="30">
                        </a>
                        <a href="#" onclick="eliminarProveedor(${proveedor.id}); return false;">
                            <img src="../imagenes/eliminar_producto.png" alt="Eliminar" width="30" height="30">
                        </a>
                    </td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });
    }
});
