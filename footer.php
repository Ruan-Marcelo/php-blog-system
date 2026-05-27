<?php
include_once("db_conn.php");
include_once("site_config.php");
$siteSettings = get_site_settings($conn);
?>
<footer class="bg-dark text-white pt-5 pb-4">
  <div class="container text-center text-md-left">
    <div class="row text-center text-md-left">
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 font-weight-bold text-warning">
          <?= htmlspecialchars($siteSettings['site_name']) ?>
        </h5>
        <p><?= nl2br(htmlspecialchars($siteSettings['site_description'])) ?></p>
        <p><?= nl2br(htmlspecialchars($siteSettings['footer_text'])) ?></p>
      </div>

      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Paginas</h5>
        <p><a href="blog.php" class="text-white" style="text-decoration: none;">Blog</a></p>
        <p><a href="animals.php" class="text-white" style="text-decoration: none;">Animais</a></p>
        <p><a href="sobre.php" class="text-white" style="text-decoration: none;">Sobre</a></p>
        <p><a href="admin-login.php" class="text-white" style="text-decoration: none;">Administrador</a></p>
      </div>

      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contato</h5>
        <p>Joinville, SC</p>
        <p><?= htmlspecialchars($siteSettings['contact_email']) ?></p>
        <p><?= htmlspecialchars($siteSettings['contact_phone']) ?></p>
        <p><?= htmlspecialchars($siteSettings['whatsapp']) ?></p>

        <?php if (!empty($siteSettings['instagram'])) { ?>
          <p><a href="<?= htmlspecialchars($siteSettings['instagram']) ?>" class="text-white" style="text-decoration: none;">Instagram</a></p>
        <?php } ?>

        <?php if (!empty($siteSettings['facebook'])) { ?>
          <p><a href="<?= htmlspecialchars($siteSettings['facebook']) ?>" class="text-white" style="text-decoration: none;">Facebook</a></p>
        <?php } ?>
      </div>
    </div>

    <hr class="mb-4">

    <div class="row align-items-center">
      <div class="col-md-7 col-lg-8">
        <p>© 2026 Copyright: <strong><?= htmlspecialchars($siteSettings['site_name']) ?></strong></p>
      </div>
    </div>
  </div>
</footer>
