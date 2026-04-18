<?php 
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) ) {

    if(isset($_POST['fname']) && 
       isset($_POST['lname']) &&
       isset($_POST['username'])){

      include "../../db_conn.php";
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $username = $_POST['username'];
      $id = $_SESSION['admin_id'];

      if(empty($fname)){
         $em = "O primeiro nome é obrigatório"; 
         header("Location: ../profile.php?error=$em");
         exit;
      }else if(empty($lname)){
         $em = "O sobrenome é obrigatório"; 
         header("Location: ../profile.php?error=$em");
         exit;
      }else if(empty($username)){
         $em = "O nome de usuário é obrigatório"; 
         header("Location: ../profile.php?error=$em");
         exit;
      }
    
      $sql = "UPDATE admin SET first_name=?, last_name=?, username=? WHERE id=?";
      $stmt = $conn->prepare($sql);
      $res = $stmt->execute([$fname,$lname,$username, $id]);
    
      
     if ($res) {
        $_SESSION['username'] = $username;
          $sm = "Editado com sucesso!"; 
          header("Location: ../profile.php?success=$sm");
          exit;
      }else {
        $em = "Ocorreu um erro desconhecido"; 
        header("Location: ../profile.php?error=$em");
        exit;
      }


    }else {
        header("Location: ../profile.php");
        exit;
    }


}else {
    header("Location: ../admin-login.php");
    exit;
} 