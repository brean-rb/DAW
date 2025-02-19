var ordenCarrito = 0;
var posCarritoInicial;
var anchoCarritoInicial;
var anchoProductoEnCarrito = 120;

function actualizaStockProducto($item, incremento) {
    var stock = parseInt($item.children(".stock").text().replace("Stock ", "")) || 0;

    stock += incremento;
    if (stock < 0) return;

    $item.children(".stock").fadeOut(200, function () {
        $(this).text("Stock " + stock).fadeIn(300);
    });

    if (stock === 0) {
        $item.find(".stock").addClass("agotado");
        $item.off("dblclick");
    } else if (stock === 1 && incremento === 1) {
        $item.find(".stock").removeClass("agotado");
        establece_evento_dblclick_items($item);
    }
    ocultarBotones();
}

function actualizaNumeroProductosPedidos(incremento) {
    var numProductosPedido = parseInt($("#citem").val()) || 0;
    numProductosPedido += incremento;
    if (numProductosPedido < 0) numProductosPedido = 0;

    $("#citem").fadeOut(200, function () {
        $(this).val(numProductosPedido).fadeIn(200);
    });

    ocultarBotones();
}

function actualizaPrecioTotal(incremento) {
    var precioPedido = parseInt($("#cprice").val()) || 0;
    precioPedido += incremento;
    if (precioPedido < 0) precioPedido = 0;

    $("#cprice").fadeOut(200, function () {
        $(this).val(precioPedido + " €").fadeIn(200);
    });
}

function incrementaAnchoCarrito(incremento) {
    $("#cart_items").animate({ width: $("#cart_items").width() + incremento }, 300);
}

function anyadeProductoAlCarrito($item) {
    var $delete = $('<a href="#" class="delete">❌</a>');

    var id = "c" + $item.attr("id");
    var $copia = $item.clone().attr("id", id).addClass('icart').prepend($delete);
    $copia.children(":not(a)").addBack().css("cursor", "default").find(".stock").hide();

    $("#cart_items").prepend($copia);
    ocultarBotones();
    anadirAnimacion($copia);
}

function desplazaCarritoIzquierda(desplazamiento) {
    var pos = $("#cart_items").offset();

    pos.left = Math.max(pos.left + desplazamiento, posCarritoInicial.left);
    $("#cart_items").offset(pos);
}

function desplazaCarritoDerecha(desplazamiento) {
    var pos = $("#cart_items").offset();
    var ancho = $("#cart_items").width();
    var der = pos.left + ancho;

    pos.left = Math.min(pos.left - desplazamiento, posCarritoInicial.left + anchoCarritoInicial - ancho);
    $("#cart_items").offset(pos);
}

function establece_evento_dblclick_items($items) {
    $items.off("dblclick").dblclick(function () {
        actualizaStockProducto($(this), -1);
        actualizaNumeroProductosPedidos(1);
        var precioProducto = parseInt($(this).children(".price").html()) || 0;
        actualizaPrecioTotal(precioProducto);
        anyadeProductoAlCarrito($(this));

        if ($("#cart_items").children().length > 4) {
            incrementaAnchoCarrito(anchoProductoEnCarrito);
        }
    });
}

function eliminaProductoDelCarrito($item) {
    var id = $item.attr("id").substring(1);
    var $productoOriginal = $("#" + id);

    var precio = parseInt($item.children(".price").html()) || 0;

    $item.animate({ opacity: 0, height: 0 }, 500, function () {
        actualizaStockProducto($productoOriginal, 1);
        actualizaNumeroProductosPedidos(-1);
        actualizaPrecioTotal(-precio);

        var numArticulosCarrito = $("#cart_items").children().length - 1;
        if (numArticulosCarrito >= 4) {
            incrementaAnchoCarrito(-anchoProductoEnCarrito);
        }

        $(this).remove();
        ocultarBotones();
    });
}

function ocultarBotones() {
    var cantidad = parseInt($("#citem").val()) || 0;

    if (cantidad === 0) {
        $("#btn_next, #btn_prev, #btn_clear, #btn_comprar").hide();
    } else {
        $("#btn_clear, #btn_comprar").show();
        $("#btn_next, #btn_prev").toggle(cantidad > 4);
    }
}

function anadirAnimacion($item) {
    $item.hide().css("opacity", 0).slideDown(300).animate({ opacity: 1 }, 300);
}

$(function () {
    anchoCarritoInicial = $("#cart_items").width();
    posCarritoInicial = $("#cart_items").offset();

    establece_evento_dblclick_items($(".item"));

    $(document).on("click", ".delete", function () {
        eliminaProductoDelCarrito($(this).parent());
        return false;
    });

    $("#btn_clear").click(function () {
        $(".delete").trigger("click");
    });

    $("#btn_prev").click(function () {
        desplazaCarritoIzquierda(50);
    });

    $("#btn_next").click(function () {
        desplazaCarritoDerecha(50);
    });

    ocultarBotones();
});
