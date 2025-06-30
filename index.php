<?php
include("connection.php");
$con = connection();

$sql = "SELECT * FROM compras ORDER BY id DESC";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Compras</title>
    <link href="CSS/style.css" rel="stylesheet">
    <style>
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        select, input { width: 100%; padding: 8px; box-sizing: border-box; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        .compras-table--edit { color: #2196F3; margin-right: 10px; }
        .compras-table--delete { color: #F44336; }
    </style>
</head>
<body>
    <div class="users-form">
        <h1>Listado de Compras</h1>
        <form action="insert_compra.php" method="POST">
            <div class="form-group">
                <label for="producto">Tipo de Producto:</label>
                <select name="producto" id="producto" required>
                    <option value="">Seleccione tipo</option>
                    <option value="comida">Comida</option>
                    <option value="limpieza">Limpieza</option>
                    <option value="bazar">Bazar</option>
                    <option value="perfumeria">Perfumería</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="nombre_producto">Nombre del Producto:</label>
                <input type="text" name="nombre_producto" id="nombre_producto" placeholder="Ej: Leche entera, Jabón líquido..." required>
            </div>
            
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" min="1" required>
            </div>
            
            <div class="form-group">
                <label for="precio_unitario">Precio Unitario:</label>
                <input type="number" name="precio_unitario" id="precio_unitario" step="0.01" min="0">
            </div>
            
            <div class="form-group">
                <label for="notas">Notas (opcional):</label>
                <input type="text" name="notas" id="notas" placeholder="Detalles adicionales">
            </div>

            <input type="submit" value="Agregar Compra">
        </form>
    </div>

    <div class="compras-table">
        <h2>Compras Registradas</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                    <th>Notas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($query)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= ucfirst($row['producto']) ?></td>
                        <td><?= htmlspecialchars($row['nombre_producto']) ?></td>
                        <td><?= $row['cantidad'] ?></td>
                        <td>$<?= number_format($row['precio_unitario'], 2) ?></td>
                        <td>$<?= number_format($row['total'], 2) ?></td>
                        <td><?= htmlspecialchars($row['notas']) ?></td>
                        <td>
                            <a href="update.php?id=<?= $row['id'] ?>" class="compras-table--edit">Editar</a>
                            <a href="delete_compra.php?id=<?= $row['id'] ?>" class="compras-table--delete" onclick="return confirm('¿Eliminar esta compra?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>