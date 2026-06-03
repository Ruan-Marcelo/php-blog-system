<?php
session_start();

if (!isset($_POST['uname'], $_POST['pass'])) {
   header("Location: ../../../login.php?error=error");
   exit;
}

include __DIR__ . "/../../../db_conn.php";

$uname = trim($_POST['uname']);
$pass = $_POST['pass'];
$data = http_build_query(['uname' => $uname]);

if ($uname === '') {
   $em = "O nome de usuario e obrigatorio";
   header("Location: ../../../login.php?error=$em&$data");
   exit;
}

if ($pass === '') {
   $em = "A senha e obrigatoria";
   header("Location: ../../../login.php?error=$em&$data");
   exit;
}

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$uname]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($pass, $user['password'])) {
   $em = "Nome de usuario ou senha incorretos";
   header("Location: ../../../login.php?error=$em&$data");
   exit;
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];

header("Location: ../../../blog.php");
exit;
