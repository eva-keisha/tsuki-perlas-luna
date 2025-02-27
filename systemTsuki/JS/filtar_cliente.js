document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search");
    let allCliente= [];
   
    let currentPage = 1;
    const itemsPerPage = 5;
    let clientes = [];
    
    function fetchClientes() {
        fetch("obtener_clientes.php")
            .then(response => response.json())
            .then(data => {
                allCliente = data;
                renderTable(allCliente);
            });
    }
    
    function renderTable(clientes) {
     
        const tableBody = document.getElementById("clienteTableBody");
        tableBody.innerHTML = "";
        
        clientes.forEach(cliente => {
            const row = `<tr>
                <td class='border p-2'>${cliente.id_cliente}</td>
                <td class='border p-2'>${cliente.nombre_cliente}</td>
                <td class='border p-2'>${cliente.correo}</td>
                  <td class="border p-2">${cliente.telefono}</td>
                <td class='border p-2'>${cliente.direccion}</td>
                <td class='flex space-x-2'>
                    <a href='editar_cliente.html?id=${cliente.id_cliente}'>
                        <img src='../imagenes/editar-cuenta.png' alt='Editar' width='30' height='30'>
                    </a>
                    <a href='#' onclick='eliminarCliente(${cliente.id_cliente}); return false;'>
                        <img src='../imagenes/borrar_cuenta.png' alt='Eliminar' width='30' height='30'>
                    </a>
                </td>
            </tr>`;
            tableBody.innerHTML += row;
        });
    }
    

    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.toLowerCase();
        const filteredclientes = allCliente.filter(cliente => 
            cliente.nombre_cliente.toLowerCase().includes(searchTerm)
        );
        renderTable(filteredclientes);
    });

    

    fetchClientes();
});
