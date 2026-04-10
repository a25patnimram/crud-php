<?php
$error = '';
$nom = $descripcio = $genere = $any_llancament = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'conexion.php';

    // Validació de dades
    $nom           = trim($_POST['nom'] ?? '');
    $descripcio    = trim($_POST['descripcio'] ?? '');
    $genere        = trim($_POST['genere'] ?? '');
    $any_llancament = trim($_POST['any_llancament'] ?? '');

    if (empty($nom) || empty($genere)) {
        $error = 'El nom i el gènere són obligatoris.';
    } elseif (!empty($any_llancament) && !ctype_digit($any_llancament)) {
        $error = "L'any ha de ser un número.";
    } else {
        // Consulta preparada (segura contra SQL Injection)
        $stmt = mysqli_prepare(
            $conexion,
            'INSERT INTO videojuegos (nom, descripcio, genere, any_llancament) VALUES (?, ?, ?, ?)'
        );
        mysqli_stmt_bind_param($stmt, 'sssi', $nom, $descripcio, $genere, $any_llancament);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: listar.php');
            exit;
        } else {
            $error = 'Error en inserir: ' . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afegir Videojoc</title>
    <link rel="stylesheet" href="css/estils.css">
</head>
<body>
<div class="container">
    <h1>➕ Afegir nou videojoc</h1>
    <a href="listar.php" class="btn">← Tornar al llistat</a>

    <?php if ($error): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" action="insertar.php">
        <div class="form-group">
            <label for="nom">Nom *</label>
            <input type="text" id="nom" name="nom"
                   value="<?php echo htmlspecialchars($nom); ?>" required>
        </div>

        <div class="form-group">
            <label for="descripcio">Descripció</label>
            <textarea id="descripcio" name="descripcio"
                      rows="3"><?php echo htmlspecialchars($descripcio); ?></textarea>
        </div>

        <div class="form-group">
            <label for="genere">Gènere *</label>
            <input type="text" id="genere" name="genere"
                   value="<?php echo htmlspecialchars($genere); ?>" required>
        </div>

        <div class="form-group">
            <label for="any_llancament">Any de llançament</label>
            <input type="number" id="any_llancament" name="any_llancament"
                   min="1970" max="2099"
                   value="<?php echo htmlspecialchars($any_llancament); ?>">
        </div>

        <button type="submit" class="btn btn-success">💾 Guardar</button>
    </form>
</div>
</body>
</html>
