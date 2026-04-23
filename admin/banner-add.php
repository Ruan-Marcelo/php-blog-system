<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard - Add Banner</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/CSS/side-bar.css">
    <link rel="stylesheet" href="../assets/CSS/style.css">
</head>

<body>

<?php
$key = "hhdsfs1263z";
include "inc/side-nav.php";
?>

<div class="main-table">

    <h3 class="mb-3">
        Adicionar Banner
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
          action="req/banner-add.php"
          method="post"
          enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text"
                   class="form-control"
                   name="title"
                   placeholder="Ex: Adoção responsável">
        </div>

        <div class="mb-3">
            <label class="form-label">Imagem do Banner</label>
            <input type="file"
                   class="form-control"
                   name="image"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">
            Adicionar Banner
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