<?php 
include('header.html');
include('conexion.php');
$conexion = conectar();

$target_dir = "files/";
$target_file = $target_dir . basename($_FILES["addrsInp"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Verificar si el archivo es un PDF
if (isset($_POST["submit"])) {
    if ($_FILES['addrsInp']['error'] !== UPLOAD_ERR_OK) {
        // Identificar error específico
        switch ($_FILES['addrsInp']['error']) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                echo "El archivo subido excede el tamaño máximo permitido.";
                $uploadOk = 0;
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "El archivo fue subido parcialmente.";
                $uploadOk = 0;
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "No se subió ningún archivo.";
                $uploadOk = 0;
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                echo "Falta la carpeta temporal.";
                $uploadOk = 0;
                break;
            case UPLOAD_ERR_CANT_WRITE:
                echo "Error al escribir el archivo en el disco.";
                $uploadOk = 0;
                break;
            case UPLOAD_ERR_EXTENSION:
                echo "Una extensión de PHP detuvo la subida del archivo.";
                $uploadOk = 0;
                break;
            default:
                echo "Hubo un error desconocido en la subida del archivo.";
                $uploadOk = 0;
                break;
        }
    } else {
        // Verificar la extensión del archivo
        if ($fileType == "pdf") {
            // Verificar el tipo MIME para asegurarse de que realmente es un PDF
            $mimeType = mime_content_type($_FILES["addrsInp"]["tmp_name"]);
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
}

// Si $uploadOk sigue siendo 1, proceder a mover el archivo
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["addrsInp"]["tmp_name"], $target_file)) {
        echo "El archivo " . basename($_FILES["addrsInp"]["name"]) . " ha sido subido exitosamente.";
    } else {
        echo "Hubo un error al subir tu archivo.";
    }
}

desconectar($conexion);
?>
