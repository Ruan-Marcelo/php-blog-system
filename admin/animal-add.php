<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Dashboard - Criar Animal</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="../assets/CSS/side-bar.css">
        <link rel="stylesheet" href="../assets/CSS/style.css">

        <link rel="stylesheet" href="../css/richtext.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="../js/jquery.richtext.min.js"></script>
    </head>

    <body>

        <?php
        $key = "hhdsfs1263z";
        include "inc/side-nav.php";
        $oldAnimal = $_SESSION['old_animal'] ?? [];
        unset($_SESSION['old_animal']);
        ?>

        <div class="main-table">
            <h3 class="mb-3">
                Criar um novo Animal
                <a href="animals.php" class="btn btn-secondary">Animais</a>
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
                action="req/animal-add.php"
                method="post"
                enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($oldAnimal['name'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Espécie</label>
                    <input type="text" class="form-control" name="species" value="<?= htmlspecialchars($oldAnimal['species'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Idade</label>
                    <input type="number" class="form-control" name="age" min="0" max="50" value="<?= htmlspecialchars($oldAnimal['age'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea class="form-control text" name="description" required><?= htmlspecialchars($oldAnimal['description'] ?? '') ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Imagem</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Criar</button>
            </form>
        </div>

        <script>
            var navList = document.getElementById('navList').children;
            navList.item(2).classList.add("active");

            $(document).ready(function() {
                $('.text').richText();
            });
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
