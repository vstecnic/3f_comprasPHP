<?php
include("connection.php");
$con = connection();

if(!isset($_GET['id'])) {
    die("Error: No se recibió el ID de la compra");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM compras WHERE id = $id";
$query = mysqli_query($con, $sql);
$compra = mysqli_fetch_assoc($query);

if(!$compra) {
    die("Error: Compra no encontrada");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Compra</title>
    <link href="CSS/style.css" rel="stylesheet">
</head>
<body>
    <div class="users-form">
        <h1>Editar Compra</h1>
        <form action="edit-compra.php" method="POST">
            <input type="hidden" name="id" value="<?= $compra['id'] ?>">
            
            <div class="form-group">
                <label>Tipo de Producto:</label>
                <select name="producto" required>
                    <option value="comida" <?= $compra['producto'] == 'comida' ? 'selected' : '' ?>>Comida</option>
                    <option value="limpieza" <?= $compra['producto'] == 'limpieza' ? 'selected' : '' ?>>Limpieza</option>
                    <option value="bazar" <?= $compra['producto'] == 'bazar' ? 'selected' : '' ?>>Bazar</option>
                    <option value="perfumeria" <?= $compra['producto'] == 'perfumeria' ? 'selected' : '' ?>>Perfumería</option>
                    <option value="otro" <?= $compra['producto'] == 'otro' ? 'selected' : '' ?>>Otro</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Nombre del Producto:</label>
                <input type="text" name="nombre_producto" value="<?= htmlspecialchars($compra['nombre_producto']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Cantidad:</label>
                <input type="number" name="cantidad" value="<?= $compra['cantidad'] ?>" min="1" required>
            </div>
            
            <div class="form-group">
                <label>Precio Unitario:</label>
                <input type="number" name="precio_unitario" value="<?= $compra['precio_unitario'] ?>" step="0.01" min="0" required>
            </div>
            
            <div class="form-group">
                <label>Notas:</label>
                <input type="text" name="notas" value="<?= htmlspecialchars($compra['notas']) ?>">
            </div>

            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>