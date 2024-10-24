<?php

$correo = " adr mar @gmail. com ";

$email = trim($correo);

$mail = explode(" ",$email);

$cmail = implode("", $mail);
echo $cmail;
