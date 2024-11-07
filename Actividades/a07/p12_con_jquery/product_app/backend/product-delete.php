<?php
    /*
    include_once __DIR__.'\myapi\Products.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array(
        'status'  => 'error',
        'message' => 'La consulta falló'
    );
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_GET['id']) ) {
        $id = $_GET['id'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
        if ( $conexion->query($sql) ) {
            $data['status'] =  "success";
            $data['message'] =  "Producto eliminado";
		} else {
            $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
        }
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
    */

    namespace Backend\myapi;

    // Incluir el archivo de la clase Products
    include_once __DIR__ . '/myapi/Products.php';

    // Crear instancia de la clase Products'root', '1001', 'marketzone'
    $products = new Products('root', '1001', 'marketzone');

    // Invocar el método delete() con el ID obtenido de la solicitud
    $products->delete($_GET['id'] ?? '');

    // Usar getData() para devolver la respuesta en JSON
    echo $products->getData();

?> 
