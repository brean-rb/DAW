$(document).ready(function() {
    var posInicial = 0;
    var anchoInicial = 480;
    
    $(".item").on("dblclick.anadir", function() {
        var stockElement = $(this).find('.stock');
        var stock = parseInt(stockElement.text().split(' ')[1]);
        if(stock > 0){
            stock--;
            stockElement.text('Stock: ' + stock);

            if(stock == 0){
                stockElement.addClass('agotado');
            }

            $('#citem').val(parseInt($('#citem').val()) + 1);

            var price = parseInt($('#cprice').val().split(' ')[0]);
            var product_price = parseInt($(this).find('.price').text().split(' ')[0]);
            var new_price = price + product_price;

            $('#cprice').val(new_price + ' €');

            var item = $(this).clone();
            item.attr('id', 'c' + $(this).attr('id'));
            item.find('.stock').hide();
            item.css('cursor', 'default');

            var $delete = $('<a href="" class="delete"></a>');
            item.prepend($delete);
            $('#cart_items').prepend(item);

            update_desplazamiento();
        }
    });

    $(document).on('click.borrar', '.delete', function(event) {
        event.preventDefault();
        var idPadre = $(this).parent().attr('id');
        var id = idPadre.substring(1);

        var stockElement = $('#' + id).find('.stock');
        var stock = parseInt(stockElement.text().split(' ')[1]);
        stock++;
        stockElement.text('Stock: ' + stock);

        if(stock > 0){
            stockElement.removeClass('agotado');
            $(".item").on("dblclick.anadir");
        } else{
            stockElement.addClass('agotado');
            $(".item").off("dblclick.anadir");
        }

        $('#citem').val(parseInt($('#citem').val()) - 1);

        var price = parseInt($('#cprice').val().split(' ')[0]);
        var product_price = parseInt($(this).parent().find('.price').text().split(' ')[0]);
        var new_price = price - product_price;

        $('#cprice').val(new_price + ' €');

        $(this).parent().remove();

        update_desplazamiento();
    });

    $("#btn_clear").click(function() {
        $(".item a.delete").trigger('click.borrar');
    });


    function update_desplazamiento(){
        var numArticulosCarrito = $("#cart_items").children().length;
        var ancho_carrito = numArticulosCarrito * 120;

        $("#cart_items").css('width', ancho_carrito + "px");

        if(numArticulosCarrito > 4){
            $("#btn_prev").click( function() {
                var pos = $("#cart_items").offset();
                if (pos.left < posInicial) {
                    pos.left += 50;
                    $("#cart_items").offset(pos);
                }
            });

            $("#btn_next").off().on("click", function() {
                var pos = $("#cart_items").offset();
                var maxDesplazamiento = (anchoInicial - anchoCarrito);
                if (pos.left > maxDesplazamiento) {
                    pos.left -= 50;
                    $("#cart_items").offset(pos);
                }
            });
        } else{
            $("#btn_prev").off();
            $("#btn_next").off();
        }
    }

    update_desplazamiento();
});