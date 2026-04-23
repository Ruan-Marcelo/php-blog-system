<?php
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $logged = true;
    $user_id = $_SESSION['user_id'];
}

include_once("db_conn.php");

$stmt = $conn->prepare("SELECT * FROM banner WHERE active = 1");
$stmt->execute();
$banners = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- css -->
    <link rel="stylesheet" href="assets/CSS/style.css">
</head>

<body class="">
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <main>
       <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">

    <!-- indicators -->
    <div class="carousel-indicators">

        <?php foreach ($banners as $index => $banner) { ?>
            <button type="button"
                data-bs-target="#mainCarousel"
                data-bs-slide-to="<?= $index ?>"
                class="<?= $index == 0 ? 'active' : '' ?>">
            </button>
        <?php } ?>

    </div>

    <!-- slides -->
    <div class="carousel-inner">

        <?php foreach ($banners as $index => $banner) { ?>

            <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">

                <img src="upload/banners/<?= $banner['image'] ?>"
                     class="d-block w-100"
                     style="height: 450px; object-fit: cover;">

                <?php if (!empty($banner['title'])) { ?>
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?= htmlspecialchars($banner['title']) ?></h5>
                    </div>
                <?php } ?>

            </div>

        <?php } ?>

    </div>

    <!-- controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>

</div>
    </main>




    <?php include 'footer.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>