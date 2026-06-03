<?php
session_start();

if (!isset($_SESSION['admin_id']) || !isset($_SESSION['username'])) {
    header("Location: ../admin-login.php");
    exit;
}

if (
    !isset($_POST['title']) ||
    !isset($_FILES['cover']) ||
    !isset($_POST['category']) ||
    !isset($_POST['text'])
) {
    header("Location: ../post-add.php");
    exit;
}

include "../../db_conn.php";
include_once __DIR__ . "/upload-image.php";

$title = trim($_POST['title']);
$text = trim($_POST['text']);
$category = $_POST['category'];
$_SESSION['old_post'] = [
    'title' => $title,
    'text' => $text,
    'category' => $category,
];

if (empty($title)) {
    $em = "O titulo e obrigatorio";
    header("Location: ../post-add.php?error=$em");
    exit;
}

if ($text === '') {
    $em = "O conteudo e obrigatorio";
    header("Location: ../post-add.php?error=$em");
    exit;
}

if (strlen($text) > 65000) {
    $em = "O conteudo ultrapassa o limite permitido";
    header("Location: ../post-add.php?error=$em");
    exit;
}

if (empty($category)) {
    $category = 0;
}

$image_name = $_FILES['cover']['name'];

if ($image_name !== "") {
    $allowed_exs = ['jpg', 'jpeg', 'png'];
    if (!validar_imagem_enviada($_FILES['cover'], $allowed_exs, 130000, $image_ex, $em)) {
        header("Location: ../post-add.php?error=$em");
        exit;
    }

    $new_image_name = uniqid("COVER-", true) . '.' . $image_ex;
    $image_path = '../../upload/blog/' . $new_image_name;
    if (!mover_imagem_enviada($_FILES['cover'], $image_path, $em)) {
        header("Location: ../post-add.php?error=$em");
        exit;
    }

    $sql = "INSERT INTO post(post_title, post_text, category, cover_url) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$title, $text, $category, $new_image_name]);
} else {
    $sql = "INSERT INTO post(post_title, post_text, category) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$title, $text, $category]);
}

if ($res) {
    unset($_SESSION['old_post']);
    $sm = "Criado com sucesso!";
    header("Location: ../post-add.php?success=$sm");
    exit;
}

$em = "Ocorreu um erro desconhecido";
header("Location: ../post-add.php?error=$em");
exit;
