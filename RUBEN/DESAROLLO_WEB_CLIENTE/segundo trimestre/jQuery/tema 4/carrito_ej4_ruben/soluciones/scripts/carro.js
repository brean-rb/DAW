var ordenCarrito = 0;
var posCarritoInicial;
var anchoCarritoInicial;
var anchoProductoEnCarrito = 120;

function actualizaStockProducto($item, incremento) {
    var stock = parseInt($item.children(".stock").text().replace("Stock ", ""), 10);
    
    if (stock + incremento >= 0) {
        stock += incremento;
        $item.children(".stock").fadeOut(600, function(){
            $(this).text("Stock " + stock).fadeIn(600);
        });

        if (stock === 0) {
            $item.find(".stock").addClass("agotado");
            $item.off("dblclick");
        } else {
            if (stock === 1 && incremento === 1) {
                $item.find(".stock").removeClass("agotado");
                establece_evento_dblclick_items($item);
            }
        }
    }

    ocultarBotones();
}

function actualizaNumeroProductosPedidos(incremento) {
    var numProductosPedido = parseInt($("#citem").val(), 10);
    numProductosPedido += incremento;
    $("#citem").fadeOut(600, function() {
        $(this).val(numProductosPedido).fadeIn(600);
    });
}

function actualizaPrecioTotal($item, incremento) {
    var precioPedido = parseInt($("#cprice").val(), 10);
    precioPedido += parseInt(incremento, 10);
    $("#cprice").fadeOut(600, function() {
        $(this).val(precioPedido + " €").fadeIn(600);
    });
}

function incrementaAnchoCarrito(incremento) {
    $("#cart_items").width($("#cart_items").width() + incremento);
}

function anyadeProductoAlCarrito($item) {
    var $delete = $('<a href="#" class="delete"></a>');
    var id = "c" + $item.attr("id");
    
    var $copia = $item.clone().attr("id", id).addClass('icart').prepend($delete);
    $copia.find(".stock").hide();
    
    $copia.css("cursor", "default").hide();
    $("#cart_items").prepend($copia);
    
    $copia.animate({ width: "toggle", opacity: "show" }, 600, function() {
        ocultarBotones();
    });
}

function desplazaCarritoIzquierda(desplazamiento) {
    var pos = $("#cart_items").offset();

    if (pos.left + desplazamiento <= posCarritoInicial.left) {
        pos.left += desplazamiento;
    } else {
        pos.left = posCarritoInicial.left;
    }

    $("#cart_items").offset(pos);
}

function desplazaCarritoDerecha(desplazamiento) {
    var pos = $("#cart_items").offset();
    var ancho = $("#cart_items").width();
    var der = pos.left + ancho;

    if (der - desplazamiento >= posCarritoInicial.left + anchoCarritoInicial) {
        pos.left -= desplazamiento;
    } else {
        pos.left = posCarritoInicial.left + anchoCarritoInicial - ancho;
    }

    $("#cart_items").offset(pos);
}

function establece_evento_dblclick_items($items) {
    $items.dblclick(function() {
        actualizaStockProducto($(this), -1);
        actualizaNumeroProductosPedidos(1);
        actualizaPrecioTotal($(this), parseInt($(this).children(".price").text(), 10));
        anyadeProductoAlCarrito($(this));

        if ($("#cart_items").children().length > 4) {
            incrementaAnchoCarrito(anchoProductoEnCarrito);
        }
    });
}

function eliminaProductoDelCarrito($item) {
    $item.fadeOut(600, function() {
        var id = $item.attr("id").substring(1);

        actualizaStockProducto($("#" + id), 1);
        actualizaNumeroProductosPedidos(-1);
        actualizaPrecioTotal($item, -parseInt($item.children(".price").text(), 10));

        var numArticulosCarrito = $("#cart_items").children().length - 1;
        var pos = $("#cart_items").offset();

        if (numArticulosCarrito >= 4) {
            incrementaAnchoCarrito(-anchoProductoEnCarrito);
            var anchoCarrito = $("#cart_items").width();
            var der = pos.left + anchoCarrito;
            if (der < posCarritoInicial.left + anchoCarritoInicial) {
                pos.left = posCarritoInicial.left + anchoCarritoInicial - anchoCarrito;
            }
        } else {
            pos.left = posCarritoInicial.left;
        }

        $("#cart_items").offset(pos);
        $item.remove();
        ocultarBotones();
    });
}

$(function() {
    anchoCarritoInicial = $("#cart_items").width();
    posCarritoInicial = $("#cart_items").offset();

    establece_evento_dblclick_items($(".item"));

    $(document).on("click", ".delete", function(event) {
        event.preventDefault();
        eliminaProductoDelCarrito($(this).parent());
        ocultarBotones();
    });

    $("#btn_clear").click(function() {
        // Elimina todos los items con una animación de fadeOut conjunta
        $("#cart_items").children().fadeOut(600, function() {
            $(this).remove();
            ocultarBotones();
        });

        // Detenemos animaciones pendientes en los contadores y reseteamos inmediatamente
        $("#citem, #cprice").stop(true, true).fadeOut(600, function(){
            $(this).val($(this).is("#citem") ? "0" : "0 €").fadeIn(600);
        });

        // Restablece el stock de cada producto a 10
        $(".item").each(function() {
            var $item = $(this);
            $item.children(".stock").fadeOut(600, function(){
                $(this).text("Stock 10").fadeIn(600);
            });
        });
    });

    $("#btn_prev").click(function() {
        desplazaCarritoIzquierda(50);
    });

    $("#btn_next").click(function() {
        desplazaCarritoDerecha(50);
    });

    $("#btn_next, #btn_prev, #btn_clear, #btn_comprar").hide();
});

function ocultarBotones() {
    var numArticulosCarrito = $("#cart_items").children().length;

    if (numArticulosCarrito === 0) {
        $("#btn_next, #btn_prev, #btn_clear, #btn_comprar").hide();
    } else if (numArticulosCarrito <= 4) {
        $("#btn_clear, #btn_comprar").show();
        $("#btn_next, #btn_prev").hide();
    } else {
        $("#btn_next, #btn_prev, #btn_clear, #btn_comprar").show();
    }
}