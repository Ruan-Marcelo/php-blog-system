# Apoio Pet CMS

Sistema web em PHP e MySQL para publicacoes, comentarios, curtidas, animais para adocao, banners e painel administrativo.

## Recursos

- Autenticacao de usuarios e administradores.
- Perfil do usuario comum com dados da conta, troca de senha, posts curtidos, comentarios e posts vistos recentemente.
- Redefinicao de senha por usuario e nome completo cadastrado.
- Blog com busca global, categorias, comentarios e curtidas.
- Edicao e exclusao dos proprios comentarios.
- Cadastro e gerenciamento de animais, posts, categorias, usuarios e banners pelo admin.
- Validacao de uploads de imagem por tamanho, extensao e MIME real.
- Confirmacao antes de exclusoes.
- Layout admin com ajustes responsivos para telas menores.

## Estrutura

```text
admin/              Painel administrativo, telas e handlers admin.
admin/data/         Funcoes de acesso a dados do admin.
admin/req/          Actions administrativas de criacao/edicao.
app/actions/user/   Logica das actions publicas de usuario.
assets/             CSS, imagens, JavaScript e AJAX.
php/                Wrappers de compatibilidade das rotas antigas.
upload/             Imagens enviadas pelo sistema.
*.php               Paginas publicas principais.
```

As rotas antigas em `php/` continuam funcionando e apenas encaminham para `app/actions/user/`.

## Como Rodar

1. Abra o XAMPP e inicie Apache e MySQL.
2. Crie o banco `blog_db`.
3. Importe `blog_db.sql`.
4. Confira a porta e credenciais em `db_conn.php`.
5. Acesse:

```text
http://localhost/php-blog-system/
```

## Configuracao do Banco

O projeto usa PDO em `db_conn.php`:

```php
$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "blog_db";
```

Neste ambiente local o MySQL esta configurado na porta `3307`.

## Validacao

Para validar sintaxe PHP:

```powershell
Get-ChildItem -Recurse -Filter *.php | ForEach-Object { php -l $_.FullName }
```

## Versao Atual

Versao: `v1.2.0`

Principais mudancas recentes:

- Navbar ativa e pesquisa global.
- Perfil do usuario comum.
- Redefinicao de senha.
- Edicao/exclusao de comentarios pelo autor.
- Validacoes de formularios e preservacao de dados em erro.
- Organizacao das actions de usuario em `app/actions/user/`.

## Licenca

MIT.
