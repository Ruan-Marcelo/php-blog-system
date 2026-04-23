<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) && isset($_GET['id'])) {
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard - Banner Edit</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/CSS/side-bar.css">
    <link rel="stylesheet" href="../assets/CSS/style.css">
</head>

<body>

<?php
$key = "hhdsfs1263z";
$id = $_GET['id'];

include "inc/side-nav.php";
include_once("../db_conn.php");
include_once("data/Banner.php");

$banner = getBannerById($conn, $id);

$title = $banner['title'];
$image = $banner['image'];
?>

<div class="main-table">

    <h3 class="mb-3">
        Editar Banner
        <a href="Banner.php" class="btn btn-success">Voltar</a>
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

    <form class="shadow p-3"
          action="req/banner-edit.php"
          method="post"
          enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text"
                   class="form-control"
                   name="title"
                   value="<?= htmlspecialchars($title) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Imagem Atual</label><br>

            <img src="../upload/banners/<?= $image ?>"
                 style="width:200px; border-radius:10px;">
        </div>

        <div class="mb-3">
            <label class="form-label">Nova Imagem (opcional)</label>
            <input type="file"
                   class="form-control"
                   name="image">
        </div>

        <input type="hidden" name="id" value="<?= $id ?>">

        <button type="submit" class="btn btn-primary">
            Atualizar
        </button>

    </form>

</div>

<script>
    var navList = document.getElementById('navList').children;
    navList.item(0).classList.add("active");
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