<?php
require_once 'conexion.php';

// Validar que l'ID és un número
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: listar.php');
    exit;
}

// Obtenir el registre actual
$stmt = mysqli_prepare($conexion, 'SELECT * FROM videojuegos WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$videojoc  = mysqli_fetch_assoc($resultado);
mysqli_stmt_close($stmt);

if (!$videojoc) {
    header('Location: listar.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Videojoc</title>
    <link rel="stylesheet" href="css/estils.css">
</head>
<body>
<div class="container">
    <h1>✏️ Editar videojoc</h1>
    <a href="listar.php" class="btn">← Tornar al llistat</a>

    <form method="POST" action="actualizar.php">
        <input type="hidden" name="id" value="<?php echo $videojoc['id']; ?>">

        <div class="form-group">
            <label for="nom">Nom *</label>
            <input type="text" id="nom" name="nom"
                   value="<?php echo htmlspecialchars($videojoc['nom']); ?>" required>
        </div>

        <div class="form-group">
            <label for="descripcio">Descripció</label>
            <textarea id="descripcio" name="descripcio"
                      rows="3"><?php echo htmlspecialchars($videojoc['descripcio']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="genere">Gènere *</label>
            <input type="text" id="genere" name="genere"
                   value="<?php echo htmlspecialchars($videojoc['genere']); ?>" required>
        </div>

        <div class="form-group">
            <label for="any_llancament">Any de llançament</label>
            <input type="number" id="any_llancament" name="any_llancament"
                   min="1970" max="2099"
                   value="<?php echo htmlspecialchars($videojoc['any_llancament']); ?>">
        </div>

        <button type="submit" class="btn btn-warning">💾 Actualitzar</button>
    </form>
</div>
</body>
</html>
