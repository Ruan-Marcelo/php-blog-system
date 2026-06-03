<?php
session_start();

if (!isset($_SESSION['user_id'], $_POST['comment_id'], $_POST['post_id'])) {
    header("Location: ../../../blog.php");
    exit;
}

include __DIR__ . "/../../../db_conn.php";

$userId = (int) $_SESSION['user_id'];
$commentId = (int) $_POST['comment_id'];
$postId = (int) $_POST['post_id'];

$stmt = $conn->prepare("DELETE FROM comment WHERE comment_id = ? AND user_id = ?");
$stmt->execute([$commentId, $userId]);

header("Location: ../../../blog-view.php?post_id=$postId&success=Comentario excluido#comments");
exit;
