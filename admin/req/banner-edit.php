<?php
session_start();

if (!isset($_SESSION['admin_id']) || !isset($_SESSION['username'])) {
    header("Location: ../../admin-login.php");
    exit;
}

include_once "../../db_conn.php";
include_once "../data/Banner.php";
include_once __DIR__ . "/upload-image.php";

if (!isset($_POST['id'], $_POST['title'])) {
    header("Location: ../Banner.php?error=Dados invalidos");
    exit;
}

$id = $_POST['id'];
$title = $_POST['title'];

$banner = getBannerById($conn, $id);
if (!$banner) {
    header("Location: ../Banner.php?error=Banner nao encontrado");
    exit;
}

if (!empty($_FILES['image']['name'])) {
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    if (!validar_imagem_enviada($_FILES['image'], $allowed, 2000000, $ext, $em)) {
        header("Location: ../banner-edit.php?id=$id&error=$em");
        exit;
    }

    $image = uniqid("banner_", true) . "." . $ext;
    $path = "../../upload/banners/" . $image;

    if (!mover_imagem_enviada($_FILES['image'], $path, $em)) {
        header("Location: ../banner-edit.php?id=$id&error=$em");
        exit;
    }

    if (!empty($banner['image'])) {
        @unlink("../../upload/banners/" . basename($banner['image']));
    }
} else {
    $image = $banner['image'];
}

updateBanner($conn, $id, $image, $title);

header("Location: ../banner-edit.php?id=$id&success=Atualizado com sucesso");
exit;
