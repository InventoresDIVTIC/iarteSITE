<?php 
$target_dir = "galeria/upload_file/";
$target_file = $target_dir . basename($_FILES["fileInput"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Verificar si el archivo es un PDF
if (isset($_POST["submit"])) {
    // Verificar la extensión del archivo
    if ($fileType == "pdf") {
        // Verificar el tipo MIME para asegurarse de que realmente es un PDF
        $mimeType = mime_content_type($_FILES["fileInput"]["tmp_name"]);
        if ($mimeType == 'application/pdf') {
            echo "El archivo es un PDF válido.";
            $uploadOk = 1;
        } else {
            echo "El archivo no es un PDF válido.";
            $uploadOk = 0;
        }
    } else {
        echo "El archivo no tiene la extensión .pdf.";
        $uploadOk = 0;
    }
}

// Si $uploadOk sigue siendo 1, proceder a mover el archivo
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["fileInput"]["tmp_name"], $target_file)) {
        echo "El archivo " . basename($_FILES["fileInput"]["name"]) . " ha sido subido exitosamente.";
    } else {
        echo "Hubo un error al subir tu archivo.";
    }
}
?>