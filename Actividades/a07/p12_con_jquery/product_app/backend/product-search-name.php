<?php

namespace product_app\backend;
use product_app\backend\myapi\Products;
require_once __DIR__ . '/myapi/Products.php';
$productos = new Products('localhost', 'root', '1001', 'marketzone');
$productos->singleByName($_GET['nombre']);  
echo $productos->getData();  


?>
