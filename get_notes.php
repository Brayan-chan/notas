<?php
include('db_config.php');

$sql = "SELECT * FROM notas";
$result = $conn->query($sql);

$notes = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
}

echo json_encode($notes);

$conn->close();
?>
