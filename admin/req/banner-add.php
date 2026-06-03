<?php
session_start();

if (!isset($_SESSION['admin_id']) || !isset($_SESSION['username'])) {
    header("Location: ../../admin-login.php");
    exit;
}

include_once "../../db_conn.php";
include_once "../data/Banner.php";
include_once __DIR__ . "/upload-image.php";

if (!isset($_POST['title']) || !isset($_FILES['image'])) {
    header("Location: ../banner-add.php?error=Preencha todos os campos");
    exit;
}

$title = $_POST['title'];
$allowed = ['jpg', 'jpeg', 'png', 'webp'];

if (!validar_imagem_enviada($_FILES['image'], $allowed, 2000000, $ext, $em)) {
    header("Location: ../banner-add.php?error=$em");
    exit;
}

$newName = uniqid("banner_", true) . "." . $ext;
$path = "../../upload/banners/" . $newName;

if (!mover_imagem_enviada($_FILES['image'], $path, $em)) {
    header("Location: ../banner-add.php?error=$em");
    exit;
}

addBanner($conn, $newName, $title);

header("Location: ../Banner.php?success=Banner criado com sucesso");
exit;
