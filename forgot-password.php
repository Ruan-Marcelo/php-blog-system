<?php
session_start();
$logged = isset($_SESSION['user_id'], $_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Redefinir senha</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./assets/CSS/style.css">
</head>

<body>
	<?php include 'navbar.php'; ?>

	<div class="login-container">
		<div class="login-box">
			<form class="login-form shadow" action="php/forgot-password.php" method="post">
				<h4>Redefinir senha</h4>

				<?php if (isset($_GET['error'])) { ?>
					<div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
				<?php } ?>

				<div class="mb-3">
					<label>Usuário</label>
					<input type="text" class="form-control" name="uname" value="<?= htmlspecialchars($_GET['uname'] ?? '') ?>" required>
				</div>

				<div class="mb-3">
					<label>Nome completo cadastrado</label>
					<input type="text" class="form-control" name="fname" value="<?= htmlspecialchars($_GET['fname'] ?? '') ?>" required>
				</div>

				<div class="mb-3">
					<label>Nova senha</label>
					<input type="password" class="form-control" name="new_password" required>
				</div>

				<div class="mb-3">
					<label>Confirmar nova senha</label>
					<input type="password" class="form-control" name="confirm_password" required>
				</div>

				<button class="btn btn-primary">Atualizar senha</button>

				<div class="links">
					<a href="login.php">Voltar ao login</a>
				</div>
			</form>

			<div class="login-image"></div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
