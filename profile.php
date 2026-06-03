<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$logged = true;
$user_id = $_SESSION['user_id'];

include_once("db_conn.php");
include_once("site_config.php");

$siteSettings = get_site_settings($conn);

$stmt = $conn->prepare("SELECT id, fname, username FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

$stmt = $conn->prepare("
    SELECT p.post_id, p.post_title, p.cover_url, p.crated_at, pl.liked_at
    FROM post_like pl
    INNER JOIN post p ON p.post_id = pl.post_id
    WHERE pl.liked_by = ? AND p.publish = 1
    ORDER BY pl.liked_at DESC
    LIMIT 6
");
$stmt->execute([$user_id]);
$likedPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("
    SELECT c.comment_id, c.comment, c.crated_at, p.post_id, p.post_title
    FROM comment c
    INNER JOIN post p ON p.post_id = c.post_id
    WHERE c.user_id = ? AND p.publish = 1
    ORDER BY c.comment_id DESC
    LIMIT 6
");
$stmt->execute([$user_id]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$recentPosts = [];
$viewedPosts = array_slice($_SESSION['viewed_posts'] ?? [], 0, 6);
if (!empty($viewedPosts)) {
    $placeholders = implode(',', array_fill(0, count($viewedPosts), '?'));
    $stmt = $conn->prepare("SELECT post_id, post_title, cover_url FROM post WHERE publish = 1 AND post_id IN ($placeholders)");
    $stmt->execute($viewedPosts);
    $postsById = [];
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $post) {
        $postsById[(int) $post['post_id']] = $post;
    }
    foreach ($viewedPosts as $postId) {
        if (isset($postsById[(int) $postId])) {
            $recentPosts[] = $postsById[(int) $postId];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($siteSettings['site_name']) ?> | Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/CSS/style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <main class="container mt-5 mb-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="fs-4 mb-1">Meu perfil</h1>
                        <p class="text-muted mb-0">@<?= htmlspecialchars($user['username']) ?></p>
                    </div>
                </div>

                <form class="card shadow-sm mt-4" action="php/profile-update.php" method="post">
                    <div class="card-body">
                        <h2 class="fs-5 mb-3">Dados da conta</h2>

                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
                        <?php } ?>
                        <?php if (isset($_GET['success'])) { ?>
                            <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
                        <?php } ?>

                        <input type="hidden" name="action" value="profile">

                        <div class="mb-3">
                            <label class="form-label">Nome completo</label>
                            <input type="text" class="form-control" name="fname" value="<?= htmlspecialchars($user['fname']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nome de usuario</label>
                            <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar dados</button>
                    </div>
                </form>

                <form class="card shadow-sm mt-4" action="php/profile-update.php" method="post">
                    <div class="card-body">
                        <h2 class="fs-5 mb-3" id="senha">Atualizar senha</h2>

                        <?php if (isset($_GET['perror'])) { ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($_GET['perror']) ?></div>
                        <?php } ?>
                        <?php if (isset($_GET['psuccess'])) { ?>
                            <div class="alert alert-success"><?= htmlspecialchars($_GET['psuccess']) ?></div>
                        <?php } ?>

                        <input type="hidden" name="action" value="password">

                        <div class="mb-3">
                            <label class="form-label">Senha atual</label>
                            <input type="password" class="form-control" name="current_password" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nova senha</label>
                            <input type="password" class="form-control" name="new_password" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirmar nova senha</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar senha</button>
                    </div>
                </form>
            </div>

            <div class="col-lg-8">
                <section class="mb-4">
                    <h2 class="fs-5 mb-3">Posts curtidos</h2>
                    <?php if (empty($likedPosts)) { ?>
                        <div class="alert alert-light border">Nenhum post curtido ainda.</div>
                    <?php } else { ?>
                        <div class="row">
                            <?php foreach ($likedPosts as $post) { ?>
                                <div class="col-md-6 mb-3">
                                    <a class="card h-100 text-decoration-none text-dark shadow-sm" href="blog-view.php?post_id=<?= (int) $post['post_id'] ?>">
                                        <img src="upload/blog/<?= htmlspecialchars($post['cover_url']) ?>" class="card-img-top" style="height: 150px; object-fit: cover;" alt="">
                                        <div class="card-body">
                                            <h3 class="fs-6 mb-0"><?= htmlspecialchars($post['post_title']) ?></h3>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </section>

                <section class="mb-4">
                    <h2 class="fs-5 mb-3">Comentarios recentes</h2>
                    <?php if (empty($comments)) { ?>
                        <div class="alert alert-light border">Nenhum comentario feito ainda.</div>
                    <?php } else { ?>
                        <div class="list-group">
                            <?php foreach ($comments as $comment) { ?>
                                <a href="blog-view.php?post_id=<?= (int) $comment['post_id'] ?>#comments" class="list-group-item list-group-item-action">
                                    <strong><?= htmlspecialchars($comment['post_title']) ?></strong>
                                    <p class="mb-1"><?= htmlspecialchars($comment['comment']) ?></p>
                                    <small class="text-muted"><?= htmlspecialchars($comment['crated_at']) ?></small>
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </section>

                <section>
                    <h2 class="fs-5 mb-3">Ultimos posts visualizados</h2>
                    <?php if (empty($recentPosts)) { ?>
                        <div class="alert alert-light border">Abra alguns posts para montar seu historico recente.</div>
                    <?php } else { ?>
                        <div class="row">
                            <?php foreach ($recentPosts as $post) { ?>
                                <div class="col-md-6 mb-3">
                                    <a class="card h-100 text-decoration-none text-dark shadow-sm" href="blog-view.php?post_id=<?= (int) $post['post_id'] ?>">
                                        <img src="upload/blog/<?= htmlspecialchars($post['cover_url']) ?>" class="card-img-top" style="height: 150px; object-fit: cover;" alt="">
                                        <div class="card-body">
                                            <h3 class="fs-6 mb-0"><?= htmlspecialchars($post['post_title']) ?></h3>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </section>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
