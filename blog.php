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

<body>
	<?php
	include 'navBar.php';
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

	<div class="container mt-5">
		<section class="d-flex">

			<?php if ($posts != 0) { ?>
				<main class="main-blog">
					<h1 class="display-4 mb-4 fs-3">
						<?php
						if (isset($_GET['search'])) {
							echo "Search <b>'" . htmlspecialchars($_GET['search']) . "'</b>";
						} ?></h1>
					<?php foreach ($posts as $post) { ?>
						<div class="card main-blog-card mb-5">
							<img src="upload/blog/<?= $post['cover_url'] ?>" class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title"><?= $post['post_title'] ?></h5>
								<?php
								$p = strip_tags($post['post_text']);
								$p = substr($p, 0, 200);
								?>
								<p class="card-text"><?= $p ?>...</p>
								<a href="blog-view.php?post_id=<?= $post['post_id'] ?>" class="btn btn-primary">Ver Mais</a>
								<hr>
								<div class="d-flex justify-content-between">
									<div class="react-btns">
										<?php
										$post_id = $post['post_id'];
										if ($logged) {
											$liked = isLikedByUserID($conn, $post_id, $user_id);


											if ($liked) {
										?>
												<i class="bi bi-hand-thumbs-up like-btn"
													post-id="<?= $post_id ?>"
													liked="1"
													aria-hidden="true"></i>
											<?php } else { ?>
												<i class="bi bi-hand-thumbs-up like-btn"
													post-id="<?= $post_id ?>"
													liked="0"
													aria-hidden="true"></i>
											<?php }
										} else { ?>
											<i class="bi bi-hand-thumbs-up like-btn"></i>
										<?php } ?>
										Likes (
										<span><?php
												echo likeCountByPostID($conn, $post['post_id']);
												?></span> )
										<a href="blog-view.php?post_id=<?= $post['post_id'] ?>#comments">
											<i class="bi bi-chat-fill"></i></i> Comentarios (
											<?php
											echo CountByPostID($conn, $post['post_id']);
											?>
											)
										</a>
									</div>
									<small class="text-body-secondary"><?= $post['crated_at'] ?></small>
								</div>

							</div>
						</div>
					<?php } ?>
				</main>
			<?php } else { ?>
				<main class="main-blog p-2">
					<?php if ($notFound) { ?>
						<div class="alert alert-warning">
							Nenhum resultado de pesquisa encontrado
							<?php echo " - <b>key = '" . htmlspecialchars($_GET['search']) . "'</b>" ?>
						</div>
					<?php } else { ?>
						<div class="alert alert-warning">
							Nenhuma postagem ainda.
						</div>
					<?php } ?>
				</main>
			<?php } ?>
			<aside class="aside-main">
				<div class="list-group category-aside">
					<a href="#"
						class="list-group-item list-group-item-action active"
						aria-current="true">
						Categoria em destaques
					</a>
					<?php foreach ($categories as $category) { ?>
						<a href="categoria.php?category_id=<?= $category['id'] ?>"
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

				if (liked == 1) {
					$(this).attr('liked', '0');
					$(this).removeClass('liked');
				} else {
					$(this).attr('liked', '1');
					$(this).addClass('liked');
				}
				$(this).next().load("ajax/like-unlike.php", {
					post_id: post_id
				});
			});
		});
	</script>
	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>