<?php
abstract class DataBase {
    protected $conexion;

    // Constructor que inicializa la conexión con los datos proporcionados
    public function __construct($user, $pass, $db, $host = 'localhost') {
        $this->conexion = new mysqli($host, $user, $pass, $db);
        
        // Verificación de la conexión
        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
    }
}
?>
