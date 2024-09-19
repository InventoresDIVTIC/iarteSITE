<?php
// Habilitar CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");

include('conexion.php'); // Asegúrate de que este path es correcto.
$conexion = conectar();

// Consulta para obtener las imágenes
$query = "SELECT imagen1, imagen2 FROM registro";
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
    // Generar el HTML
    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Asignar Premios a Obras Generadas por IA</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
                padding: 20px;
            }
            .container {
                background-color: #ffffff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                max-width: 1000px;
                margin: auto;
            }
            h1 {
                text-align: center;
                color: #333333;
            }
            .grid-container {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 20px;
                margin-top: 20px;
            }
            .image-prompt-group {
                text-align: center;
                padding: 15px;
                background-color: #f9f9f9;
                border-radius: 8px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }
            .image-preview {
                max-width: 100%;
                height: auto;
                border-radius: 4px;
            }
            select {
                width: 100%;
                padding: 10px;
                margin-top: 10px;
                border-radius: 4px;
                border: 1px solid #cccccc;
            }
            button {
                display: block;
                width: 100%;
                padding: 10px;
                margin-top: 10px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            button.honorific {
                background-color: #007BFF;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <h1>Asignar Premios</h1>
        <p>Selecciona el puesto o mención honorífica para cada obra de arte generada por IA:</p>
        <form action="asignar_premios.php" method="post">
            <div class="grid-container">';
    
    $imageCount = 1;
    // Iterar sobre los resultados y generar las tarjetas de imágenes
    while ($fila = mysqli_fetch_assoc($resultado)) {
        foreach (['imagen1', 'imagen2'] as $imagen) {
            if (!empty($fila[$imagen])) {
                // Verifica si la imagen existe en la ruta
                $ruta_imagen = 'path_to_image_folder/' . $fila[$imagen];
                if (file_exists($ruta_imagen)) {
                    echo '<div class="image-prompt-group">
                        <img src="' . $ruta_imagen . '" class="image-preview" alt="Obra ' . $imageCount . '">
                        <h4>Obra ' . $imageCount . '</h4>
                        <p><strong>Prompt:</strong> Descripción del prompt utilizado...</p>
                        <label for="ranking-' . $imageCount . '">Asignar Lugar</label>
                        <select id="ranking-' . $imageCount . '" name="ranking[]">
                            <option value="">Seleccionar...</option>
                            <option value="1">Primer Lugar</option>
                            <option value="2">Segundo Lugar</option>
                            <option value="3">Tercer Lugar</option>
                            <option value="mencion-honorifica">Mención Honorífica</option>
                        </select>
                        <button type="button" class="honorific" onclick="asignarMencion(' . $imageCount . ')">Asignar Mención Honorífica</button>
                    </div>';
                    $imageCount++;
                }
            }
        }
    }

    echo '</div>
        <button type="submit">Guardar Asignaciones</button>
    </form>
    </div>
    <script>
        function asignarMencion(id) {
            alert("Mención Honorífica asignada a la obra " + id);
        }
    </script>
    </body>
    </html>';
} else {
    echo 'Error al obtener los datos: ' . mysqli_error($conexion);
}

desconectar($conexion);
?>
