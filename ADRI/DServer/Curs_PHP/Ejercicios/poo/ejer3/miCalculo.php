<?php
include('CalculoEC.php');  

$ec1 = new CalculoEC(8, 16, 3);
$ec2 = new CalculoEC(9, 22, 1);

$ec1->esSegGrado();
$ec2->esSegGrado();

$resultpos1 = 0;
$resultneg1 = 0;

$ec1->getResultados($resultpos1, $resultneg1);
echo "El resultado positivo de la ecuación 1 es: " . $resultpos1 . " y el resultado negativo es: " . $resultneg1 . "<br>";

$resultpos2 = 0;
$resultneg2 = 0;

$ec2->getResultados($resultpos2, $resultneg2);
echo "El resultado positivo de la ecuación 2 es: " . $resultpos2 . " y el resultado negativo es: " . $resultneg2 . "<br>";

$ec1->equivalentes($ec2);
