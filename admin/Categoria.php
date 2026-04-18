<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Dashboard - Category</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
		<link rel="stylesheet" href="../assets/CSS/side-bar.css">
		<link rel="stylesheet" href="../assets/CSS/style.css">
	</head>

	<body>
		<?php
		$key = "hhdsfs1263z";
		include "inc/side-nav.php";
		include_once("data/Categoria.php");
		include_once("../db_conn.php");
		$categories = getAll($conn);

		?>

		<div class="main-table">
			<h3 class="mb-3">Todas as Categorias
				<a href="categoria-add.php" class="btn btn-success">Adicionar Categoria</a>
			</h3>
			<?php if (isset($_GET['error'])) { ?>
				<div class="alert alert-warning">
					<?= htmlspecialchars($_GET['error']) ?>
				</div>
			<?php } ?>

			<?php if (isset($_GET['success'])) { ?>
				<div class="alert alert-success">
					<?= htmlspecialchars($_GET['success']) ?>
				</div>
			<?php } ?>

			<?php if ($categories != 0) { ?>
				<table class="table t1 table-bordered">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Categoria</th>
							<th scope="col">Ação</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($categories as $category) { ?>
							<tr>
								<th scope="row"><?= $category['id'] ?></th>
								<td><?= $category['category'] ?></td>
								<td>
									<a href="categoria-delete.php?id=<?= $category['id'] ?>" class="btn btn-danger">Deletar</a>
									<a href="categoria-edit.php?id=<?= $category['id'] ?>" class="btn btn-warning">Editar</a>
								</td>
							</tr>
						<?php } ?>

					</tbody>
				</table>
			<?php } else { ?>
				<div class="alert alert-warning">
					Empty!
				</div>
			<?php } ?>
		</div>
		</section>
		</div>

		<script>
			var navList = document.getElementById('navList').children;
			navList.item(2).classList.add("active");
		</script>
		 <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
	</body>

	</html>

<?php } else {
	header("Location: ../admin-login.php");
	exit;
} ?>