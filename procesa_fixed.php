<?php 
include('header.html');
include('conexion.php');
$conexion = conectar();

// Datos personales
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
$correo = mysqli_real_escape_string($conexion, $_POST['correo']);
$edad = mysqli_real_escape_string($conexion, $_POST['edad']);


// Archivos y PDF ===== // Archivos y PDF =====
$target_dir = "galeria/upload_files/";
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




// Contraseña de prueba
$password = "pass123";

// Insertar la contraseña en texto plano (solo para pruebas)
// Este código debería estar comentado en producción
// $sql = "UPDATE registro SET nacionalidad = '$password' WHERE id = $correo";

// Descomenta las siguientes líneas para hashear la contraseña antes de almacenarla
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
// $sql = "UPDATE nombre_de_tu_tabla SET nacionalidad = '$hashed_password' WHERE id = $user_id";

// La contraseña de prueba en texto plano se encuentra en el campo de nacionalidad y hasheada en el de ocupacion

// insertar en la base de datos

$query = "INSERT INTO registro(nombre, telefono, correo, edad, identificacion, nacionalidad, ocupacion ) VALUES('$nombre','$telefono','$correo',$edad,'$target_file','$password','$hashed_password')";

    if(ejecutar($conexion,$query)):?>
        <script>
            $('#exampleModal').modal('show');
        </script>
    <?php
        exit;
    else:
    ?>
        <script>
            $('#exampleModal').modal('show');
        </script>
        <?php
    endif;
    desconectar($conexion);

?>

<script>
$(document).ready(function() {

    document.getElementById('closeModal').addEventListener('click',function () {
            window.location.href = "./";
        })
});
</script>