<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: listar.php');
    exit;
}

// Recollida i validació de dades
$id             = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nom            = trim($_POST['nom'] ?? '');
$descripcio     = trim($_POST['descripcio'] ?? '');
$genere         = trim($_POST['genere'] ?? '');
$any_llancament = trim($_POST['any_llancament'] ?? '');

if (!$id || empty($nom) || empty($genere)) {
    header('Location: listar.php');
    exit;
}

// Consulta preparada per actualitzar
$stmt = mysqli_prepare(
    $conexion,
    'UPDATE videojuegos SET nom = ?, descripcio = ?, genere = ?, any_llancament = ? WHERE id = ?'
);
mysqli_stmt_bind_param($stmt, 'sssii', $nom, $descripcio, $genere, $any_llancament, $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header('Location: listar.php');
exit;
