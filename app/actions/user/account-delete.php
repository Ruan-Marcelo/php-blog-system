<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../login.php");
    exit;
}

include __DIR__ . "/../../../db_conn.php";

$userId = (int) $_SESSION['user_id'];

$stmt = $conn->prepare("DELETE FROM post_like WHERE liked_by = ?");
$stmt->execute([$userId]);

$stmt = $conn->prepare("DELETE FROM comment WHERE user_id = ?");
$stmt->execute([$userId]);

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$userId]);

session_unset();
session_destroy();

header("Location: ../../../login.php?success=Conta excluida com sucesso");
exit;
