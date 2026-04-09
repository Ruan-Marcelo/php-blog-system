<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Categroria Page</title>

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

    <div class="container mt-5">
        <h1 class="display-4 mb-4 fs-3">Categoria 1</h1>
        <section class="d-flex">
            <main class="main-blog">
                <div class="card main-blog-card text-white bg-dark mb-5">
                    <img class="card-img-top" src="./assets/imgs/post.png" alt="imagem do post do apoio pet">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <p class="card-text">
                            <small class="text-body-white">Ultima atualização 3 minutos atrás</small>
                        </p>
                        <a href="#" class="btn btn-primary">Read more</a>
                    </div>
                </div>
                <div class="card main-blog-card text-white bg-dark mb-5">
                    <img class="card-img-top" src="./assets/imgs/post.png" alt="imagem do post do apoio pet">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <p class="card-text">
                            <small class="text-body-white">Ultima atualização 3 minutos atrás</small>
                        </p>
                        <a href="#" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </main>
            <aside class="aside-main">
                <div class="list-group categoria-aside">
                    <a href="#" class="list-group-item list-group-item-action active">
                        Categorias
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">Categorias 1</a>
                    <a href="#" class="list-group-item list-group-item-action">Categorias 2</a>
                    <a href="#" class="list-group-item list-group-item-action">Categorias 3</a>
                    <a href="#" class="list-group-item list-group-item-action disabled">Categorias 4</a>
                </div>
            </aside>
        </section>
    </div>

    <?php include 'footer.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>