$(document).ready(function () {
    $("#searchInput").on("keyup", function () {
        let texto = $(this).val().trim();
        let contenedor = $("#suggestionsContainer");

        if (texto.length < 1) {
            contenedor.hide().html("");
            return;
        }

        fetch("/home/buscar", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ texto })
        })
        .then(res => res.json())
        .then(data => {

            contenedor.html("").show();

            if (data.data.length === 0) {
                contenedor.append(`<p class="no-results">Sin resultados</p>`);
                return;
            }

            data.data.forEach(p => {

                contenedor.append(`
                    <a class="suggest-item" href="/producto/categoria/${p.category}" style="display:flex; alig-items:center; gap:20px;">
                        <img src="/assets/img/products/${p.image}" class="suggest-img" style="width:40px;">
                        <div class="suggest-info">
                            <span class="suggest-name">${p.name}</span>
                            <span class="suggest-price">$${p.price}</span>
                        </div>
                    </a>
                `);
            });

        })
        .catch(err => console.error("Error en búsqueda:", err));
    });

    // Ocultar sugerencias cuando pierda el foco
    $(document).click(function (e) {
        if (!$(e.target).closest(".header-top-center").length) {
            $("#suggestionsContainer").hide();
        }
    });

});
