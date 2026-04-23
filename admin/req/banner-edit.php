<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {

include_once("../../db_conn.php");
include_once("../data/Banner.php");

$id = $_POST['id'];
$title = $_POST['title'];

$banner = getBannerById($conn, $id);

// se enviou nova imagem
if (!empty($_FILES['image']['name'])) {

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $path = "../../upload/banners/" . $image;
    move_uploaded_file($tmp, $path);

} else {
    $image = $banner['image'];
}

updateBanner($conn, $id, $image, $title);

header("Location: ../banner-edit.php?id=$id&success=Atualizado com sucesso");
exit;

} else {
    header("Location: ../../admin-login.php");
    exit;
}