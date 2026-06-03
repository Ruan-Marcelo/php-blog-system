<?php
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $logged = true;
    $user_id = $_SESSION['user_id'];
}

include_once("db_conn.php");
include_once("site_config.php");
include_once("admin/data/Post.php");
include_once("admin/data/Animal.php");

$siteSettings = get_site_settings($conn);
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$posts = [];
$animals = [];

if ($search !== '') {
    $postResults = search($conn, $search);
    $posts = $postResults === 0 ? [] : $postResults;
    $animals = searchAnimals($conn, $search);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($siteSettings['site_name']) ?> | Pesquisa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/CSS/style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <main class="container mt-5">
        <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap mb-4">
            <div>
                <h1 class="fs-3 mb-1">Pesquisa</h1>
                <?php if ($search !== '') { ?>
                    <p class="text-muted mb-0">Resultados para <strong><?= htmlspecialchars($search) ?></strong></p>
                <?php } else { ?>
                    <p class="text-muted mb-0">Digite um termo para procurar posts e animais.</p>
                <?php } ?>
            </div>
        </div>

        <?php if ($search === '') { ?>
            <div class="alert alert-info">Use o campo de pesquisa no topo do site.</div>
        <?php } else if (empty($posts) && empty($animals)) { ?>
            <div class="alert alert-warning">Nenhum resultado encontrado.</div>
        <?php } ?>

        <?php if (!empty($posts)) { ?>
            <section class="mb-5">
                <h2 class="fs-5 mb-3">Posts encontrados</h2>
                <div class="row">
                    <?php foreach ($posts as $post) { ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <img src="upload/blog/<?= htmlspecialchars($post['cover_url']) ?>" class="card-img-top" style="height: 180px; object-fit: cover;" alt="">
                                <div class="card-body d-flex flex-column">
                                    <h3 class="fs-5"><?= htmlspecialchars($post['post_title']) ?></h3>
                                    <p class="text-muted"><?= htmlspecialchars(substr(strip_tags($post['post_text']), 0, 140)) ?>...</p>
                                    <a href="blog-view.php?post_id=<?= (int) $post['post_id'] ?>" class="btn btn-primary mt-auto">Ver post</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
        <?php } ?>

        <?php if (!empty($animals)) { ?>
            <section class="mb-5">
                <h2 class="fs-5 mb-3">Animais encontrados</h2>
                <div class="row">
                    <?php foreach ($animals as $animal) {
                        $img = !empty($animal['image']) ? $animal['image'] : 'default.jpg';
                    ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <img src="upload/animals/<?= htmlspecialchars($img) ?>" class="card-img-top" style="height: 180px; object-fit: cover;" alt="">
                                <div class="card-body d-flex flex-column">
                                    <h3 class="fs-5"><?= htmlspecialchars($animal['name']) ?></h3>
                                    <p class="mb-1"><strong>Especie:</strong> <?= htmlspecialchars($animal['species']) ?></p>
                                    <p class="text-muted"><?= htmlspecialchars(substr($animal['description'] ?? '', 0, 120)) ?>...</p>
                                    <a href="animal-view.php?id=<?= (int) $animal['id'] ?>" class="btn btn-primary mt-auto">Ver animal</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
        <?php } ?>
    </main>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
