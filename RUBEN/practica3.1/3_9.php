<?php
    echo "PRODUCTO - PRECIO/KG - PESO - PRECIO" . "<br>";
    $precio_kg = ["JUDIAS" => 3.50,
                    "PATATAS" => 0.40,
                    "TOMATES" => 1.00,
                    "MANZANAS" => 1.20,
                    "UVAS" => 2.50
    ];
    

    //VARIABLES

    $lista_compra = ["JUDIAS" => 1.21,
                    "PATATAS" => 2.08,
                    "TOMATES" => 2.08,
                    "MANZANAS" => 2.15,
                    "UVAS" => 0.77
    ];


    foreach($precio_kg as $key => $value){
        $peso = $lista_compra[$key];
        $precio = $value * $peso;

        echo $key . " - " . $value . " - " . $peso . " - " . number_format($precio, 2) . "<br>";
    }
?>