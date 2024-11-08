<?php

namespace product_app\backend\myapi;

abstract class DataBase {
    protected $conexion;

    // Constructor que inicializa la conexión con los datos proporcionados
    public function __construct($host, $user, $pass, $db) {
        // Establece la conexión a la base de datos
        $this->conexion = @mysqli_connect($host, $user, $pass, $db);

        if(!$this->conexion) {
            die('¡Base de datos NO conextada!');
        }
    }
}
?>
