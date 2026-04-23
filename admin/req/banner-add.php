<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {

include_once("../../db_conn.php");
include_once("../data/Banner.php");

if (isset($_POST['title']) && isset($_FILES['image'])) {

    $title = $_POST['title'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    // validação básica
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        header("Location: ../banner-add.php?error=Formato inválido");
        exit;
    }

    // nome único pra evitar conflito
    $newName = uniqid("banner_", true) . "." . $ext;

    $path = "../../upload/banners/" . $newName;

    if (move_uploaded_file($tmp, $path)) {

        addBanner($conn, $newName, $title);

        header("Location: ../Banner.php?success=Banner criado com sucesso");
        exit;

    } else {
        header("Location: ../banner-add.php?error=Erro ao enviar imagem");
        exit;
    }

} else {
    header("Location: ../banner-add.php?error=Preencha todos os campos");
    exit;
}

} else {
    header("Location: ../../admin-login.php");
    exit;
}