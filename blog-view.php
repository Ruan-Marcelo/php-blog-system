<?php
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
	$logged = true;
	$user_id = $_SESSION['user_id'];
}

if (isset($_GET['post_id'])) {

	include_once("admin/data/Post.php");
	include_once("admin/data/Comment.php");
	include_once("db_conn.php");
	$id = $_GET['post_id'];
	$post = getById($conn, $id);
	$comments = getCommentsByPostID($conn, $id);
	$categories = get5Categoies($conn);

	if ($post == 0) {
		header("Location: blog.php");
		exit;
	}
?>
	<!DOCTYPE html>
	<html lang="pt-br">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Blog - <?= $post['post_title'] ?></title>
		<!-- Bootstrap 5 -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- bootstrap icon -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
		<!-- css -->
		<link rel="stylesheet" href="assets/CSS/style.css">
	</head>

	<body>
		<?php
		include 'navBar.php';
		?>

		<div class="container mt-5">
			<section class="d-flex">

				<main class="main-blog">

					<div class="card main-blog-card mb-5">
						<img src="upload/blog/<?= $post['cover_url'] ?>" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title"><?= $post['post_title'] ?></h5>
							<p class="card-text"><?= $post['post_text'] ?></p>
							<hr>
							<div class="d-flex justify-content-between">
								<div class="react-btns">
									<?php
									$post_id = $post['post_id'];

									if ($logged) {
										$liked = isLikedByUserID($conn, $post_id, $user_id);

										if ($liked) {
									?>
											<i class="bi bi-hand-thumbs-up-fill like-btn"
												post-id="<?= $post_id ?>"
												liked="1"></i>
										<?php } else { ?>
											<i class="bi bi-hand-thumbs-up like-btn"
												post-id="<?= $post_id ?>"
												liked="0"></i>
										<?php }
									} else { ?>
										<i class="bi bi-hand-thumbs-up"></i>
									<?php } ?>

									Likes (
									<span><?= likeCountByPostID($conn, $post['post_id']); ?></span>
									)
									<i class="bi bi-chat-fill"></i></i> Comentarios (
									<?php
									echo CountByPostID($conn, $post['post_id']);
									?>
									)

								</div>
								<small class="text-body-secondary"><?= $post['crated_at'] ?></small>
							</div>

							<?php if (isset($_SESSION['user_id'])) { ?>

								<form action="php/comment.php"
									method="post"
									id="comments">

									<h5 class="mt-4 text-secondary">Adicionar Comentario</h5>

									<?php if (isset($_GET['error'])) { ?>
										<div class="alert alert-danger">
											<?= htmlspecialchars($_GET['error']); ?>
										</div>
									<?php } ?>

									<?php if (isset($_GET['success'])) { ?>
										<div class="alert alert-success">
											<?= htmlspecialchars($_GET['success']); ?>
										</div>
									<?php } ?>

									<div class="mb-3">
										<textarea class="form-control"
											name="comment"
											required></textarea>

										<input type="hidden"
											name="post_id"
											value="<?= $id ?>">
									</div>

									<button type="submit" class="btn btn-primary">
										Comentar
									</button>
								</form>

							<?php } else { ?>

								<div class="alert alert-warning mt-3">
									<a href="login.php" class="btn btn-primary">
										Fazer login para comentar
									</a>
								</div>

							<?php } ?>
							<hr>
							<div>
								<div class="comments">
									<?php if ($comments != 0) {
										foreach ($comments as $comment) {
											$u = getUserByID($conn, $comment['user_id']);
									?>
											<div class="comment d-flex">
												<div>
													<img src="./assets/imgs/user-default.png" width="40" height="40">
												</div>
												<div class="p-2">
													<span>@<?= ($u != 0 && isset($u['username'])) ? $u['username'] : 'Usuário desconhecido' ?></span>
													<p><?= $comment['comment'] ?></p>
													<small class="text-body-secondary"><?= $comment['crated_at'] ?></small>
												</div>
											</div>
											<hr>
									<?php }
									} ?>
								</div>
							</div>
						</div>
					</div>

				</main>

				<aside class="aside-main">
					<div class="list-group category-aside">
						<a href="#" class="list-group-item list-group-item-action active" aria-current="true">
							Categoria
						</a>
						<?php foreach ($categories as $category) { ?>
							<a href="category.php?category_id=<?= $category['id'] ?>"
								class="list-group-item list-group-item-action">
								<?php echo $category['category']; ?>
							</a>
						<?php } ?>
					</div>
				</aside>
			</section>
		</div>
		<?php include 'footer.php'; ?>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<script>
			$(document).ready(function() {
				$(".like-btn").click(function() {
					var post_id = $(this).attr('post-id');
					var liked = $(this).attr('liked');
					var el = $(this);

					$.post("assets/ajax/like-unlike.php", {
						post_id: post_id
					}, function(response) {

						// Atualiza contador
						el.closest(".react-btns").find("span").text(response);

						// Toggle visual
						if (liked == 1) {
							el.attr('liked', '0');
							el.removeClass('liked');
						} else {
							el.attr('liked', '1');
							el.addClass('liked');
						}
					});
				});
			});
		</script>

		<!-- Bootstrap JS -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
	</body>

	</html>
<?php } else {
	header("Location: blog.php");
	exit;
} ?>