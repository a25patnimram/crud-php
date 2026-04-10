<?php
require_once 'conexion.php';

$resultado = mysqli_query($conexion, 'SELECT * FROM videojuegos ORDER BY id ASC');
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llistat de Videojocs</title>
    <link rel="stylesheet" href="css/estils.css">
</head>
<body>
<div class="container">
    <h1>🎮 Llistat de Videojocs</h1>
    <a href="insertar.php" class="btn btn-success">+ Afegir nou videojoc</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Descripció</th>
                <th>Gènere</th>
                <th>Any</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($resultado) > 0): ?>
            <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?php echo htmlspecialchars($fila['id']); ?></td>
                <td><?php echo htmlspecialchars($fila['nom']); ?></td>
                <td><?php echo htmlspecialchars($fila['descripcio']); ?></td>
                <td><?php echo htmlspecialchars($fila['genere']); ?></td>
                <td><?php echo htmlspecialchars($fila['any_llancament']); ?></td>
                <td class="accions">
                    <a href="editar.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning">✏️ Editar</a>
                    <a href="eliminar.php?id=<?php echo $fila['id']; ?>"
                       class="btn btn-danger"
                       onclick="return confirm('Segur que vols eliminar aquest videojoc?')">
                        🗑️ Eliminar
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">No hi ha videojocs registrats.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
