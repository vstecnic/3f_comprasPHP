<?php
include("connection.php");
$con = connection();

if(!isset($_POST['id'])) {
    die("Error: No se recibió el ID de la compra");
}

$id = intval($_POST['id']);
$producto = mysqli_real_escape_string($con, $_POST['producto'] ?? '');
$nombre_producto = mysqli_real_escape_string($con, $_POST['nombre_producto'] ?? '');
$cantidad = intval($_POST['cantidad'] ?? 0);
$precio_unitario = floatval($_POST['precio_unitario'] ?? 0);
$notas = mysqli_real_escape_string($con, $_POST['notas'] ?? '');

// Validación
if(empty($producto) || empty($nombre_producto) || $cantidad <= 0 || $precio_unitario <= 0) {
    die("Error: Todos los campos obligatorios deben estar completos");
}

$sql = "UPDATE compras SET 
        producto = '$producto',
        nombre_producto = '$nombre_producto',
        cantidad = $cantidad,
        precio_unitario = $precio_unitario,
        notas = '$notas'
        WHERE id = $id";

$query = mysqli_query($con, $sql);

if($query){
    header("Location: index.php");
    exit();
} else {
    die("Error al actualizar: " . mysqli_error($con));
}