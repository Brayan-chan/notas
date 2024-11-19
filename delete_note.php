<?php
include('db_config.php');

// Decodifica los datos recibidos en formato JSON
$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];

// Prepara la consulta de eliminación
$sql = "DELETE FROM notas WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Nota eliminada correctamente."]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

$conn->close();
?>
