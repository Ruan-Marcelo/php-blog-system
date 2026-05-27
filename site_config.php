<?php

function get_site_settings($conn)
{
    $settings = [
        'site_name' => 'APOIO PET',
        'site_description' => 'Apoio a adocao responsavel, resgate e cuidado com animais abandonados.',
        'contact_email' => 'contato@apoiopet.com.br',
        'contact_phone' => '(47) 99999-0000',
        'whatsapp' => '(47) 99999-0000',
        'instagram' => 'https://instagram.com/apoiopet',
        'facebook' => 'https://facebook.com/apoiopet',
        'footer_text' => 'Juntos por uma cidade com menos abandono e mais cuidado animal.',
        'comments_enabled' => '1',
        'likes_enabled' => '1'
    ];

    try {
        $stmt = $conn->prepare("SELECT setting_key, setting_value FROM site_settings");
        $stmt->execute();

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            if (array_key_exists($row['setting_key'], $settings)) {
                $settings[$row['setting_key']] = $row['setting_value'];
            }
        }
    } catch (PDOException $e) {
        return $settings;
    }

    return $settings;
}
