$(function () {
    $("#formCotizador").on("submit", function (e) {
        e.preventDefault();
        SlickLoader.setText("Procesando...");
        SlickLoader.enable();
        $.ajax({
            type: "GET",
            url: "/cotizador",
            data: {
                cp_origen: $("#cp_origen").val(),
                cp_destino: $("#cp_destino").val(),
                kilos: $("#kilos").val(),
            },
            success: function (res) {
                console.log(res, res.destino);
                $("#monto").html("$" + res.total);
                $("#peso").html(res.peso);
                $("#origen").html(res.origen);
                $("#destino").html(res.destino);
                SlickLoader.disable();

                $("#modalCotizador").modal("show");
            },
            error: function (xhr, status, error) {
                toastr.error(
                    "Se produjo un error al intentar obtener la cotización."
                );
                SlickLoader.disable();

            },
        });
    });
});
