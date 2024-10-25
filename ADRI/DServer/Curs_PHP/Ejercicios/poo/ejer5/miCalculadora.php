<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        Introduce el numero 1:<input type="text" name="num1">
    <br>Introduce el numero 2:<input type="text" name="num2">
    <br><select name="operacion">
        <option value="null">Seleccione operación</option>
        <option value="+">Suma(+)</option>
        <option value="-">Resta(-)</option>
        <option value="*">Multiplicación(*)</option>
        <option value="/">División(/)</option>
        <option value="%">Resto(%)</option>
    </select>
    <input type="submit" value="Enviar">
    </form>
</body>
</html>
<?php
include('Calculadora.php');

if((isset($_POST["num1"])) && isset($_POST["num2"]) && isset($_POST["operacion"])){
if ((filter_input(INPUT_POST, "num1", FILTER_VALIDATE_INT)) && (filter_input(INPUT_POST, "num2", FILTER_VALIDATE_INT))) {
    $calc =new Calculadora($_POST["num1"],$_POST["num2"],$_POST["operacion"]);
    echo "<b>" . "El resultado de " . $_POST["num1"] . " " . $_POST["operacion"] . " " . $_POST["num2"] . " es: " . $calc->calculadora() . "</b>";

}else{
    echo "NO ES UN NUMERO VALIDO";
}

}
