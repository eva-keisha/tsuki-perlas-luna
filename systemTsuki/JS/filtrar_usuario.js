document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search");
    let allusuarios = [];
    let currentPage = 1;
    const itemsPerPage = 5;
    let usuarios = [];


    function fetchUsuarios() {
        fetch("obtener_usuarios.php")
            .then(response => response.json())
            .then(data => {
                allusuarios = data;
                renderTable(allusuarios);
            });
    }
    
    function renderTable(usuarios) {
      
        
        const tableBody = document.getElementById("usuarioTableBody");
        tableBody.innerHTML = "";
        
        usuarios.forEach(usuario => {
            const row = `<tr>
                <td class='border p-2'>${usuario.id_usuario}</td>
                <td class='border p-2'>${usuario.nombre_usuario}</td>
                <td class='border p-2'>${usuario.correo}</td>
                  <td class="border p-2">******</td>
                <td class='border p-2'>${usuario.rol}</td>
                <td class='flex space-x-2'>
                    <a href='editar_usuarios.html?id=${usuario.id_usuario}'>
                        <img src='../imagenes/editar-cuenta.png' alt='Editar' width='30' height='30'>
                    </a>
                    <a href='#' onclick='eliminarUsuario(${usuario.id_usuario}); return false;'>
                        <img src='../imagenes/borrar_cuenta.png' alt='Eliminar' width='30' height='30'>
                    </a>
                </td>
            </tr>`;
            tableBody.innerHTML += row;
        });
    }




    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.toLowerCase();
        const filteredusuarios = allusuarios.filter(usuario => 
            usuario.rol.toLowerCase().includes(searchTerm)
        );
        renderTable(filteredusuarios);
    });

    

    fetchUsuarios();
});
