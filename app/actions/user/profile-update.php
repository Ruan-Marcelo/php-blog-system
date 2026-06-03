<?php
session_start();

if (!isset($_SESSION['user_id'], $_SESSION['username'])) {
    header("Location: ../../../login.php");
    exit;
}

include __DIR__ . "/../../../db_conn.php";

$user_id = $_SESSION['user_id'];
$action = $_POST['action'] ?? '';

if ($action === 'profile') {
    $fname = trim($_POST['fname'] ?? '');
    $username = trim($_POST['username'] ?? '');

    if ($fname === '') {
        header("Location: ../../../profile.php?error=O nome completo e obrigatorio");
        exit;
    }

    if ($username === '') {
        header("Location: ../../../profile.php?error=O nome de usuario e obrigatorio");
        exit;
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND id <> ?");
    $stmt->execute([$username, $user_id]);
    if ($stmt->fetch()) {
        header("Location: ../../../profile.php?error=Este nome de usuario ja esta em uso");
        exit;
    }

    $stmt = $conn->prepare("UPDATE users SET fname = ?, username = ? WHERE id = ?");
    $res = $stmt->execute([$fname, $username, $user_id]);

    if ($res) {
        $_SESSION['username'] = $username;
        header("Location: ../../../profile.php?success=Perfil atualizado com sucesso");
        exit;
    }

    header("Location: ../../../profile.php?error=Erro ao atualizar perfil");
    exit;
}

if ($action === 'password') {
    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($current === '' || $new === '' || $confirm === '') {
        header("Location: ../../../profile.php?perror=Preencha todos os campos de senha#senha");
        exit;
    }

    if ($new !== $confirm) {
        header("Location: ../../../profile.php?perror=A nova senha e a confirmacao nao conferem#senha");
        exit;
    }

    if (strlen($new) < 6) {
        header("Location: ../../../profile.php?perror=A nova senha deve ter pelo menos 6 caracteres#senha");
        exit;
    }

    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($current, $user['password'])) {
        header("Location: ../../../profile.php?perror=Senha atual incorreta#senha");
        exit;
    }

    $hash = password_hash($new, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $res = $stmt->execute([$hash, $user_id]);

    if ($res) {
        header("Location: ../../../profile.php?psuccess=Senha atualizada com sucesso#senha");
        exit;
    }

    header("Location: ../../../profile.php?perror=Erro ao atualizar senha#senha");
    exit;
}

header("Location: ../../../profile.php");
exit;
