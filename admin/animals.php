<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Dashboard - Animais</title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

		<link rel="stylesheet" href="../assets/CSS/side-bar.css">
		<link rel="stylesheet" href="../assets/CSS/style.css">
	</head>

	<body>

		<?php
		$key = "hhdsfs1263z";
		include "inc/side-nav.php";

		include_once("../db_conn.php"); // PRIMEIRO conexão
		include_once("data/Animal.php"); // DEPOIS funções

		$animals = getAllAnimals($conn);
		?>

		<div class="main-table">
			<h3 class="mb-3">
				Todos os Animais
				<a href="animal-add.php" class="btn btn-success">Adicionar Animal</a>
				<a href="#"
					onclick="exportarExcel()"
					class="btn btn-primary btn-sm"
					style="width:auto; display:inline-flex; align-items:center; padding:10px 10px;">
					<i class="bi bi-file-earmark-excel"></i> &nbsp; Exportar Excel
				</a>

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

			<?php if ($animals != 0) { ?>
				<table class="table t1 table-bordered" id="tabelaAnimais">
					<thead>
						<tr>
							<th>#</th>
							<th>Imagem</th>
							<th>Nome</th>
							<th>Espécie</th>
							<th>Idade</th>
							<th>Ações</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($animals as $animal) { ?>
							<tr>
								<td><?= $animal['id'] ?></td>

								<td>
									<?php
									$img = !empty($animal['image']) ? $animal['image'] : 'default.jpg';
									?>

									<img src="../upload/animals/<?= $img ?>" style="width:60px; height:60px; object-fit:cover; border-radius:50%;">
								</td>
								<td><?= $animal['name'] ?></td>
								<td><?= $animal['species'] ?></td>
								<td><?= $animal['age'] ?> anos</td>

								<td>
									<a href="animal-delete.php?id=<?= intval($animal['id']) ?>" class="btn btn-danger" onclick="return confirm('Excluir este animal?')">
										Deletar
									</a>

									<a href="animal-edit.php?id=<?= intval($animal['id']) ?>" class="btn btn-warning">
										Editar
									</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>

			<?php } else { ?>
				<div class="alert alert-warning">
					Nenhum animal cadastrado
				</div>
			<?php } ?>

		</div>

		<script>
			var navList = document.getElementById('navList').children;
			navList.item(4).classList.add("active");
		</script>
		<!-- excel function  -->
		<script>
			function exportarExcel() {

				let tabela = document.getElementById("tabelaAnimais");

				let html = tabela.outerHTML;

				let url = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);

				let link = document.createElement("a");

				link.href = url;

				link.download = "animais.xls";

				document.body.appendChild(link);

				link.click();

				document.body.removeChild(link);
			}
		</script>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

	</body>

	</html>

<?php } else {
	header("Location: ../admin-login.php");
	exit;
} ?>
