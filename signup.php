<?php
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
	$logged = true;
	$user_id = $_SESSION['user_id'];
}
$notFound = 0;
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="./assets/CSS/style.css">
</head>

<body>
	<?php include 'navBar.php'; ?>
	<div class="login-container">
		<div class="login-box">
			<form class="login-form"
				action="php/signup.php"
				method="post">

				<h4 class="fs-2">Criar Conta</h4>

				<?php if (isset($_GET['error'])) { ?>
					<div class="alert alert-danger">
						<?php echo htmlspecialchars($_GET['error']); ?>
					</div>
				<?php } ?>

				<?php if (isset($_GET['success'])) { ?>
					<div class="alert alert-success">
						<?php echo htmlspecialchars($_GET['success']); ?>
					</div>
				<?php } ?>

				<div class="mb-3">
					<label>Nome Completo</label>
					<input type="text" class="form-control" name="fname">
				</div>

				<div class="mb-3">
					<label>Nome de Usuário</label>
					<input type="text" class="form-control" name="uname">
				</div>

				<div class="mb-3">
					<label>Senha</label>
					<input type="password" class="form-control" name="pass">
				</div>

				<button class="btn btn-primary w-100">Registrar</button>

				<div class="links mt-3 text-center">
					<a href="login.php">Já tenho conta</a>
				</div>
			</form>

			<div class="login-image"></div>

		</div>
	</div>
	<?php include 'footer.php'; ?>

	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>