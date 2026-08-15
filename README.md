# Sistema de Gerenciamento de Eventos

Aplicação web desenvolvida para gerenciamento de eventos, permitindo criação, listagem, edição, exclusão de eventos e autenticação de usuários. Projeto desenvolvido utilizando PHP sob a arquitetura MVC.

---

## 🛠️ Tecnologias Utilizadas

- **Linguagem:** PHP 8.x
- **Arquitetura:** MVC (Model-View-Controller)
- **Banco de Dados:** MySQL / PostgreSQL (via PDO)
- **Servidor Web:** Apache (com módulo `mod_rewrite` / `.htaccess`)
- **Gerenciador de Dependências:** Composer

---

## 📁 Estrutura do Projeto

```text
sistema-gerenciamento-eventos/
├── app/
│   ├── Controllers/     # Controladores (AuthController, EventoController, HomeController)
│   ├── Core/            # Classes base (Controller, Database, Model, Router)
│   ├── Models/          # Modelos (Evento, Usuario)
│   └── Views/           # Telas da aplicação (auth, evento, home)
├── config/              # Configurações globais do sistema
├── database/            # Scripts SQL e migrations
├── entregas/            # Documentações das entregas parciais
├── public/              # Ponto de entrada (index.php, .htaccess, assets)
├── routes/              # Mapeamento de rotas (web.php)
└── uploads/             # Diretório para armazenamento de arquivos enviados