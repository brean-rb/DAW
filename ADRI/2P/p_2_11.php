<?php
    //CONSTANTES
    define("JUDIAS", 3.50);
    define("PATATAS", 0.40);
    define("TOMATES", 1.00);
    define("MANZANAS", 1.20);
    define("UVAS", 2.50);

    $fruta = "patata";

    switch ($fruta) {
        case 'judia':
            echo JUDIAS;
            break;
        
        case 'patata':
            echo PATATAS;
            break;

        case 'tomate':
            echo TOMATES;
            break;
        
        case 'manzana':
            echo MANZANAS;
            break;

        case 'uva':
            echo UVAS;
            break;
        
        default:
            echo "NO QUEDAN EXISTENCIAS DE ETSA FRUTA";
            break;
    }
    
?>