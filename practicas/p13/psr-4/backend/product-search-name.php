<?php

use Gonza\P13\Read\Read as Read; 
require_once __DIR__ . '/../vendor/autoload.php';
$productos = new Read('marketzone');
$productos->singleByName($_GET['nombre']);  
echo $productos->getData();  


?>
