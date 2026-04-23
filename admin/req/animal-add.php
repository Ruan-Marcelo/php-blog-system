<?php 
session_start();

if (!isset($_SESSION['admin_id']) || !isset($_SESSION['username'])) {
    header("Location: ../admin-login.php");
    exit;
}

if (
    isset($_POST['name'], $_POST['species'], $_POST['age'], $_POST['description'])
) {

    include "../../db_conn.php";

    $name = $_POST['name'];
    $species = $_POST['species'];
    $age = $_POST['age'];
    $description = $_POST['description'];

    if (empty($name)) {
        $em = "O nome é obrigatório";
        header("Location: ../animal-add.php?error=$em");
        exit;
    }

    $new_name = null;

    // =========================
    // TRATAMENTO DA IMAGEM
    // =========================
    if (!empty($_FILES['image']['name'])) {

        $image_name = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        if ($error === 0) {

            if ($image_size > 2000000) {
                $em = "Imagem muito grande!";
                header("Location: ../animal-add.php?error=$em");
                exit;
            }

            $img_ex = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png'];

            if (!in_array($img_ex, $allowed)) {
                $em = "Tipo de imagem inválido!";
                header("Location: ../animal-add.php?error=$em");
                exit;
            }

            $new_name = uniqid("ANIMAL-", true) . '.' . $img_ex;
            $path = "../../upload/animals/" . $new_name;

            move_uploaded_file($tmp_name, $path);
        }
    }

    // =========================
    // INSERT ÚNICO
    // =========================
    if ($new_name) {
        $sql = "INSERT INTO animals (name, species, age, description, image)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $res = $stmt->execute([$name, $species, $age, $description, $new_name]);
    } else {
        $sql = "INSERT INTO animals (name, species, age, description)
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $res = $stmt->execute([$name, $species, $age, $description]);
    }

    if ($res) {
        $sm = "Animal criado com sucesso!";
        header("Location: ../animal-add.php?success=$sm");
    } else {
        $em = "Erro ao criar animal";
        header("Location: ../animal-add.php?error=$em");
    }

    exit;

} else {
    header("Location: ../animal-add.php");
    exit;
}