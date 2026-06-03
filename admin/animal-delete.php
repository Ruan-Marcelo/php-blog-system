<?php
session_start();

if (!isset($_SESSION['admin_id'], $_SESSION['username'], $_GET['id'])) {
    header("Location: ../admin-login.php");
    exit;
}

$id = $_GET['id'];

if (!is_numeric($id)) {
    header("Location: animals.php?error=ID invalido");
    exit;
}

include_once("../db_conn.php");

$stmt = $conn->prepare("SELECT image FROM animals WHERE id = ?");
$stmt->execute([$id]);
$animal = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "DELETE FROM animals WHERE id = ?";
$stmt = $conn->prepare($sql);
$res = $stmt->execute([$id]);

if ($res) {
    if (!empty($animal['image']) && $animal['image'] !== 'default.jpg') {
        $imagePath = "../upload/animals/" . basename($animal['image']);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    header("Location: animals.php?success=Animal excluido com sucesso!");
    exit;
}

header("Location: animals.php?error=Erro ao excluir animal");
exit;
