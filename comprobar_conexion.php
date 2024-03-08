<?php
require_once 'config/db.php';

try {
    // Intentar establecer la conexión
    $conn = ConectionBD::conection();
    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    // Capturar excepciones en caso de error
    echo "Error de conexión a la base de datos: " . $e->getMessage();
    http_response_code(500); // Configurar el código de respuesta HTTP para indicar un error interno del servidor
}
?>
