<?php 
session_start();

if (
    isset($_SESSION['admin_id']) && 
    isset($_SESSION['username']) && 
    isset($_GET['id'])
) {

    $id = $_GET['id'];

    // valida ID
    if (!is_numeric($id)) {
        header("Location: ../animals.php?error=ID inválido");
        exit;
    }

    include_once("../db_conn.php");

    $stmt = $conn->prepare("SELECT image FROM animals WHERE id = ?");
    $stmt->execute([$id]);
    $animal = $stmt->fetch(PDO::FETCH_ASSOC);

    // deletar registro
    $sql = "DELETE FROM animals WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$id]);

    if ($res) {

        // apagar imagem do servidor 
        if (!empty($animal['image'])) {
            $imagePath = "../upload/animals/" . $animal['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        header("Location: animals.php?success=Animal excluído com sucesso!");
        exit;

    } else {
        header("Location: animals.php?error=Erro ao excluir animal");
        exit;
    }

} else {
    header("Location: ../admin-login.php");
    exit;
}