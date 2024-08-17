<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Datos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed; /* Asegura que la tabla no se desborde */
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            word-wrap: break-word; /* Permite que el texto largo se ajuste */
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        pre {
            background-color: #f2f2f2;
            padding: 10px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Datos de los Concursantes</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Edad</th>
                <th>Identificación</th>
                <th>Ocupación</th>
                <th>Nacionalidad</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('conexion.php'); // Asegúrate de que este path es correcto.

            function mostrarDatos() {
                $conexion = conectar();

                // Verificar y mostrar los campos de la tabla
                $camposQuery = "SHOW COLUMNS FROM registro";
                $camposResultado = mysqli_query($conexion, $camposQuery);

                echo "<p>Campos en la tabla 'registro':</p><ul>";
                while($campo = mysqli_fetch_assoc($camposResultado)) {
                    echo "<li>" . htmlspecialchars($campo['Field']) . " (" . htmlspecialchars($campo['Type']) . ")</li>";
                }
                echo "</ul>";

                // Obtener y mostrar los datos de la tabla
                $query = "SELECT nombre, telefono, correo, edad, identificacion, ocupacion, nacionalidad FROM registro";
                $resultado = mysqli_query($conexion, $query);

                if ($resultado) {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['telefono']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['correo']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['edad']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['identificacion']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['ocupacion']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['nacionalidad']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Error al obtener los datos: " . mysqli_error($conexion) . "</td></tr>";
                }

                desconectar($conexion);
            }

            mostrarDatos();
            ?>
        </tbody>
    </table>

    <h2>Esquema de la Base de Datos</h2>
    <pre>
        <?php
        function mostrarEsquema() {
            $conexion = conectar();

            // Obtener el esquema de la base de datos
            $sql = "SELECT TABLE_NAME 
                    FROM INFORMATION_SCHEMA.TABLES 
                    WHERE TABLE_SCHEMA = DATABASE()";
            $resultado = mysqli_query($conexion, $sql);

            if ($resultado) {
                echo "Tablas en la base de datos:<br>";
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo htmlspecialchars($fila['TABLE_NAME']) . "<br>";
                }
            } else {
                echo "Error al obtener el esquema de la base de datos: " . mysqli_error($conexion);
            }

            desconectar($conexion);
        }

        mostrarEsquema();
        ?>
    </pre>
</body>
</html>