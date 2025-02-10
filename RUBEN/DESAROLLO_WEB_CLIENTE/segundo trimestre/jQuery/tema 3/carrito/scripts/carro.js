$(document).ready(function() { 
    var anchoInicial = 480; // 4 artículos * 120 píxeles

    function establece_evento_dblclick_items($items) {
        $items.dblclick(function() {
            var stockElement = $(this).find('.stock');
            var stock = parseInt(stockElement.text().split(' ')[1]);
            if(stock > 0){
                stock--;
                stockElement.text('Stock: ' + stock);

                if(stock == 0){
                    stockElement.addClass('agotado');
                    $(this).unbind('dblclick');
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

                // Actualizar el número de artículos en el carrito
                actualizaNavegacionCarrito();
            }
        });
    }

    establece_evento_dblclick_items($(".item"));

    // Asociar el manejador de eventos para los elementos futuros con la clase 'delete'
    $(document).on('click', '.delete', function(event) {
        event.preventDefault();
        var idPadre = $(this).parent().attr('id');
        var id = idPadre.substring(1);

        var stockElement = $('#' + id).find('.stock');
        var stock = parseInt(stockElement.text().split(' ')[1]);
        stock++;
        stockElement.text('Stock: ' + stock);

        if(stock > 0){
            stockElement.removeClass('agotado');
            establece_evento_dblclick_items($('#' + id));
        }

        $('#citem').val(parseInt($('#citem').val()) - 1);

        var price = parseInt($('#cprice').val().split(' ')[0]);
        var product_price = parseInt($(this).parent().find('.price').text().split(' ')[0]);
        var new_price = price - product_price;

        $('#cprice').val(new_price + ' €');

        $(this).parent().remove();

        // Actualizar el número de artículos en el carrito
        actualizaNavegacionCarrito();
    });

    // Funcionalidad de los botones de navegación
    $('#btn_clear').click(function() {
        $('#cart_items').empty();
        $('#citem').val(0);
        $('#cprice').val('0 €');
        $(".item .stock").each(function() {
            var stock = parseInt($(this).text().split(' ')[1]);
            if(stock == 0) {
                $(this).removeClass('agotado');
                establece_evento_dblclick_items($(this).closest('.item'));
            }
            $(this).text('Stock: 10');
        });

        // Actualizar el número de artículos en el carrito
        actualizaNavegacionCarrito();
    });

    function actualizaNavegacionCarrito() {
        var numArticulosCarrito = $("#cart_items").children().length;
        var anchoCarrito = numArticulosCarrito * 120; // Cada artículo mide 120 píxeles de ancho
    
        if(numArticulosCarrito > 4){
            $("#cart_items").css({
                'width': anchoCarrito + 'px',
                'position': 'relative'
            });
    
            if(!$("#cart_items").css('left')){
                $("#cart_items").css('left', '0px');
            }
    
            $("#btn_prev").off('click').on('click', function() {
                var pos = parseInt($("#cart_items").css('left'));
                if (pos < 0) {
                    $("#cart_items").css('left', Math.min(0, pos + 120) + 'px');
                }
            });
    
            $("#btn_next").off('click').on('click', function() {
                var pos = parseInt($("#cart_items").css('left'));
                var maxDesplazamiento = -(anchoCarrito - anchoInicial);
                if (pos > maxDesplazamiento) {
                    $("#cart_items").css('left', Math.max(maxDesplazamiento, pos - 120) + 'px');
                }
            });
        } else {
            $("#cart_items").css({
                'width': anchoInicial + 'px',
                'left': '0px'
            });
            $("#btn_prev").off('click');
            $("#btn_next").off('click');
        }
    }
    

    // Inicializar la navegación del carrito
    actualizaNavegacionCarrito();
});