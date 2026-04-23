<?php 

// Get All 
function getAllComment($conn){
   $sql = "SELECT * FROM comment";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// getById
function getCommentById($conn, $id){
   $sql = "SELECT * FROM comment WHERE comment_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   $data = $stmt->fetch(PDO::FETCH_ASSOC);

   return $data ?: null;
}
function CountByPostID($conn, $id){
   $sql = "SELECT COUNT(*) as total FROM comment WHERE post_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}
// LIKE count
function likeCountByPostID($conn, $id){
   $sql = "SELECT COUNT(*) as total FROM post_like WHERE post_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}
//isliked
function isLikedByUserID($conn, $post_id, $user_id){
   $sql = "SELECT 1 FROM post_like WHERE post_id=? AND liked_by=? LIMIT 1";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$post_id, $user_id]);

   return $stmt->fetch() ? 1 : 0;
}
function getCommentsByPostID($conn, $id){
   $sql = "SELECT * FROM comment WHERE post_id=? ORDER BY comment_id DESC";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Delete By ID
function deleteCommentById($conn, $id){
   $sql = "DELETE FROM comment WHERE comment_id=?";
   $stmt = $conn->prepare($sql);

   return $stmt->execute([$id]);
}
function deleteCommentByPostId($conn, $id){
   $sql = "DELETE FROM comment WHERE post_id=?";
   $stmt = $conn->prepare($sql);
   $res = $stmt->execute([$id]);

   if($res){
         return 1;
   }else {
       return 0;
   }
}

function deleteLikeByPostId($conn, $id){
   $sql = "DELETE FROM post_like WHERE post_id=?";
   $stmt = $conn->prepare($sql);

   return $stmt->execute([$id]);
}