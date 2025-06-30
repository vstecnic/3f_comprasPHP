<?php
include("connection.php");
$con = connection();

// Recibir datos del formulario
$producto = $_POST['producto'];
$nombre_producto = $_POST['nombre_producto'];
$cantidad = $_POST['cantidad'];
$precio_unitario = $_POST['precio_unitario'];
$notas = $_POST['notas'];

// Validación básica de datos
if(empty($producto) || empty($nombre_producto) || empty($cantidad) ) {
    die("Error: Faltan campos obligatorios");
}

// Prevenir inyección SQL
$producto = mysqli_real_escape_string($con, $producto);
$nombre_producto = mysqli_real_escape_string($con, $nombre_producto);
$cantidad = intval($cantidad);
$precio_unitario = floatval($precio_unitario);
$notas = mysqli_real_escape_string($con, $notas);

// Consulta SQL actualizada (sin ID y con el campo 'producto')
$sql = "INSERT INTO compras (producto, nombre_producto, cantidad, precio_unitario, notas) 
        VALUES ('$producto', '$nombre_producto', $cantidad, $precio_unitario, '$notas')";

// Ejecutar consulta
$query = mysqli_query($con, $sql);

if($query){
    header("Location: index.php");
    exit();
} else {
    // Mostrar error detallado en desarrollo (quitar en producción)
    die("Error al insertar: " . mysqli_error($con));
}