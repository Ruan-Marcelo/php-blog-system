# Politica de Seguranca

## Escopo

Este projeto cobre:

- Login e logout de usuarios e administradores.
- Controle de acesso por sessao.
- CRUD administrativo.
- Comentarios, curtidas e perfil do usuario.
- Uploads de imagens de posts, animais e banners.

## Medidas Implementadas

- Senhas armazenadas com `password_hash`.
- Verificacao de senha com `password_verify`.
- Consultas com PDO e prepared statements.
- Validacao de uploads por erro, tamanho, extensao e MIME real.
- Escapes de saida com `htmlspecialchars` nos pontos revisados.
- Confirmacao antes de exclusoes no painel admin.
- Encerramento de sessao apos exclusao da propria conta.
- Rotas antigas mantidas como wrappers para evitar quebra de navegacao.

## Riscos Conhecidos

- O fluxo de "esqueci minha senha" e local e academico: valida usuario e nome completo. Em producao, deve ser substituido por token temporario enviado por e-mail.
- Ainda nao ha protecao CSRF centralizada para todos os formularios.
- Algumas telas antigas ainda podem precisar de revisao fina de encoding e escape de saida.

## Reporte

Para reportar uma falha, informe:

- Descricao do problema.
- Passos para reproduzir.
- Impacto esperado.
- Arquivo ou rota afetada.

## Versoes

- `v1.2.0`: melhorias de perfil, recuperacao de senha, comentarios, busca, validacoes e organizacao das actions de usuario.
