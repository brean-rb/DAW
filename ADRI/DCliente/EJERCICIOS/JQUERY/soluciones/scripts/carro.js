﻿var ordenCarrito = 0;
var posCarritoInicial;
var anchoCarritoInicial;
var anchoProductoEnCarrito = 120;
 
function actualizaStockProducto($item, incremento)
{
	var stock = parseInt($item.children(".stock").html().replace("Stock ", ""));
	
	if (stock+incremento >= 0)
	{
		stock += incremento;
		$item.children(".stock").html("Stock " + stock);
		if (stock == 0)
		{
			$item.find(".stock").addClass("agotado");
			$item.unbind("dblclick");
		}
		else
		{
			if (stock == 1 && incremento == 1)
			{
				$item.find(".stock").removeClass("agotado");
				establece_evento_dblclick_items($item);
			}
		}
	}
	ocultarBotones();
}

function actualizaNumeroProductosPedidos(incremento)
{
	var numProductosPedido = parseInt($("#citem").val());
	numProductosPedido += incremento;
	$("#citem").val(numProductosPedido);
}

function actualizaPrecioTotal($item, incremento)
{
	var precioPedido = parseInt($("#cprice").val());
	precioPedido += parseInt(incremento);
	$("#cprice").val(precioPedido + " €");
}

function incrementaAnchoCarrito(incremento)
{
	$("#cart_items").width($("#cart_items").width() + incremento);
}

function anyadeProductoAlCarrito($item)
{
	var $delete = $('<a href="" class="delete"></a>');

	var id = "c"+$item.attr("id");
	$copia = $item.clone().attr("id", id).addClass('icart').prepend($delete);
	$copia.children(":not(a)").addBack().css("cursor", "default").find(".stock").hide();
	
	$("#cart_items").prepend($copia);
	ocultarBotones();
	anadirAnimacion($copia);
}

function desplazaCarritoIzquierda(desplazamiento)
{
	var pos = $("#cart_items").offset();
	
	if (pos.left + desplazamiento <= posCarritoInicial.left)
		pos.left += desplazamiento;
	else
		pos.left = posCarritoInicial.left;
		
	$("#cart_items").offset(pos);
}

function desplazaCarritoDerecha(desplazamiento)
{
	var pos = $("#cart_items").offset();
	var ancho = $("#cart_items").width();
	var der = pos.left + ancho;
	
	if (der - desplazamiento >= posCarritoInicial.left + anchoCarritoInicial)
		pos.left -= desplazamiento;
	else
		pos.left = posCarritoInicial.left + anchoCarritoInicial - ancho;

	$("#cart_items").offset(pos);
}

function establece_evento_dblclick_items($items)
{
	$items.dblclick(function()
	{
		actualizaStockProducto($(this), -1);

		actualizaNumeroProductosPedidos(1);
			
		actualizaPrecioTotal($(this), parseInt($(this).children(".price").html()));
		
		anyadeProductoAlCarrito($(this));

		var numArticulosCarrito = $("#cart_items").children().length;
		if (numArticulosCarrito > 4) 
			incrementaAnchoCarrito(anchoProductoEnCarrito);
	});
}

function eliminaProductoDelCarrito($item)
{
	var id = $item.attr("id");
	id = id.substring(1);
	
	actualizaStockProducto($("#"+id), 1);
	
	actualizaNumeroProductosPedidos(-1);
	
	actualizaPrecioTotal($item, -parseInt($item.children(".price").html()));
	
	var pos = $("#cart_items").offset();
	
	var numArticulosCarrito = $("#cart_items").children().length-1;
	if (numArticulosCarrito >= 4) 
	{
		incrementaAnchoCarrito(-anchoProductoEnCarrito);
		
		var anchoCarrito = $("#cart_items").width();
		var der = pos.left + anchoCarrito;
		if (der < posCarritoInicial.left + anchoCarritoInicial)
			pos.left = posCarritoInicial.left + anchoCarritoInicial - anchoCarrito;
	}
	else
		pos.left = posCarritoInicial.left;
	
	$("#cart_items").offset(pos);

	$item.remove();
	ocultarBotones();
}

function ocultarBotones(){
	if (parseInt($("#citem").val()) == 0) {
		$("#btn_next").hide();
		$("#btn_prev").hide();
		$("#btn_clear").hide();
		$("#btn_comprar").hide();
	} else {
		$("#btn_clear").show();
		$("#btn_comprar").show();
		if(parseInt($("#citem").val()) > 4){
			$("#btn_next").show();
			$("#btn_prev").show();
		} else {
			$("#btn_next").hide();
			$("#btn_prev").hide();
		}
	}
}

function anadirAnimacion($item){
		$item.hide();
		$item.slideDown(400, function(){
			// tiene que hacer de derecha a izquierda
		});
}

$(function() 
{
	anchoCarritoInicial = $("#cart_items").width();
	posCarritoInicial = $("#cart_items").offset();

	establece_evento_dblclick_items($(".item"));
	
	$(document).on("click", ".delete", function()
	{
		eliminaProductoDelCarrito($(this).parent());
		
		return false;
	});
	
	$("#btn_clear").click(function(evento) 
	{
		$(".delete").trigger("click");
	});
	
	$("#btn_prev").click(function(evento) 
	{
		desplazaCarritoIzquierda(50);
	});

	$("#btn_next").click(function(evento) 
	{
		desplazaCarritoDerecha(50);
	});
	ocultarBotones();
});