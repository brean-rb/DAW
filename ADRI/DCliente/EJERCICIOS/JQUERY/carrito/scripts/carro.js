$(function () {
    $(".item").bind("dblclick.anadir" ,function() {
        var stockElement = $(this).find('.stock');
        var stock = parseInt(stockElement.text().split(' ')[1]);
        if (stock > 0) {
            stock--;
            stockElement.text('Stock: ' + stock);

            if (stock == 0) {
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
            item.css('cursor', 'default');

             $delete = $('<a href="" class="delete"></a>');
            item.prepend($delete);
            $('#cart_items').prepend(item);

                
        }
    });
        $(document).on("click.borrar",".delete" ,function () {
            var idPadre = $(this).parent().attr('id');
            var id = idPadre.substring(1);

            var stockElement = $('#' + id).find('.stock');
            var stock = parseInt(stockElement.text().split(' ')[1]);
            stock++;
            stockElement.text('Stock: ' + stock);

            if (stock > 0) {
                stockElement.removeClass('agotado');
                $(".item").bind("dblclick.anadir");
            } else {
                $(".item").unbind("dblclick.anadir");
            }

            $('#citem').val(parseInt($('#citem').val()) - 1);

            var price = parseInt($('#cprice').val().split(' ')[0]);
            var product_price = parseInt($(this).parent().find('.price').text().split(' ')[0]);
            var new_price = price - product_price;

            $('#cprice').val(new_price + ' €');

            $(this).parent().remove();
            return false;
        });

        $("#btn_clear").click(function(){
            $(".item a.delete").trigger("click.borrar")
        });

                var posicionInicio = $("#cart_items").offset();
                var izqInicio = posicionInicio.left;
                var anchoInicio = $("#cart_items").width();
                var derInicio = izqInicio + anchoInicio;
                
                function moverFlechaDerecha(despl){
                
                    var pos = $("#cart_items").offset();
                    var ancho =$("#cart_items").width();

                    if(derInicio - despl >= izqInicio + anchoInicio){
                        pos.left -= despl;
                    } else{
                        pos.left = izqInicio + anchoInicio - ancho  
                    }
                    $("#cart_items").offset(pos);
                }

                function moverFlechaIzquierda(despl){
                
                    var pos = $("#cart_items").offset();

                    if(pos.left + despl  <= izqInicio){
                        pos.left += despl;
                    } else{
                        pos.left = izqInicio;
                    }
                    $("#cart_items").offset(pos);

                }

                $("#btn_next").click(function () {
                    moverFlechaDerecha(50);
                });
                
                $("#btn_prev").click(function () {
                    moverFlechaIzquierda(50);
                });
                

        
       
        
});    
  