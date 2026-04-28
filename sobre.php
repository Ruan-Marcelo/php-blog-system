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
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php
		if (isset($_GET['search'])) {
			echo "search '" . htmlspecialchars($_GET['search']) . "'";
		} else {
			echo "Blog Page";
		} ?>
	</title>
	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- bootstrap icon -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
	<!-- css -->
	<link rel="stylesheet" href="assets/CSS/style.css">
</head>
<style>
	.card iframe {
		border-top-left-radius: 12px;
		border-top-right-radius: 12px;
	}

	.card {
		border-radius: 12px;
		overflow: hidden;
		transition: 0.3s;
	}

	.card:hover {
		transform: translateY(-5px);
	}
</style>

<body>
	<?php
	include 'navbar.php';
	include_once("admin/data/Post.php");
	include_once("admin/data/Comment.php");
	include_once("db_conn.php");
	if (isset($_GET['search'])) {
		$key = $_GET['search'];
		$posts = search($conn, $key);
		if ($posts == 0) {
			$notFound = 1;
		}
	} else {
		$posts = getAll($conn);
	}
	$categories = get5Categories($conn);
	?>

	<div class="container my-5">

		<!-- Título -->
		<div class="text-center mb-5">
			<h2 class="fw-bold">Apoio Pet 🐾</h2>
			<p class="text-muted">Cuidando de quem não pode pedir ajuda</p>
		</div>

		<!-- Sobre -->
		<div class="row align-items-center mb-5">
			<div class="col-md-6">
				<img src="https://cdn-icons-png.flaticon.com/512/616/616408.png"
					class="img-fluid"
					style="max-width: 300px;">
			</div>
			<div class="col-md-6">
				<h4>Sobre o projeto</h4>
				<p>
					O <strong>Apoio Pet</strong> nasceu com o objetivo de ajudar animais em situação de rua,
					promovendo conscientização, apoio a ONGs e incentivo à adoção responsável.
				</p>
				<p>
					Acreditamos que pequenas ações podem transformar vidas — tanto dos animais quanto das pessoas.
				</p>
			</div>
		</div>

		<!-- Missão / Visão / Valores -->
		<div class="row text-center mb-5">

			<div class="col-md-4 mb-3">
				<div class="card p-3 shadow-sm h-100">
					<h5>Missão</h5>
					<p>Ajudar animais abandonados e promover o bem-estar animal.</p>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="card p-3 shadow-sm h-100">
					<h5>Visão</h5>
					<p>Construir um mundo com menos abandono e mais amor pelos animais.</p>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="card p-3 shadow-sm h-100">
					<h5>Valores</h5>
					<p>Respeito, responsabilidade e cuidado com todos os seres vivos.</p>
				</div>
			</div>

		</div>

		<!-- Como ajudar -->
		<div class="text-center mb-4">
			<h4>Como você pode ajudar</h4>
		</div>

		<div class="row text-center">

			<div class="col-md-4 mb-3">
				<div class="card shadow-sm p-3 h-100">
					<h6>🐶 Adote com responsabilidade</h6>
					<p>Dê um lar para um animal que precisa de amor.</p>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="card shadow-sm p-3 h-100">
					<h6>🤝 Seja voluntário</h6>
					<p>Ajude ONGs e projetos locais da sua cidade.</p>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="card shadow-sm p-3 h-100">
					<h6>📢 Compartilhe</h6>
					<p>Divulgue a causa e ajude mais pessoas a conhecerem o projeto.</p>
				</div>
			</div>

		</div>

	</div>
	<div class="container my-5">

		<div class="text-center mb-5">
			<h4>ONGs Parceiras 📍</h4>
			<p class="text-muted">Conheça locais que ajudam animais perto de você</p>
		</div>

		<div class="row">

			<!-- ONG 1 -->
			<div class="col-md-4 mb-4">
				<div class="card shadow-sm h-100">
					<iframe
						src="https://www.google.com/maps?q=ong+animais&output=embed"
						width="100%"
						height="200"
						style="border:0;">
					</iframe>
					<div class="card-body">
						<h5>ONG Amor Animal</h5>
						<p>Resgate e cuidado de animais abandonados.</p>
					</div>
				</div>
			</div>

			<!-- ONG 2 -->
			<div class="col-md-4 mb-4">
				<div class="card shadow-sm h-100">
					<iframe
						src="https://www.google.com/maps?q=abrigo+de+animais&output=embed"
						width="100%"
						height="200"
						style="border:0;">
					</iframe>
					<div class="card-body">
						<h5>Patinhas Felizes</h5>
						<p>Abrigo e adoção responsável de pets.</p>
					</div>
				</div>
			</div>

			<!-- ONG 3 -->
			<div class="col-md-4 mb-4">
				<div class="card shadow-sm h-100">
					<iframe
						src="https://www.google.com/maps?q=protecao+animal&output=embed"
						width="100%"
						height="200"
						style="border:0;">
					</iframe>
					<div class="card-body">
						<h5>Projeto Vida Pet</h5>
						<p>Ajuda veterinária e campanhas de conscientização.</p>
					</div>
				</div>
			</div>

		</div>
	</div>

	<?php include 'footer.php'; ?>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>