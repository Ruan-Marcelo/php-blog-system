<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Dashboard - Usuarios</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Bootstrap 5 -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- bootstrap icon -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
		<link rel="stylesheet" href="../assets/CSS/side-bar.css">
		<link rel="stylesheet" href="../assets/CSS/style.css">
	</head>

	<body>
		<?php
		$key = "hhdsfs1263z";
		include "inc/side-nav.php";
		include_once("data/User.php");
		include_once("../db_conn.php");
		$users = getAll($conn); ?>

		<div class="main-table">
			<h3 class="mb-3">todos os Usuarios
				<a href="../signup.php" class="btn btn-success">Adcionar Usuario</a>
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

			<?php if ($users != 0) { ?>
				<table class="table t1 table-bordered" id="tabelaUsers">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nome completo</th>
							<th scope="col">Nome de usuario</th>
							<th scope="col">Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user) { ?>
							<tr>
								<th scope="row"><?= $user['id'] ?></th>
								<td><?= $user['fname'] ?></td>
								<td><?= $user['username'] ?></td>
								<td>
									<a href="user-delete.php?user_id=<?= $user['id'] ?>" class="btn btn-danger" onclick="return confirm('Excluir este usuario?')">Excluir</a>
								</td>
							</tr>
						<?php } ?>

					</tbody>
				</table>
			<?php } else { ?>
				<div class="alert alert-warning">
					Nenhum usuario cadastrado.
				</div>
			<?php } ?>
		</div>
		</section>
		</div>

		<script>
			var navList = document.getElementById('navList').children;
			navList.item(0).classList.add("active");
		</script>
		<!-- excel function  -->
		<script>
			function exportarExcel() {

				let tabela = document.getElementById("tabelaUsers");

				let html = tabela.outerHTML;

				let url = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);

				let link = document.createElement("a");

				link.href = url;

				link.download = "usuarios.xls";

				document.body.appendChild(link);

				link.click();

				document.body.removeChild(link);
			}
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	</body>

	</html>

<?php } else {
	header("Location: ../admin-login.php");
	exit;
} ?>
