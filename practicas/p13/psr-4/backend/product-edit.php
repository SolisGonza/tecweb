<?php

namespace product_app\backend;
use product_app\backend\myapi\Products;
include_once __DIR__ . '/myapi/Products.php'; 
$productos = new Products('localhost', 'root', '1001', 'marketzone');
$productos->edit(file_get_contents('php://input')); 
echo $productos->getData();  

?>
