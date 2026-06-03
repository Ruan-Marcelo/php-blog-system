<?php
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
	$logged = true;
	$user_id = $_SESSION['user_id'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./assets/CSS/style.css">
</head>

<body>
	<?php include 'navbar.php'; ?>

	<div class="login-container">
		<div class="login-box">
			<form class="login-form shadow" action="php/login.php" method="post">
				<h4>Entrar</h4>

				<?php if (isset($_GET['error'])) { ?>
					<div class="alert alert-danger">
						<?= htmlspecialchars($_GET['error']) ?>
					</div>
				<?php } ?>

				<?php if (isset($_GET['success'])) { ?>
					<div class="alert alert-success">
						<?= htmlspecialchars($_GET['success']) ?>
					</div>
				<?php } ?>

				<div class="mb-3">
					<label>Usuário</label>
					<input type="text" class="form-control" name="uname" value="<?= htmlspecialchars($_GET['uname'] ?? '') ?>">
				</div>

				<div class="mb-3">
					<div class="d-flex justify-content-between align-items-center">
						<label>Senha</label>
						<a href="forgot-password.php" class="small text-decoration-none">Esqueci minha senha</a>
					</div>
					<input type="password" class="form-control" name="pass">
				</div>

				<button class="btn btn-primary">Entrar</button>

				<div class="links">
					<a href="admin-login.php">Admin</a>
					<a href="blog.php">Blog</a>
					<a href="signup.php">Registrar</a>
				</div>
			</form>

			<div class="login-image"></div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
