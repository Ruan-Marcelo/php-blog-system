<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) && isset($_GET['id'])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Dashboard - Editar Animal</title>

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

        include_once("../db_conn.php");
        include_once("data/Animal.php");

        $id = $_GET['id'];

        $animal = getAnimalById($conn, $id);
        $oldAnimal = $_SESSION['old_animal_edit'][$id] ?? [];
        unset($_SESSION['old_animal_edit'][$id]);
        ?>

        <div class="main-table">
            <h3 class="mb-3">
                Editar Animal
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

            <?php if ($animal != 0) { ?>
                <form class="shadow p-3"
                    action="req/animal-edit.php"
                    method="post"
                    enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?= $animal['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text"
                            class="form-control"
                            name="name"
                            value="<?= htmlspecialchars($oldAnimal['name'] ?? $animal['name']) ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Espécie</label>
                        <input type="text"
                            class="form-control"
                            name="species"
                            value="<?= htmlspecialchars($oldAnimal['species'] ?? $animal['species']) ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Idade</label>
                        <input type="number"
                            class="form-control"
                            name="age"
                            min="0"
                            max="50"
                            value="<?= htmlspecialchars($oldAnimal['age'] ?? $animal['age']) ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea
                            class="form-control text"
                            name="description"
                            required><?= htmlspecialchars($oldAnimal['description'] ?? $animal['description']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Imagem</label>
                        <input type="file" class="form-control" name="image">
                        <br>
                        <img src="../upload/animals/<?= $animal['image'] ?>" width="200">
                        <?php if (!empty($animal['image']) && $animal['image'] !== 'default.jpg') { ?>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="removeAnimalImage">
                                <label class="form-check-label" for="removeAnimalImage">Remover imagem atual</label>
                            </div>
                        <?php } ?>
                    </div>

                    <input type="hidden" name="image_old" value="<?= $animal['image'] ?>">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </form>
            <?php } else { ?>
                <div class="alert alert-danger">
                    Animal não encontrado
                </div>
            <?php } ?>

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
