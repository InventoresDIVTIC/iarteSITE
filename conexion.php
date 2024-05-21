<?php
    $server = "localhost";
    $db = "qwsuvdzd_iarte";
    $usr = "qwsuvdzd_iarte";
    $pass = "G4adalajara2020*";

    function conectar(){
        global $server, $usr, $pass, $db;
        $conexion = new mysqli($server, $usr, $pass, $db);
        $conexion->set_charset("utf8");
        
        // Comprobar la conexión
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        } else {
            echo "conectadisimo<br>";
            return $conexion;
        }   
    }

    function desconectar($conexion){
        mysqli_close($conexion);
    }

    // Ejecutar query
    function ejecutar($conexion, $query){
        if(mysqli_query($conexion, $query)){
            return true;    
        } else {
            echo mysqli_error($conexion);
        }
    }

    // Ejecutar select
    function select($conexion, $query){
        return mysqli_query($conexion, $query);
    }
?>
