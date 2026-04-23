<?php 
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {

    if(
        isset($_POST['name']) && 
        isset($_POST['species']) && 
        isset($_POST['age']) && 
        isset($_POST['description']) &&
        isset($_POST['id'])
    ){

        include "../../db_conn.php";

        $id = $_POST['id'];
        $name = $_POST['name'];
        $species = $_POST['species'];
        $age = $_POST['age'];
        $description = $_POST['description'];

        if(empty($name)){
            header("Location: ../animal-edit.php?error=Nome obrigatório&id=$id");
            exit;
        }

        $image_name = $_FILES['image']['name'];
        $old_image = $_POST['image_old'];

        if ($image_name != "") {

            $tmp_name = $_FILES['image']['tmp_name'];
            $error = $_FILES['image']['error'];
            $size = $_FILES['image']['size'];

            if ($error === 0) {

                if ($size > 2000000) {
                    header("Location: ../animal-edit.php?error=Imagem muito grande&id=$id");
                    exit;
                }

                $img_ex = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                $allowed = ['jpg','jpeg','png'];

                if (in_array($img_ex, $allowed)) {

                    $new_name = uniqid("ANIMAL-", true).'.'.$img_ex;
                    $path = "../../upload/animals/".$new_name;

                    move_uploaded_file($tmp_name, $path);

                    // remove antiga
                    if ($old_image != "default.jpg") {
                        @unlink("../../upload/animals/".$old_image);
                    }

                    $sql = "UPDATE animals 
                            SET name=?, species=?, age=?, description=?, image=? 
                            WHERE id=?";
                    $stmt = $conn->prepare($sql);
                    $res = $stmt->execute([$name,$species,$age,$description,$new_name,$id]);

                } else {
                    header("Location: ../animal-edit.php?error=Tipo inválido&id=$id");
                    exit;
                }
            }

        } else {
            // sem imagem nova
            $sql = "UPDATE animals 
                    SET name=?, species=?, age=?, description=? 
                    WHERE id=?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$name,$species,$age,$description,$id]);
        }

        if ($res) {
            header("Location: ../animal-edit.php?success=Atualizado&id=$id");
        } else {
            header("Location: ../animal-edit.php?error=Erro&id=$id");
        }
        exit;

    } else {
        header("Location: ../animals.php");
        exit;
    }

} else {
    header("Location: ../admin-login.php");
    exit;
}