<?php
require_once 'DataBase.php';

class Products extends DataBase {
    private $data = [];
    private $response = [];

    // Constructor que inicializa el atributo response y establece la conexión con la BD
    public function __construct($user, $pass, $db, $host = 'localhost') {
        parent::__construct($user, $pass, $db, $host);
        $this->response = [];
    }

    // Método para agregar un producto
    public function add($object) {
        // Implementación de la lógica para agregar el producto
        $this->response = ["Producto agregado con éxito"];
    }

    public function delete($id) {
        // Definir la consulta SQL para marcar el producto como eliminado
        $sql = "UPDATE productos SET eliminado = 1 WHERE id = ?";
        
        // Preparar la consulta para evitar inyecciones SQL
        $stmt = $this->conexion->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $id);
            
            // Ejecutar la consulta y verificar si fue exitosa
            if ($stmt->execute()) {
                $this->response = [
                    'status' => 'success',
                    'message' => 'Producto eliminado con éxito'
                ];
            } else {
                $this->response = [
                    'status' => 'error',
                    'message' => "ERROR: No se ejecutó la consulta. " . $this->conexion->error
                ];
            }
            
            // Cerrar el statement
            $stmt->close();
        } 
    }
    // Método para editar un producto
    public function edit($object) {
        // Implementación de la lógica para editar el producto
        $this->response = ["Producto editado con éxito"];
    }

    // Método para listar todos los productos
    public function list() {
        // Implementación de la lógica para listar los productos
        $this->response = ["Lista de productos"];
    }

    // Método para buscar un producto usando un término
    public function search($term) {
        // Implementación de la lógica para buscar productos
        $this->response = ["Resultado de búsqueda"];
    }

    // Método para obtener un producto específico usando su ID
    public function single($id) {
        // Implementación de la lógica para obtener un producto por ID
        $this->response = ["Producto específico por ID"];
    }

    // Método para obtener un producto específico usando su nombre
    public function singleByName($name) {
        // Preparar la consulta
        $stmt = $this->conexion->prepare("SELECT COUNT(*) > 0 FROM productos WHERE nombre = ?");
        
        if ($stmt) {
            $stmt->bind_param("s", $nombre);
            $stmt->execute();
            
            // Obtener el resultado directamente como booleano
            $stmt->bind_result($exists);
            $stmt->fetch();
            
            // Guardar el resultado en $this->response
            $this->response = ['exists' => $exists];
            
            $stmt->close();
        } else {
            // En caso de error, almacenar mensaje en $this->response
            $this->response = ['error' => 'Error al preparar la consulta'];
        }
    }

    // Método para convertir el arreglo de datos en JSON y devolverlo
    public function getData() {
        return json_encode($this->response);
    }
}
?>
