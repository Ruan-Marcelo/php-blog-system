<?php
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
	$logged = true;
	$user_id = $_SESSION['user_id'];
}
$notFound = 0;

include_once("db_conn.php");
include_once("admin/data/Animal.php");

if (!isset($_GET['id'])) {
    header("Location: animals.php");
    exit;
}

$id = (int) $_GET['id'];
$animal = getAnimalById($conn, $id);

if (!$animal) {
    header("Location: animals.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($animal['name']) ?> - Animal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/CSS/style.css">
</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">

    <section class="d-flex">

        <main class="main-blog">

            <div class="card main-blog-card mb-5">

                <?php
                $img = !empty($animal['image']) ? $animal['image'] : 'default.jpg';
                ?>

                <img src="upload/animals/<?= htmlspecialchars($img) ?>"
                     class="card-img-top"
                     style="max-height: 500px; object-fit: cover;"
                     alt="animal">

                <div class="card-body">

                    <h2 class="card-title mb-3">
                        <?= htmlspecialchars($animal['name']) ?>
                    </h2>

                    <p class="card-text">
                        <strong>Espécie:</strong> <?= htmlspecialchars($animal['species']) ?><br>
                        <strong>Idade:</strong> <?= (int)$animal['age'] ?> anos
                    </p>

                    <hr>

                    <h5>Descrição</h5>
                    <p class="card-text">
                        <?= nl2br(htmlspecialchars($animal['description'])) ?>
                    </p>

                    <hr>

                    <small class="text-body-secondary">
                        Criado em: <?= $animal['created_at'] ?? 'Sem data' ?>
                    </small>

                </div>

            </div>

        </main>

    </section>

</div>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>