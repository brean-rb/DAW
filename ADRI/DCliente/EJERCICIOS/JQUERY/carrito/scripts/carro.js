$(function () {
    var precioElemento = 0;

    $(".item").dblclick(function () {
        var cantidadStock = $(this).find(".stock");
        var cantidadCad = cantidadStock.text().split(" ");
        var cantidad = parseInt(cantidadCad[1]);
        var carroCant = parseInt($("#citem").val());
        if (cantidad > 0) {
            cantidad--;
            carroCant++;
            precioElemento += parseInt($(this).find(".price").text());
            cantidadStock.text("Stock " + cantidad);
            $("#citem").val(carroCant.toString());
            $("#cprice").val(precioElemento.toString() + " €");
            if (cantidad == 0) {
                cantidadStock.addClass("agotado");
            }

            var producto = $(this).clone();
            producto.attr('id', 'c' + $(this).attr("id"));
            producto.find('stock').hide();
            producto.css('cursor', 'default');
            var $delete = $('<a href="" class="delete"></a>');
            producto.prepend($delete)
            $("#cart_items").prepend(producto);
        }

        $delete.click(function () {
            var stockdelElemento = $("#" + producto.attr("id")).find('.stock');
            var cantidad = parseInt(stockdelElemento.text().split(' ')[1]);
            cantidad++;
            stockdelElemento.text("Stock " + cantidad);
            if (cantidad > 0) {
                precioElemento -= parseInt($(this).parent().find(".price").text());
                cantidadStock.removeClass("agotado");
            }
            $('#citem').val(parseInt($("#citem").val()) - 1);

            var precio = parseInt($('#cprice').val().split(' ')[0]);
            var prodprecio = parseInt($(this).parent().find('.price').text().split(' ')[0]);
            var finprecio = precio - prodprecio;

            $('#cprice').val(finprecio + ' €');

            $(this).parent().remove();

            return false;
        });
    });

});