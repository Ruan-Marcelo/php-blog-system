<?php
session_start();

if (!isset($_SESSION['admin_id']) || !isset($_SESSION['username'])) {
    header("Location: ../admin-login.php");
    exit;
}

if (
    !isset($_POST['name']) ||
    !isset($_POST['species']) ||
    !isset($_POST['age']) ||
    !isset($_POST['description']) ||
    !isset($_POST['id'])
) {
    header("Location: ../animals.php");
    exit;
}

include "../../db_conn.php";
include_once __DIR__ . "/upload-image.php";

$id = $_POST['id'];
$name = trim($_POST['name']);
$species = trim($_POST['species']);
$age = trim($_POST['age']);
$description = trim($_POST['description']);
$old_image = $_POST['image_old'] ?? 'default.jpg';
$_SESSION['old_animal_edit'][$id] = [
    'name' => $name,
    'species' => $species,
    'age' => $age,
    'description' => $description,
];

if (empty($name)) {
    header("Location: ../animal-edit.php?error=Nome obrigatorio&id=$id");
    exit;
}

if (preg_match('/\d/', $name)) {
    header("Location: ../animal-edit.php?error=O nome nao pode conter numeros&id=$id");
    exit;
}

if ($species === '' || preg_match('/\d/', $species)) {
    header("Location: ../animal-edit.php?error=A especie e obrigatoria e nao pode conter numeros&id=$id");
    exit;
}

if ($age === '' || !is_numeric($age) || (float) $age < 0 || (float) $age > 50) {
    header("Location: ../animal-edit.php?error=Informe uma idade valida entre 0 e 50&id=$id");
    exit;
}

if ($description === '') {
    header("Location: ../animal-edit.php?error=A descricao e obrigatoria&id=$id");
    exit;
}

$image_name = $_FILES['image']['name'] ?? '';

if ($image_name !== "") {
    $allowed = ['jpg', 'jpeg', 'png'];
    if (!validar_imagem_enviada($_FILES['image'], $allowed, 2000000, $img_ex, $em)) {
        header("Location: ../animal-edit.php?error=$em&id=$id");
        exit;
    }

    $new_name = uniqid("ANIMAL-", true) . '.' . $img_ex;
    $path = "../../upload/animals/" . $new_name;

    if (!mover_imagem_enviada($_FILES['image'], $path, $em)) {
        header("Location: ../animal-edit.php?error=$em&id=$id");
        exit;
    }

    if ($old_image !== "default.jpg") {
        @unlink("../../upload/animals/" . basename($old_image));
    }

    $sql = "UPDATE animals SET name=?, species=?, age=?, description=?, image=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$name, $species, $age, $description, $new_name, $id]);
} else {
    $sql = "UPDATE animals SET name=?, species=?, age=?, description=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$name, $species, $age, $description, $id]);
}

if ($res) {
    unset($_SESSION['old_animal_edit'][$id]);
    header("Location: ../animal-edit.php?success=Atualizado&id=$id");
    exit;
}

header("Location: ../animal-edit.php?error=Erro&id=$id");
exit;
