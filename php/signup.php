<?php

if (!isset($_POST['fname'], $_POST['uname'], $_POST['pass'])) {
	header("Location: ../signup.php?error=error");
	exit;
}

include "../db_conn.php";

$fname = trim($_POST['fname']);
$uname = trim($_POST['uname']);
$pass = $_POST['pass'];
$data = http_build_query([
	'fname' => $fname,
	'uname' => $uname,
]);

if ($fname === '') {
	$em = "O nome completo e obrigatorio";
	header("Location: ../signup.php?error=$em&$data");
	exit;
}

if ($uname === '') {
	$em = "O nome de usuario e obrigatorio";
	header("Location: ../signup.php?error=$em&$data");
	exit;
}

if (trim($pass) === '') {
	$em = "A senha e obrigatoria";
	header("Location: ../signup.php?error=$em&$data");
	exit;
}

$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$uname]);
if ($stmt->fetch()) {
	$em = "Este nome de usuario ja esta em uso";
	header("Location: ../signup.php?error=$em&$data");
	exit;
}

$pass = password_hash($pass, PASSWORD_DEFAULT);

$sql = "INSERT INTO users(fname, username, password) VALUES(?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$fname, $uname, $pass]);

header("Location: ../signup.php?success=Sua conta foi criada com sucesso.");
exit;
