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
	<title>Animais</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/CSS/style.css">
</head>

<body>
	<?php
	include_once("db_conn.php");
	include_once("admin/data/Animal.php");

	$animals = getAllAnimals($conn);
	?>
	<?php include 'navbar.php'; ?>

	<div class="container mt-5">

		<h1 class="mb-4">Lista de Animais</h1>

		<?php if (!empty($animals)) { ?>

			<div class="row">

				<?php foreach ($animals as $animal) { ?>

					<div class="col-md-4 mb-4">

						<div class="card h-100 shadow-sm">

							<?php
							$img = !empty($animal['image']) ? $animal['image'] : 'default.jpg';
							?>

							<img src="upload/animals/<?= htmlspecialchars($img) ?>"
								class="card-img-top"
								style="height: 200px; object-fit: cover;">

							<div class="card-body">

								<h5 class="card-title">
									<?= htmlspecialchars($animal['name']) ?>
								</h5>

								<p class="card-text">
									<strong>Espécie:</strong> <?= htmlspecialchars($animal['species']) ?><br>
									<strong>Idade:</strong> <?= (int)$animal['age'] ?> anos
								</p>

								<p class="card-text">
									<?= htmlspecialchars(substr($animal['description'] ?? '', 0, 100)) ?>...
								</p>

								<a href="animal-view.php?id=<?= (int)$animal['id'] ?>"
									class="btn btn-primary w-100">
									Ver mais
								</a>

							</div>

						</div>

					</div>

				<?php } ?>

			</div>

		<?php } else { ?>

			<div class="alert alert-warning">
				Nenhum animal cadastrado ainda.
			</div>

		<?php } ?>

	</div>

	<?php include 'footer.php'; ?>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>