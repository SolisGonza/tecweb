<?php

use Gonza\P13\Update\update as update; 
require_once __DIR__ . '/../vendor/autoload.php';
$productos = new update('marketzone');
$productos->edit(file_get_contents('php://input')); 
echo $productos->getData();  

?>
