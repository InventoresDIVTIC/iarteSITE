<?php
session_start();
header('Content-Type: application/json');

$response = array();

if (isset($_SESSION['correo'])) {
    // Usuario está autenticado
    $response['status'] = 'success';
    $response['correo'] = $_SESSION['correo'];
    $response['nacionalidad'] = $_SESSION['nacionalidad'];
    $response['nombre'] = $_SESSION['nombre'];
} else {
    // Usuario no está autenticado
    $response['status'] = 'error';
    $response['message'] = 'No autenticado';
}

echo json_encode($response);
?>