<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
    include_once("../db_conn.php");

    $conn->exec("
        CREATE TABLE IF NOT EXISTS site_settings (
            setting_key varchar(100) NOT NULL,
            setting_value text DEFAULT NULL,
            PRIMARY KEY (setting_key)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
    ");

    $defaultSettings = [
        'site_name' => 'APOIO PET',
        'site_description' => '',
        'contact_email' => '',
        'contact_phone' => '',
        'whatsapp' => '',
        'instagram' => '',
        'facebook' => '',
        'footer_text' => '',
        'comments_enabled' => '1',
        'likes_enabled' => '1'
    ];

    $stmt = $conn->prepare("SELECT setting_key, setting_value FROM site_settings");
    $stmt->execute();
    $settings = $defaultSettings;

    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        if (array_key_exists($row['setting_key'], $settings)) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $settings = [
            'site_name' => trim($_POST['site_name'] ?? ''),
            'site_description' => trim($_POST['site_description'] ?? ''),
            'contact_email' => trim($_POST['contact_email'] ?? ''),
            'contact_phone' => trim($_POST['contact_phone'] ?? ''),
            'whatsapp' => trim($_POST['whatsapp'] ?? ''),
            'instagram' => trim($_POST['instagram'] ?? ''),
            'facebook' => trim($_POST['facebook'] ?? ''),
            'footer_text' => trim($_POST['footer_text'] ?? ''),
            'comments_enabled' => isset($_POST['comments_enabled']) ? '1' : '0',
            'likes_enabled' => isset($_POST['likes_enabled']) ? '1' : '0'
        ];

        if ($settings['site_name'] === '') {
            header("Location: Configuracao.php?error=" . urlencode("O nome do site e obrigatorio"));
            exit;
        }

        $stmt = $conn->prepare("
            INSERT INTO site_settings (setting_key, setting_value)
            VALUES (?, ?)
            ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)
        ");

        foreach ($settings as $key => $value) {
            $stmt->execute([$key, $value]);
        }

        header("Location: Configuracao.php?success=" . urlencode("Configuracoes salvas com sucesso"));
        exit;
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard - Configuracoes</title>

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
    <h3 class="mb-3">Configuracoes do site/blog</h3>

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

    <form method="post" action="Configuracao.php" class="bg-white border rounded p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nome do site</label>
                <input type="text" name="site_name" class="form-control" required
                    value="<?= htmlspecialchars($settings['site_name']) ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">E-mail de contato</label>
                <input type="email" name="contact_email" class="form-control"
                    value="<?= htmlspecialchars($settings['contact_email']) ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Telefone</label>
                <input type="text" name="contact_phone" class="form-control"
                    value="<?= htmlspecialchars($settings['contact_phone']) ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">WhatsApp</label>
                <input type="text" name="whatsapp" class="form-control"
                    value="<?= htmlspecialchars($settings['whatsapp']) ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Instagram</label>
                <input type="url" name="instagram" class="form-control"
                    value="<?= htmlspecialchars($settings['instagram']) ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Facebook</label>
                <input type="url" name="facebook" class="form-control"
                    value="<?= htmlspecialchars($settings['facebook']) ?>">
            </div>

            <div class="col-12">
                <label class="form-label">Descricao do site</label>
                <textarea name="site_description" class="form-control" rows="3"><?= htmlspecialchars($settings['site_description']) ?></textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Texto do rodape</label>
                <textarea name="footer_text" class="form-control" rows="2"><?= htmlspecialchars($settings['footer_text']) ?></textarea>
            </div>

            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="comments_enabled" id="comments_enabled"
                        <?= $settings['comments_enabled'] === '1' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="comments_enabled">Permitir comentarios</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="likes_enabled" id="likes_enabled"
                        <?= $settings['likes_enabled'] === '1' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="likes_enabled">Permitir likes</label>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Salvar configuracoes</button>
        </div>
    </form>
</div>

<script>
    var navList = document.getElementById('navList').children;
    navList.item(6).classList.add("active");
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
