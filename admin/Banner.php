<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard - Banners</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/CSS/side-bar.css">
    <link rel="stylesheet" href="../assets/CSS/style.css">

    <style>
        .banner-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }

        .banner-card {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .banner-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }

        .banner-actions {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        .banner-actions a {
            margin-left: 5px;
        }
    </style>
</head>

<body>

<?php
$key = "hhdsfs1263z";
include "inc/side-nav.php";

include_once("../db_conn.php");
include_once("data/Banner.php");

$banners = getAllBanners($conn);
?>

<div class="main-table">

    <h3 class="mb-3">
        Banners
        <a href="banner-add.php" class="btn btn-success">Adicionar</a>
    </h3>

    <?php if (!empty($banners)) { ?>

        <div class="banner-grid">

            <?php foreach ($banners as $banner) { ?>

                <div class="banner-card">

                    <img src="../upload/banners/<?= $banner['image'] ?>">

                    <div class="banner-actions">

                        <a href="banner-edit.php?id=<?= $banner['id'] ?>" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>

                        <a href="banner-delete.php?id=<?= $banner['id'] ?>" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </a>

                    </div>

                </div>

            <?php } ?>

        </div>

    <?php } else { ?>

        <div class="alert alert-warning">
            Nenhum banner cadastrado
        </div>

    <?php } ?>

</div>

<script>
    var navList = document.getElementById('navList').children;
    navList.item(5).classList.add("active");
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
} else {
    header("Location: ../admin-login.php");
    exit;
}
?>