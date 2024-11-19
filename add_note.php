<?php
include('db_config.php');

$data = json_decode(file_get_contents('php://input'), true);

$nombre = $data['nombre'];
$categoria = $data['categoria'];
$contenido = $data['contenido'];

$sql = "INSERT INTO notas (nombre, categoria, contenido) VALUES ('$nombre', '$categoria', '$contenido')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

$conn->close();
?>
