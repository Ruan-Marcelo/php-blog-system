<?php
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
	$logged = true;
	$user_id = $_SESSION['user_id'];
}

include_once("db_conn.php");
include_once("site_config.php");
$siteSettings = get_site_settings($conn);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= htmlspecialchars($siteSettings['site_name']) ?> | Sobre</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
	<link rel="stylesheet" href="assets/CSS/style.css">

	<style>
		.about-hero {
			background: #f4f8f3;
			padding: 56px 0;
		}

		.about-hero h1 {
			font-size: clamp(2rem, 5vw, 4rem);
			line-height: 1.05;
		}

		.about-hero img {
			width: 100%;
			aspect-ratio: 16 / 10;
			object-fit: cover;
			border-radius: 8px;
		}

		.about-kicker {
			color: #198754;
			font-weight: 700;
			letter-spacing: .04em;
			text-transform: uppercase;
			font-size: .8rem;
		}

		.info-card {
			border: 1px solid #e6ece4;
			border-radius: 8px;
			padding: 24px;
			height: 100%;
			background: #fff;
		}

		.info-card i {
			font-size: 2rem;
			color: #198754;
		}

		.action-band {
			background: #1f2933;
			color: #fff;
			padding: 48px 0;
		}

		.action-item {
			border-left: 3px solid #ffc107;
			padding-left: 18px;
			height: 100%;
		}

		.partner-card {
			border: 1px solid #e6ece4;
			border-radius: 8px;
			overflow: hidden;
			height: 100%;
			background: #fff;
		}

		.partner-card iframe {
			width: 100%;
			height: 180px;
			border: 0;
		}

		.contact-box {
			background: #f8faf7;
			border-radius: 8px;
			padding: 32px;
		}
	</style>
</head>

<body>
	<?php include 'navbar.php'; ?>

	<section class="about-hero">
		<div class="container">
			<div class="row align-items-center g-5">
				<div class="col-lg-6">
					<div class="about-kicker mb-3">Sobre o projeto</div>
					<h1 class="fw-bold mb-4"><?= htmlspecialchars($siteSettings['site_name']) ?></h1>
					<p class="lead mb-4"><?= htmlspecialchars($siteSettings['site_description']) ?></p>
					<p class="mb-4">
						O projeto nasceu para aproximar pessoas, informacao e a causa animal.
						Ajudamos a divulgar adocao responsavel, cuidados basicos, denuncia de maus-tratos
						e formas praticas de apoiar quem atua no resgate.
					</p>
					<div class="d-flex flex-wrap gap-2">
						<a href="animals.php" class="btn btn-success">Ver animais</a>
						<a href="blog.php" class="btn btn-outline-success">Ler o blog</a>
					</div>
				</div>

				<div class="col-lg-6">
					<img src="upload/banners/banner-adocao-responsavel.png" alt="Voluntarios cuidando de animais resgatados">
				</div>
			</div>
		</div>
	</section>

	<section class="container my-5">
		<div class="row g-4">
			<div class="col-md-4">
				<div class="info-card">
					<i class="bi bi-heart-pulse mb-3 d-block"></i>
					<h5>Missao</h5>
					<p class="mb-0">Fortalecer a protecao animal com conteudo claro, acolhimento e divulgacao de pets que precisam de um lar.</p>
				</div>
			</div>

			<div class="col-md-4">
				<div class="info-card">
					<i class="bi bi-house-heart mb-3 d-block"></i>
					<h5>Visao</h5>
					<p class="mb-0">Construir uma rede local mais preparada para adotar, cuidar, denunciar e apoiar iniciativas de resgate.</p>
				</div>
			</div>

			<div class="col-md-4">
				<div class="info-card">
					<i class="bi bi-shield-check mb-3 d-block"></i>
					<h5>Valores</h5>
					<p class="mb-0">Responsabilidade, respeito, cuidado continuo e compromisso com o bem-estar dos animais.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="action-band">
		<div class="container">
			<div class="row g-4 align-items-start">
				<div class="col-lg-4">
					<div class="about-kicker text-warning mb-2">Como ajudar</div>
					<h2 class="fw-bold">Pequenas atitudes fazem diferenca.</h2>
				</div>

				<div class="col-md-4 col-lg-2">
					<div class="action-item">
						<h6>Adote</h6>
						<p class="mb-0">Escolha com responsabilidade e prepare sua casa antes da chegada.</p>
					</div>
				</div>

				<div class="col-md-4 col-lg-3">
					<div class="action-item">
						<h6>Compartilhe</h6>
						<p class="mb-0">Divulgue animais, campanhas e informacoes confiaveis.</p>
					</div>
				</div>

				<div class="col-md-4 col-lg-3">
					<div class="action-item">
						<h6>Apoie</h6>
						<p class="mb-0">Doe racao, ofereca lar temporario ou ajude projetos da sua cidade.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="container my-5">
		<div class="row align-items-end mb-4">
			<div class="col-md-8">
				<div class="about-kicker mb-2">Rede de apoio</div>
				<h2 class="fw-bold mb-0">Locais e projetos para conhecer</h2>
			</div>
			<div class="col-md-4 text-md-end mt-3 mt-md-0">
				<a href="animals.php" class="btn btn-outline-success">Animais disponiveis</a>
			</div>
		</div>

		<div class="row g-4">
			<div class="col-md-4">
				<div class="partner-card">
					<iframe src="https://www.google.com/maps?q=ong+animais+joinville&output=embed"></iframe>
					<div class="p-3">
						<h5>ONGs de resgate</h5>
						<p class="mb-0">Projetos que acolhem, tratam e encaminham animais para adocao responsavel.</p>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="partner-card">
					<iframe src="https://www.google.com/maps?q=clinica+veterinaria+popular+joinville&output=embed"></iframe>
					<div class="p-3">
						<h5>Cuidados veterinarios</h5>
						<p class="mb-0">Apoio para vacinacao, castracao, consultas e orientacoes de saude animal.</p>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="partner-card">
					<iframe src="https://www.google.com/maps?q=protecao+animal+joinville&output=embed"></iframe>
					<div class="p-3">
						<h5>Protecao animal</h5>
						<p class="mb-0">Canais e iniciativas que ajudam em casos de abandono e maus-tratos.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="container mb-5">
		<div class="contact-box">
			<div class="row align-items-center g-4">
				<div class="col-lg-7">
					<h2 class="fw-bold">Fale com o <?= htmlspecialchars($siteSettings['site_name']) ?></h2>
					<p class="mb-0">Use os contatos cadastrados no painel para receber mensagens, parcerias e pedidos de divulgacao.</p>
				</div>

				<div class="col-lg-5">
					<p class="mb-2"><strong>E-mail:</strong> <?= htmlspecialchars($siteSettings['contact_email']) ?></p>
					<p class="mb-2"><strong>Telefone:</strong> <?= htmlspecialchars($siteSettings['contact_phone']) ?></p>
					<p class="mb-0"><strong>WhatsApp:</strong> <?= htmlspecialchars($siteSettings['whatsapp']) ?></p>
				</div>
			</div>
		</div>
	</section>

	<?php include 'footer.php'; ?>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
