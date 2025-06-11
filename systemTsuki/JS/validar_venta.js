document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("formVenta");

    form.addEventListener("submit", (e) => {
        const cliente = document.getElementById("id_cliente").value;
        const total = parseFloat(document.getElementById("total").value);
        const metodo = document.getElementById("metodo_pago").value;
        const fecha = document.getElementById("fecha_venta").value;

        if (!cliente || !metodo || !fecha || isNaN(total) || total <= 0) {
            e.preventDefault();
            alert("Por favor completa todos los campos correctamente.");
        }
    });
});
