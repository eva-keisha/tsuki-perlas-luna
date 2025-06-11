document.addEventListener("DOMContentLoaded", function () {
    fetch("obtener_ventas.php")
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById("ventasTableBody");
            data.forEach(venta => {
                const row = `<tr>
                    <td class="border p-2">${venta.id_venta}</td>
                    <td class="border p-2">${venta.id_cliente}</td>
                    <td class="border p-2">$${venta.total}</td>
                    <td class="border p-2">${venta.metodo_pago}</td>
                    <td class="border p-2">${venta.fecha_venta}</td>
                </tr>`;
                tbody.innerHTML += row;
            });
        })
        .catch(error => console.error("Error al cargar las ventas:", error));
});
