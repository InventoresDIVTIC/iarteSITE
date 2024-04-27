<?php
include 'conexion.php'; // Asegúrate de usar el path correcto

function mostrarTablas() {
    $conexion = conectar(); // Usar la función de conexión del archivo incluido

    // Consulta para obtener todas las tablas de la base de datos
    $query = "SHOW TABLES";
    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        echo "<h1>Tablas en la base de datos:</h1>";
        echo "<ul>";
        while ($fila = mysqli_fetch_row($resultado)) {
            echo "<li>" . $fila[0] . "</li>"; // Mostrar el nombre de la tabla
        }
        echo "</ul>";
    } else {
        echo "Error al obtener las tablas: " . mysqli_error($conexion);
    }

    desconectar($conexion); // Desconectar la base de datos
}

mostrarTablas(); // Ejecutar la función para mostrar las tablas
?>
