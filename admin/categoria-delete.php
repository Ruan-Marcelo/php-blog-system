<?php 
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) 
    && $_GET['id']) {

  $id = $_GET['id'];

  include_once("data/Categoria.php");
  include_once("../db_conn.php");
  $res = deleteById($conn, $id);
  if ($res) {
      $sm = "Excluído com sucesso!"; 
      header("Location: Categoria.php?success=$sm");
      exit;
  }else {
    $em = "Ocorreu um erro desconhecido"; 
    header("Location: Categoria.php?error=$em");
    exit;
  }

}else {
    header("Location: ../admin-login.php");
    exit;
}