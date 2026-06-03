<?php

function validar_imagem_enviada(array $file, array $allowedExtensions, int $maxSize, &$extension = null, &$message = null)
{
    if (!isset($file['error']) || is_array($file['error'])) {
        $message = "Upload invalido.";
        return false;
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $message = "Erro ao enviar imagem.";
        return false;
    }

    if (($file['size'] ?? 0) > $maxSize) {
        $message = "Imagem muito grande.";
        return false;
    }

    $extension = strtolower(pathinfo($file['name'] ?? '', PATHINFO_EXTENSION));
    if (!in_array($extension, $allowedExtensions, true)) {
        $message = "Tipo de imagem invalido.";
        return false;
    }

    $imageInfo = @getimagesize($file['tmp_name']);
    if ($imageInfo === false) {
        $message = "O arquivo enviado nao e uma imagem valida.";
        return false;
    }

    $mimeByExtension = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'webp' => 'image/webp',
    ];

    if (($mimeByExtension[$extension] ?? null) !== ($imageInfo['mime'] ?? null)) {
        $message = "A extensao da imagem nao corresponde ao arquivo enviado.";
        return false;
    }

    return true;
}

function mover_imagem_enviada(array $file, $destination, &$message = null)
{
    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        $message = "Erro ao salvar imagem.";
        return false;
    }

    return true;
}
