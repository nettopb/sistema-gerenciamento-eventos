# Sistema de Gerenciamento de Eventos — Produção

Sistema web acadêmico para gerenciamento de eventos, desenvolvido em PHP com arquitetura MVC, MySQL e PDO. A aplicação possui autenticação, controle de sessão, perfis de usuário, proteção de rotas, CRUD de eventos, validações, proteção CSRF e tratamento de erros.

## 1. Objetivo

Disponibilizar uma aplicação simples para cadastro, consulta, alteração e exclusão de eventos, com controle de acesso por perfil.

## 2. Público-alvo

Usuários responsáveis pelo gerenciamento e consulta de eventos em um ambiente acadêmico ou organizacional.

## 3. Funcionalidades

- Login e logout.
- Controle de sessão.
- Perfis `ADMIN` e `USUARIO`.
- Proteção das rotas de eventos.
- Cadastro de eventos.
- Listagem de eventos.
- Edição de eventos.
- Exclusão de eventos com confirmação.
- Validações básicas.
- Mensagens de sucesso e erro.
- Senhas armazenadas com `password_hash()`.
- Verificação de senha com `password_verify()`.
- Tokens CSRF nos formulários que alteram dados e no login/logout.
- Tratamento de exceções com registro em log.
- Interface responsiva básica em CSS.

## 4. Tecnologias

- PHP 8.2 ou superior.
- MySQL.
- Apache.
- PDO.
- HTML5.
- CSS3.
- JavaScript para confirmação de exclusão.
- Arquitetura MVC.

## 5. Ambiente de execução

A aplicação foi desenvolvida com XAMPP e a versão de produção foi publicada e testada na InfinityFree.

- Apache: servidor web.
- MySQL: banco de dados.
- PHP: processamento da aplicação.

URL de desenvolvimento local:

`http://localhost/sistema-gerenciamento-eventos/`

A URL anterior com `/public/` continua disponível para compatibilidade com a instalação local.

## 6. Estrutura

```text
sistema-gerenciamento-eventos/
├── app/
│   ├── Controllers/
│   ├── Core/
│   ├── Models/
│   └── Views/
├── config/
├── database/
├── public/
│   ├── assets/css/
│   └── index.php
├── assets/css/
├── index.php
├── routes/
├── storage/logs/
├── .gitignore
└── README.md
```

## 7. Arquitetura MVC

**Models** tratam o acesso aos dados.

**Views** apresentam as telas.

**Controllers** recebem as requisições, validam os dados, verificam autenticação/autorização e coordenam Models e Views.

**Core** concentra recursos compartilhados, como banco de dados, autenticação, sessão, CSRF, roteamento, tratamento de erros e classes-base.

## 8. Banco de dados

O arquivo `database/eventos.sql` cria o banco `eventos` e as tabelas `eventos` e `usuarios`.

Os usuários de demonstração possuem senhas armazenadas como hash e são criados somente se seus e-mails ainda não existirem.

### Usuários de demonstração

| E-mail | Senha | Perfil |
|---|---|---|
| admin@eventos.com | 123456 | ADMIN |
| usuario@eventos.com | 123456 | USUARIO |

As credenciais acima são destinadas exclusivamente à demonstração acadêmica local.

## 9. Instalação no XAMPP

1. Instale o XAMPP com Apache, MySQL e PHP.
2. Copie a pasta do projeto para `C:\xampp\htdocs\sistema-gerenciamento-eventos`.
3. Inicie Apache e MySQL no XAMPP.
4. Abra o phpMyAdmin.
5. Execute o conteúdo de `database/eventos.sql`.
6. Acesse `http://localhost/sistema-gerenciamento-eventos/`.

A configuração padrão considera MySQL local com usuário `root` e senha vazia, padrão comum do XAMPP. Se sua instalação utilizar outra configuração, altere `config/config.php`.

## 10. Autenticação e autorização

O login consulta o usuário pelo e-mail e verifica a senha por meio de `password_verify()`.

Após o login, a aplicação cria uma sessão e regenera o identificador da sessão.

O perfil `ADMIN` pode cadastrar, editar e excluir eventos.

O perfil `USUARIO` pode visualizar os eventos, mas não pode executar operações administrativas.

As verificações são realizadas no servidor, não apenas na interface.

## 11. Proteção CSRF

Os formulários de login, logout, cadastro, atualização e exclusão utilizam token CSRF armazenado na sessão e validado com `hash_equals()`.

