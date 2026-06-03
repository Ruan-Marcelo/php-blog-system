<?php
session_start();

include __DIR__ . "/../../../db_conn.php";
include __DIR__ . "/../../../site_config.php";

$siteSettings = get_site_settings($conn);

if (!isset($_SESSION['user_id'], $_SESSION['username'])) {
	header("Location: ../blog.php");
	exit;
}

if ($siteSettings['comments_enabled'] !== '1') {
	header("Location: ../blog.php");
	exit;
}

if (!isset($_POST['comment'], $_POST['post_id'])) {
	header("Location: ../blog.php");
	exit;
}

$comment = trim($_POST['comment']);
$post_id = (int) $_POST['post_id'];
$user_id = (int) $_SESSION['user_id'];

if ($comment === '') {
	$em = "O comentario nao pode ser vazio";
	header("Location: ../blog-view.php?error=$em&post_id=$post_id#comments");
	exit;
}

$sql = "INSERT INTO comment(comment, user_id, post_id) VALUES(?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$comment, $user_id, $post_id]);

header("Location: ../blog-view.php?success=Comentario adicionado com sucesso&post_id=$post_id#comments");
exit;
