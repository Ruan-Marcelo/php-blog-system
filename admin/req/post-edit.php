<?php
session_start();

if (!isset($_SESSION['admin_id']) || !isset($_SESSION['username'])) {
    header("Location: ../admin-login.php");
    exit;
}

if (
    !isset($_POST['title']) ||
    !isset($_FILES['cover']) ||
    !isset($_POST['text']) ||
    !isset($_POST['post_id']) ||
    !isset($_POST['cover_url']) ||
    !isset($_POST['category'])
) {
    header("Location: ../Post.php");
    exit;
}

include "../../db_conn.php";
include_once __DIR__ . "/upload-image.php";

$title = $_POST['title'];
$text = $_POST['text'];
$post_id = $_POST['post_id'];
$cu = $_POST['cover_url'];
$category_id = $_POST['category'];

if (empty($title)) {
    $em = "O titulo e obrigatorio";
    header("Location: ../post-edit.php?error=$em&post_id=$post_id");
    exit;
}

$image_name = $_FILES['cover']['name'];

if ($image_name !== "") {
    $allowed_exs = ['jpg', 'jpeg', 'png'];
    if (!validar_imagem_enviada($_FILES['cover'], $allowed_exs, 130000, $image_ex, $em)) {
        header("Location: ../post-edit.php?error=$em&post_id=$post_id");
        exit;
    }

    $new_image_name = uniqid("COVER-", true) . '.' . $image_ex;
    $image_path = '../../upload/blog/' . $new_image_name;
    if (!mover_imagem_enviada($_FILES['cover'], $image_path, $em)) {
        header("Location: ../post-edit.php?error=$em&post_id=$post_id");
        exit;
    }

    if ($cu !== "default.jpg") {
        @unlink("../../upload/blog/" . basename($cu));
    }

    $sql = "UPDATE post SET post_title=?, post_text=?, cover_url=?, category=? WHERE post_id=?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$title, $text, $new_image_name, $category_id, $post_id]);
} else {
    $sql = "UPDATE post SET post_title=?, post_text=?, category=? WHERE post_id=?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$title, $text, $category_id, $post_id]);
}

if ($res) {
    $sm = "Atualizado com sucesso!";
    header("Location: ../post-edit.php?success=$sm&post_id=$post_id");
    exit;
}

$em = "Ocorreu um erro desconhecido";
header("Location: ../post-edit.php?error=$em&post_id=$post_id");
exit;
