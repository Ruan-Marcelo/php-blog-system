# 📝 PHP Blog CMS (PHP & MySQL)

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.x-blue?style=for-the-badge&logo=php">
  <img src="https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge&logo=mysql">
  <img src="https://img.shields.io/badge/Bootstrap-5-purple?style=for-the-badge&logo=bootstrap">
  <img src="https://img.shields.io/badge/jQuery-AJAX-blue?style=for-the-badge&logo=jquery">
  <img src="https://img.shields.io/badge/Status-Em%20Desenvolvimento-yellow?style=for-the-badge">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge">
</p>

---

## 📌 Sobre o Projeto

Sistema web completo de gerenciamento de conteúdo (CMS) desenvolvido com PHP e MySQL, com foco em autenticação segura, controle de sessões, operações CRUD e interações dinâmicas utilizando AJAX.

O projeto simula um ambiente real de aplicação, incluindo painel administrativo, gerenciamento de posts, sistema de comentários e recursos interativos, aproximando-se de sistemas utilizados em produção.

---

## 🎯 Objetivo do Projeto

Este projeto foi desenvolvido com o objetivo de consolidar conhecimentos em desenvolvimento web full stack, simulando um sistema real com boas práticas de organização, segurança e interação com o usuário.

---

## 🚀 Funcionalidades

- 🔐 Autenticação de usuários (Login / Logout)
- 👤 Sistema de sessão para controle de acesso
- ✍️ CRUD completo de posts (Criar, Editar, Excluir)
- 💬 Sistema de comentários por post
- 👍 Sistema de likes dinâmico com AJAX
- 🔍 Busca de posts
- 🗂️ Filtro por categorias
- 📄 Visualização detalhada de posts
- 📱 Layout responsivo


## 🔐 Segurança
- Senhas armazenadas utilizando hash seguro
- Controle de acesso baseado em sessão
- Validação de dados no frontend e backend
- Proteção contra SQL Injection com consultas preparadas
- Sanitização de entradas para evitar XSS

---

## 🛠️ Tecnologias Utilizadas

| Tecnologia | Uso |
|----------|-----|
| 🐘 PHP | Backend |
| 🗄️ MySQL | Banco de dados |
| 🌐 HTML5 & CSS3 | Estrutura e estilo |
| 🎨 Bootstrap | Responsividade |
| ⚡ JavaScript + jQuery | Interações e AJAX |

---

## 📸 Screenshots

### 🏠 Página Inicial
```bash
![Home](screenshots/home.png)
```

### ⚙️ Dashboard
```bash
![Dashboard](screenshots/dashboard.png)
```

---

## ⚙️ Como Rodar o Projeto

### 📥 1. Clonar o repositório
```bash
git clone https://github.com/Ruan-Marcelo/php-blog-system.git
cd blog-php-mysql
```

### 🗄️ 2. Configurar o banco de dados
```bash
- Abra o phpMyAdmin
- Crie um banco chamado: blog
- Importe o arquivo: database/blog.sql
```

### 🔧 3. Configurar a conexão
```bash
Edite o arquivo: db_conn.php
```

```bash
$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "blog";
```

### ▶️ 4. Iniciar o servidor
```bash
Use XAMPP, WAMP ou Laragon
```

### 🌐 5. Acessar no navegador
```bash
http://localhost/blog
```

---

## 📈 Melhorias Futuras

- [ ] 🧠 Sistema de tags
- [ ] 🌐 API REST
- [ ] 📊 estatísticas
- [ ] 🔔 Sistema de notificações

---

## 📄 Licença

Este projeto está sob a licença **MIT**.

---

## 💡 Inspiração e Aprendizado

Projeto desenvolvido com base em estudos práticos de desenvolvimento web com PHP e MySQL.

### 📺 Referência:
```bash
https://www.youtube.com/watch?v=Bcc97YC18Z0
```

---

## 🚀 Evoluções Implementadas

- ✅ Organização profissional de pastas
- ✅ Sistema de login funcional com sessão
- ✅ Correção de erros comuns (PDO, includes, paths)
- ✅ Implementação de likes com AJAX
- ✅ Sistema de comentários
- ✅ Melhorias visuais com Bootstrap
- ✅ Estrutura próxima de projetos reais

---

## 👨‍💻 Autor

**Ruan Luz** 🚀  
Focado em evolução como desenvolvedor **Full Stack**