## 12. Tratamento de erros

A aplicação não exibe detalhes técnicos de exceções para o usuário final. O registro de erros é mantido em:

`storage/logs/app.log`

Arquivos de log são ignorados pelo Git e não devem ser publicados.

## 13. Segurança

- Senhas não são armazenadas em texto puro.
- Sessões utilizam `HttpOnly` e `SameSite=Lax`.
- O identificador da sessão é regenerado após login.
- Rotas administrativas são protegidas no servidor.
- Formulários utilizam CSRF.
- Consultas SQL utilizam prepared statements.
- Saída HTML proveniente de dados do usuário utiliza `htmlspecialchars()`.
- Detalhes de erros internos não são exibidos em produção/apresentação.


## 14. Preparação para deploy

A aplicação foi preparada para hospedagem PHP/MySQL sem abandonar a execução local no XAMPP. O ponto de entrada recomendado para hospedagem é o `index.php` da raiz do projeto, protegido pelo `.htaccess`.

A configuração do banco pode ser fornecida por variáveis de ambiente:

- `EVENTOS_DB_HOST`
- `EVENTOS_DB_NAME`
- `EVENTOS_DB_USER`
- `EVENTOS_DB_PASS`

Como alternativa, pode ser criado localmente o arquivo `config/config.local.php`, baseado em `config/config.local.example.php`. Esse arquivo está no `.gitignore` e não deve ser enviado ao GitHub quando contiver credenciais reais.

Em hospedagens que forneçam banco já criado, utilize `database/estrutura.sql`, que cria as tabelas e os usuários de demonstração sem executar `CREATE DATABASE`. O arquivo `database/eventos.sql` continua adequado para uma instalação completa no XAMPP.

O projeto não depende de Composer, Node.js ou serviços externos.

## 15. Segurança para hospedagem

- `display_errors` permanece desativado.
- Exceções são registradas em `storage/logs/app.log`.
- Diretórios internos possuem proteção contra acesso direto.
- Senhas utilizam `password_hash()` e `password_verify()`.
- Formulários utilizam proteção CSRF.
- Consultas utilizam prepared statements.
- A sessão utiliza `HttpOnly` e `SameSite=Lax`.
- O identificador da sessão é regenerado após autenticação.
- As operações administrativas são protegidas no servidor.
- O arquivo de configuração local com credenciais não deve ser versionado.

## 16. Testes realizados

### ADMIN

- Login.
- Logout.
- Cadastro.
- Listagem.
- Edição.
- Exclusão.
- Acesso às funções administrativas.

### USUARIO

- Login.
- Logout.
- Listagem.
- Bloqueio de cadastro.
- Bloqueio de edição.
- Bloqueio de exclusão.

## 17. Entregas acadêmicas

### Entrega Parcial 1

Planejamento, objetivos, público-alvo, funcionalidades, modelagem e protótipos.

### Entrega Parcial 2

Estrutura MVC, controllers, views e sistema de rotas.

### Entrega Parcial 3

Conexão PDO, cadastro e listagem de eventos.

### Entrega Parcial 4

CRUD completo, validações e mensagens de retorno.

### Entrega Parcial 5

Login, logout, sessão, perfis, proteção de rotas e armazenamento seguro de senhas.

### Projeto Final

Sistema funcional, documentação, repositório GitHub organizado em branches de desenvolvimento e produção, deploy na InfinityFree e vídeo demonstrativo.

## 18. Produção e deploy

A versão de produção utiliza a InfinityFree com o domínio `netto.free.nf` e banco MySQL `if0_42877599_PISW2`. A configuração com credenciais reais permanece somente no servidor, em `config/config.local.php`, e esse arquivo é ignorado pelo Git.

A versão publicada foi validada com login, sessão, controle de acesso por perfil, CRUD de eventos, CSRF, tratamento de erros e conexão com o banco remoto.

Para detalhes do procedimento de publicação, consulte `DEPLOY.md`.

## 19. GitHub

O repositório deve conter somente os arquivos necessários ao projeto. Credenciais reais, logs, configurações pessoais do editor e arquivos temporários não devem ser versionados.

## 20. Demonstração

O vídeo deve apresentar a tela inicial, login como administrador, CRUD, logout, login como usuário comum, bloqueio das funções administrativas, funcionamento geral do sistema e a versão publicada.

## 21. Licença

Projeto acadêmico desenvolvido para fins educacionais.
