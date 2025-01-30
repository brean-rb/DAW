$(function() {
    function establece_evento_dblclick_items($items) {
        $items.dblclick(function() {
            var stockElement = $(this).find('.stock');
            var stock = parseInt(stockElement.text().split(' ')[1]);
            if (stock > 0) {
                stock--;
                stockElement.text('Stock: ' + stock);

                if (stock == 0) {
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

                $delete.on("click", function() {
                    var idPadre = $(this).parent().attr('id');
                    var id = idPadre.substring(1);

                    var stockElement = $('#' + id).find('.stock');
                    var stock = parseInt(stockElement.text().split(' ')[1]);
                    stock++;
                    stockElement.text('Stock: ' + stock);

                    if (stock > 0) {
                        stockElement.removeClass('agotado');
                        establece_evento_dblclick_items($('#' + id));
                    }

                    $('#citem').val(parseInt($('#citem').val()) - 1);

                    var price = parseInt($('#cprice').val().split(' ')[0]);
                    var product_price = parseInt($(this).parent().find('.price').text().split(' ')[0]);
                    var new_price = price - product_price;

                    $('#cprice').val(new_price + ' €');

                    $(this).parent().remove();

                    return false;
                });
            }
        });
    }

    establece_evento_dblclick_items($(".item"));

    $('#btn_clear').click(function() {
        $('#cart_items').empty();
        $('#citem').val(0);
        $('#cprice').val('0 €');
        $('.item .stock').each(function() {
            var stockElement = $(this);
            var stock = parseInt(stockElement.text().split(' ')[1]);
            if (stock == 0) {
                stockElement.removeClass('agotado');
                establece_evento_dblclick_items(stockElement.closest('.item'));
            }
        });
    });

    $('#btn_prev').click(function() {
        $('#cart_items').animate({ scrollLeft: '-=200px' }, 'slow');
    });

    $('#btn_next').click(function() {
        $('#cart_items').animate({ scrollLeft: '+=200px' }, 'slow');
    });
});
