<?php
include_once("../db_conn.php");
include_once("data/Banner.php");

$id = $_GET['id'];

$banner = getBannerById($conn, $id);

// remove arquivo físico
if ($banner && file_exists("../upload/banners/" . $banner['image'])) {
    unlink("../upload/banners/" . $banner['image']);
}

// remove do banco
deleteBanner($conn, $id);

header("Location: Banner.php?success=Banner deletado");
exit;