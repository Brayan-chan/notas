<?php
include('db_config.php');

// Decodifica los datos recibidos en formato JSON
$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$nombre = $data['nombre'];
$categoria = $data['categoria'];
$contenido = $data['contenido'];

// Prepara la consulta de actualización
$sql = "UPDATE notas SET nombre = '$nombre', categoria = '$categoria', contenido = '$contenido' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Nota actualizada correctamente."]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

$conn->close();
?>
