<?php
session_start();

if (!isset($_SESSION['user_id'], $_POST['comment_id'], $_POST['post_id'], $_POST['comment'])) {
    header("Location: ../blog.php");
    exit;
}

include "../db_conn.php";

$userId = (int) $_SESSION['user_id'];
$commentId = (int) $_POST['comment_id'];
$postId = (int) $_POST['post_id'];
$comment = trim($_POST['comment']);

if ($comment === '') {
    header("Location: ../blog-view.php?post_id=$postId&error=O comentario nao pode ficar vazio#comments");
    exit;
}

$stmt = $conn->prepare("UPDATE comment SET comment = ? WHERE comment_id = ? AND user_id = ?");
$stmt->execute([$comment, $commentId, $userId]);

header("Location: ../blog-view.php?post_id=$postId&success=Comentario atualizado#comments");
exit;
