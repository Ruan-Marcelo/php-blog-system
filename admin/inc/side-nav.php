<?php 
if (isset($key) && $key == "hhdsfs1263z") {

?>
<input type="checkbox" id="checkbox">
		<header class="header">
			<h2 class="u-name">APOIO <b>PET</b>
				<label for="checkbox">
					<i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
				</label>
			</h2>
			<i class="fa fa-user" aria-hidden="true"></i>
		</header>
		<div class="body">
			<nav class="side-bar">
				<div class="user-p">
					<img src="../assets/imgs/profile.jpg">
					<h4>Administrador, <?php echo $_SESSION['username']; ?></h4>
				</div>
				<ul>
					<li>
						<a href="users.php">
							<i class="fa fa-users" aria-hidden="true"></i>
							<span>Usuarios</span>
						</a>
					</li>
					<li>
						<a href="post.php">
							<i class="fa fa-wpforms" aria-hidden="true"></i>
							<span>Post</span>
						</a>
					</li>
					<li>
						<a href="categoria.php">
							<i class="fa fa-window-restore" aria-hidden="true"></i>
							<span>Categoria</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-envelope-o" aria-hidden="true"></i>
							<span>Message</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-comment-o" aria-hidden="true"></i>
							<span>Comment</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-cog" aria-hidden="true"></i>
							<span>Setting</span>
						</a>
					</li>
					<li>
						<a href="../logout.php" onclick="return confirm('Você quer mesmo sair?');">
							<i class="fa fa-power-off" aria-hidden="true"></i>
							<span>Logout</span>
						</a>
					</li>
				</ul>
			</nav>
			<section class="section-1">
				<!-- <h1>Seja bem vindo <?php echo $_SESSION['username']; ?></h1> -->

<?php
}
?>