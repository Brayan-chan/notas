<?php include('db_config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloc de Notas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Bloc de Notas</h1>
        <form id="note-form">
            <input type="text" id="nombre" placeholder="Nombre de la nota" required>
            <input type="text" id="categoria" placeholder="Categoría" required>
            <textarea id="contenido" placeholder="Contenido de la nota" required></textarea>
            <button type="button" onclick="addNote()">Guardar Nota</button>
        </form>
        <div id="notes-container">
            <!-- Aquí se mostrarán las notas -->
        </div>
        <!-- Modal para editar notas -->
        <div id="editModal" class="modal hidden">
            <div class="modal-content">
                <span class="close" onclick="closeEditForm()">&times;</span>
                <h2>Editar Nota</h2>
                <form id="edit-form">
                    <input type="hidden" id="edit-id">
                    <input type="text" id="edit-nombre" placeholder="Nombre de la nota" required>
                    <input type="text" id="edit-categoria" placeholder="Categoría" required>
                    <textarea id="edit-contenido" placeholder="Contenido de la nota" required></textarea>
                    <button type="button" onclick="submitEditForm()">Actualizar Nota</button>
                </form>
            </div>
        </div>
    </div>
    <script src="js/scripts.js"></script>
</body>

</html>