<?php 
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) 
    && $_GET['user_id']) {

  $user_id = $_GET['user_id'];

  include_once("data/User.php");
  include_once("../db_conn.php");
  $res = deleteById($conn, $user_id);
  if ($res) {
      $sm = "Usuario excluido com sucesso!"; 
      header("Location: users.php?success=$sm");
      exit;
  }else {
    $em = "Ocorreu um erro ao excluir o usuario"; 
    header("Location: users.php?error=$em");
    exit;
  }

}else {
    header("Location: ../admin-login.php");
    exit;
}
