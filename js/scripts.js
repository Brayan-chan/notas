function addNote() {
    const nombre = document.getElementById("nombre").value;
    const categoria = document.getElementById("categoria").value;
    const contenido = document.getElementById("contenido").value;

    fetch("add_note.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ nombre, categoria, contenido }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Nota guardada correctamente");
                loadNotes();
            }
        });
}

function loadNotes() {
    fetch("get_notes.php")
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById("notes-container");
            container.innerHTML = "";
            data.forEach(note => {
                container.innerHTML += `
                    <div class="note">
                        <h3>${note.nombre}</h3>
                        <p><strong>Categoría:</strong> ${note.categoria}</p>
                        <p>${note.contenido}</p>
                        <button onclick="deleteNote(${note.id})">Eliminar</button>
                        <button onclick="openEditForm(${note.id}, '${note.nombre}', '${note.categoria}', '${note.contenido.replace(/'/g, "\\'")}')">Editar</button>
                    </div>
                `;
            });
        });
}

// Abre el modal con los datos de la nota a editar
function openEditForm(id, nombre, categoria, contenido) {
    document.getElementById("edit-id").value = id;
    document.getElementById("edit-nombre").value = nombre;
    document.getElementById("edit-categoria").value = categoria;
    document.getElementById("edit-contenido").value = contenido;

    // Muestra el modal
    document.getElementById("editModal").classList.remove("hidden");
}

// Cierra el modal de edición
function closeEditForm() {
    document.getElementById("editModal").classList.add("hidden");
}

// Envía los datos editados al servidor
function submitEditForm() {
    const id = document.getElementById("edit-id").value;
    const nombre = document.getElementById("edit-nombre").value;
    const categoria = document.getElementById("edit-categoria").value;
    const contenido = document.getElementById("edit-contenido").value;

    fetch("update_note.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ id, nombre, categoria, contenido }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Nota actualizada correctamente.");
                closeEditForm();
                loadNotes();
            } else {
                alert("Error al actualizar la nota: " + data.error);
            }
        });
}

function deleteNote(id) {
    if (confirm("¿Estás seguro de que deseas eliminar esta nota?")) {
        fetch("delete_note.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ id }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Nota eliminada correctamente.");
                    loadNotes(); // Recarga la lista de notas
                } else {
                    alert("Error al eliminar la nota: " + data.error);
                }
            })
            .catch(error => {
                console.error("Error al eliminar la nota:", error);
            });
    }
}

document.addEventListener("DOMContentLoaded", loadNotes);
