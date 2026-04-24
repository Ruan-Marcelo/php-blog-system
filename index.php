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

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />

    <!-- Seu CSS -->
    <link rel="stylesheet" href="assets/CSS/style.css">

    <style>
        .swiper {
            width: 100%;
            aspect-ratio: 16 / 9;
            background: #000;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .caption {
            position: absolute;
            bottom: 20px;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px 20px;
            border-radius: 10px;
        }

        .caption h5 {
            margin: 0;
            color: #fff;
        }
    </style>
</head>

<body>

    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <main>

        <!-- (SWIPER) -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                <?php foreach ($banners as $banner) { ?>
                    <div class="swiper-slide">
                        <img src="upload/banners/<?= $banner['image'] ?>" alt="Banner">

                        <?php if (!empty($banner['title'])) { ?>
                            <div class="caption">
                                <h5><?= htmlspecialchars($banner['title']) ?></h5>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

            </div>

            <!-- Controles -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>

    </main>

    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,

            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },

            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },

            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

</body>

</html>