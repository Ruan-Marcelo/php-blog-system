<?php
session_start();

if (!isset($_POST['uname'], $_POST['fname'], $_POST['new_password'], $_POST['confirm_password'])) {
    header("Location: ../forgot-password.php");
    exit;
}

include "../db_conn.php";

$uname = trim($_POST['uname']);
$fname = trim($_POST['fname']);
$newPassword = $_POST['new_password'];
$confirmPassword = $_POST['confirm_password'];

$query = http_build_query([
    'uname' => $uname,
    'fname' => $fname,
]);

if ($uname === '' || $fname === '') {
    header("Location: ../forgot-password.php?error=Preencha usuario e nome completo&$query");
    exit;
}

if ($newPassword === '' || $confirmPassword === '') {
    header("Location: ../forgot-password.php?error=Preencha a nova senha&$query");
    exit;
}

if ($newPassword !== $confirmPassword) {
    header("Location: ../forgot-password.php?error=A nova senha e a confirmacao nao conferem&$query");
    exit;
}

if (strlen($newPassword) < 6) {
    header("Location: ../forgot-password.php?error=A senha deve ter pelo menos 6 caracteres&$query");
    exit;
}

$stmt = $conn->prepare("SELECT id, fname FROM users WHERE username = ?");
$stmt->execute([$uname]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || strtolower(trim($user['fname'])) !== strtolower($fname)) {
    header("Location: ../forgot-password.php?error=Dados da conta nao conferem&$query");
    exit;
}

$hash = password_hash($newPassword, PASSWORD_DEFAULT);
$stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
$stmt->execute([$hash, $user['id']]);

header("Location: ../login.php?success=Senha atualizada com sucesso");
exit;
