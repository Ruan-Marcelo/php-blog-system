<?php
session_start();

if (!isset($_SESSION['admin_id']) || !isset($_SESSION['username'])) {
    header("Location: ../admin-login.php");
    exit;
}

if (!isset($_POST['name'], $_POST['species'], $_POST['age'], $_POST['description'])) {
    header("Location: ../animal-add.php");
    exit;
}

include "../../db_conn.php";
include_once __DIR__ . "/upload-image.php";

$name = trim($_POST['name']);
$species = trim($_POST['species']);
$age = trim($_POST['age']);
$description = trim($_POST['description']);
$_SESSION['old_animal'] = [
    'name' => $name,
    'species' => $species,
    'age' => $age,
    'description' => $description,
];

if (empty($name)) {
    $em = "O nome e obrigatorio";
    header("Location: ../animal-add.php?error=$em");
    exit;
}

if (preg_match('/\d/', $name)) {
    $em = "O nome nao pode conter numeros";
    header("Location: ../animal-add.php?error=$em");
    exit;
}

if ($species === '' || preg_match('/\d/', $species)) {
    $em = "A especie e obrigatoria e nao pode conter numeros";
    header("Location: ../animal-add.php?error=$em");
    exit;
}

if ($age === '' || !is_numeric($age) || (float) $age < 0 || (float) $age > 50) {
    $em = "Informe uma idade valida entre 0 e 50";
    header("Location: ../animal-add.php?error=$em");
    exit;
}

if ($description === '') {
    $em = "A descricao e obrigatoria";
    header("Location: ../animal-add.php?error=$em");
    exit;
}

$new_name = null;

if (!empty($_FILES['image']['name'])) {
    $allowed = ['jpg', 'jpeg', 'png'];
    if (!validar_imagem_enviada($_FILES['image'], $allowed, 2000000, $img_ex, $em)) {
        header("Location: ../animal-add.php?error=$em");
        exit;
    }

    $new_name = uniqid("ANIMAL-", true) . '.' . $img_ex;
    $path = "../../upload/animals/" . $new_name;

    if (!mover_imagem_enviada($_FILES['image'], $path, $em)) {
        header("Location: ../animal-add.php?error=$em");
        exit;
    }
}

if ($new_name) {
    $sql = "INSERT INTO animals (name, species, age, description, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$name, $species, $age, $description, $new_name]);
} else {
    $sql = "INSERT INTO animals (name, species, age, description) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$name, $species, $age, $description]);
}

if ($res) {
    unset($_SESSION['old_animal']);
    $sm = "Animal criado com sucesso!";
    header("Location: ../animal-add.php?success=$sm");
    exit;
}

$em = "Erro ao criar animal";
header("Location: ../animal-add.php?error=$em");
exit;
