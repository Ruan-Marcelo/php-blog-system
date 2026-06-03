<?php 
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) ) {

    if(isset($_POST['category']) && isset($_POST['id'])){
      include "../../db_conn.php";
      $category = trim($_POST['category']);
      $id = $_POST['id'];

      if($category === ''){
         $em = "A categoria é obrigatória"; 
         header("Location: ../categoria-edit.php?error=$em&id=$id");
         exit;
      }
    
      $sql = "UPDATE category SET category=? WHERE id=?";
      $stmt = $conn->prepare($sql);
      $res = $stmt->execute([$category, $id]);
    
      
     if ($res) {
          $sm = "Editado com sucesso!"; 
          header("Location: ../categoria-edit.php?success=$sm&category=$category&id=$id");
          exit;
      }else {
        $em = "Ocorreu um erro desconhecido"; 
        header("Location: ../categoria-edit.php?error=$em&id=$id");
        exit;
      }


    }else {
        header("Location: ../categoria-edit.php");
        exit;
    }


}else {
    header("Location: ../admin-login.php");
    exit;
} 
