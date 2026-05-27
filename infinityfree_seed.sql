-- Seed para publicar no InfinityFree apos importar a estrutura principal do banco.
-- Banco esperado: blog_db

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `site_settings` (
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  PRIMARY KEY (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `site_settings` (`setting_key`, `setting_value`) VALUES
('site_name', 'APOIO PET'),
('site_description', 'Conteudo, adocao responsavel e apoio a quem cuida de animais abandonados.'),
('contact_email', 'contato@apoiopet.com.br'),
('contact_phone', '(47) 99999-0000'),
('whatsapp', '(47) 99999-0000'),
('instagram', 'https://instagram.com/apoiopet'),
('facebook', 'https://facebook.com/apoiopet'),
('footer_text', 'Apoio Pet conecta informacao, cuidado e adocao responsavel para transformar vidas.'),
('comments_enabled', '1'),
('likes_enabled', '1')
ON DUPLICATE KEY UPDATE `setting_value` = VALUES(`setting_value`);

DELETE FROM `banner`;
INSERT INTO `banner` (`id`, `image`, `title`, `active`) VALUES
(1, 'banner-adocao-responsavel.png', 'Adocao responsavel', 1),
(2, 'banner-saude-animal.png', 'Saude e cuidado animal', 1),
(3, 'banner-resgate-denuncia.png', 'Resgate e denuncia', 1);

DELETE FROM `post_like`;
DELETE FROM `comment`;
DELETE FROM `post`;
DELETE FROM `category`;
DELETE FROM `animals`;

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Adocao'),
(2, 'Saude animal'),
(3, 'Resgate'),
(4, 'Educacao');

INSERT INTO `post` (`post_id`, `post_title`, `post_text`, `category`, `publish`, `cover_url`, `crated_at`) VALUES
(1, 'Como adotar com responsabilidade', 'Adotar e um compromisso de cuidado, tempo e planejamento. Antes de levar um animal para casa, organize espaco, rotina, alimentacao, vacinas e acompanhamento veterinario.', 1, 1, 'COVER-69ebeaff1e7360.70521633.jpg', NOW()),
(2, 'Cuidados basicos nos primeiros dias', 'Os primeiros dias pedem paciencia. Deixe agua limpa, alimento adequado, local tranquilo para descanso e observe sinais de medo, dor ou desconforto.', 2, 1, 'COVER-69ebeb061e6077.86964233.jpg', NOW()),
(3, 'Por que a castracao ajuda a combater o abandono', 'A castracao reduz ninhadas indesejadas, melhora o controle populacional e evita sofrimento de filhotes que poderiam nascer sem lar seguro.', 2, 1, 'COVER-69ebeb31538eb2.59207322.jpg', NOW()),
(4, 'Como denunciar maus-tratos', 'Registre provas com seguranca, anote local e horario e procure os canais oficiais da sua cidade. Denunciar de forma correta ajuda a salvar vidas.', 3, 1, 'COVER-69ebeb93ac71d2.43652879.jpg', NOW()),
(5, 'Voluntariado: pequenas acoes que ajudam muito', 'Compartilhar animais para adocao, doar racao, oferecer lar temporario e apoiar campanhas sao formas reais de fortalecer a causa animal.', 4, 1, 'COVER-69ebebda967695.jpeg', NOW()),
(6, 'Preparando a casa para receber um pet', 'Retire objetos perigosos, separe uma area de descanso, confira telas e portoes e mantenha produtos de limpeza fora do alcance.', 1, 1, 'COVER-69ebebef047162.91359424.jpg', NOW());

INSERT INTO `animals` (`id`, `name`, `species`, `age`, `description`, `image`) VALUES
(1, 'Mimi', 'Gato', 2, 'Carinhosa, tranquila e acostumada com pessoas. Procura uma familia paciente e segura.', 'ANIMAL-69ea59ce5b8222.39094122.png'),
(2, 'Bento', 'Cachorro', 6, 'Calmo, companheiro e ideal para quem busca um pet adulto e equilibrado.', 'ANIMAL-69ea5998812ff3.16130976.png'),
(3, 'Luna', 'Gato', 1, 'Jovem, curiosa e brincalhona. Precisa de um lar telado e responsavel.', 'ANIMAL-69ea5991249401.16780728.png'),
(4, 'Rex', 'Cachorro', 3, 'Resgatado recentemente, ja esta pronto para receber carinho e rotina estavel.', 'ANIMAL-69ea5988926626.91023796.png'),
(5, 'Milo', 'Gato', 4, 'Muito tranquilo, gosta de descanso e companhia. Bom para ambientes calmos.', 'ANIMAL-69ea59810b5341.16507702.png'),
(6, 'Bolt', 'Cachorro', 2, 'Ativo, alegre e cheio de energia. Combina com familia que gosta de passeios.', 'ANIMAL-69ea5979299df0.29056511.png');

ALTER TABLE `banner` AUTO_INCREMENT = 4;
ALTER TABLE `category` AUTO_INCREMENT = 5;
ALTER TABLE `post` AUTO_INCREMENT = 7;
ALTER TABLE `animals` AUTO_INCREMENT = 7;

COMMIT;
