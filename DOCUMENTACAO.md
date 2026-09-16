# Documentação Final — Sistema de Gerenciamento de Eventos

## 1. Apresentação

O Sistema de Gerenciamento de Eventos é uma aplicação web acadêmica desenvolvida em PHP para demonstrar a construção de uma aplicação MVC com persistência em MySQL, operações CRUD e mecanismos básicos de autenticação e autorização.

## 2. Requisitos funcionais

- RF01 — Autenticar usuário.
- RF02 — Encerrar sessão.
- RF03 — Identificar o perfil do usuário autenticado.
- RF04 — Listar eventos para usuários autenticados.
- RF05 — Cadastrar eventos para administradores.
- RF06 — Editar eventos para administradores.
- RF07 — Excluir eventos para administradores.
- RF08 — Validar campos obrigatórios e formatos básicos.
- RF09 — Informar sucesso ou falha das operações.
- RF10 — Impedir acesso de usuários não autenticados às funções protegidas.
- RF11 — Impedir operações administrativas por usuários comuns.

## 3. Requisitos de segurança

- Senhas armazenadas com `password_hash()`.
- Senhas verificadas com `password_verify()`.
- Prepared statements via PDO.
- Regeneração do ID de sessão no login.
- Cookie de sessão com `HttpOnly` e `SameSite=Lax`.
- Tokens CSRF para requisições sensíveis.
- Verificação de autorização no servidor.
- Tratamento de exceções sem exposição de detalhes técnicos.
- Registro de erros em arquivo local ignorado pelo Git.

## 4. Fluxo principal

```text
Usuário
   |
   v
Tela de login
   |
   +---- inválido ----> mensagem de erro
   |
   v
Sessão autenticada
   |
   v
Lista de eventos
   |
   +---- USUARIO ----> somente leitura
   |
   +---- ADMIN ------> cadastrar / editar / excluir
```

## 5. Camadas

### Controller

Coordena a requisição, valida entradas, verifica autenticação/autorização e direciona a execução.

### Model

Centraliza a comunicação com o banco de dados.

### View

Apresenta os dados ao usuário.

### Core

Implementa componentes compartilhados: conexão PDO, sessão/autenticação, CSRF, roteador, tratamento de erros e classes-base.

## 6. Banco de dados

### Tabela `eventos`

| Campo | Tipo | Regra |
|---|---|---|
| id | INT | PK, AUTO_INCREMENT |
| titulo | VARCHAR(150) | NOT NULL |
| data_evento | DATE | NOT NULL |
| local | VARCHAR(120) | NOT NULL |

### Tabela `usuarios`

| Campo | Tipo | Regra |
|---|---|---|
| id | INT | PK, AUTO_INCREMENT |
| nome | VARCHAR(100) | NOT NULL |
| email | VARCHAR(150) | NOT NULL, UNIQUE |
| senha | VARCHAR(255) | NOT NULL, hash |
| perfil | ENUM | ADMIN ou USUARIO |
| criado_em | TIMESTAMP | padrão do banco |

## 7. Matriz de acesso

| Operação | ADMIN | USUARIO | Não autenticado |
|---|---:|---:|---:|
| Login | Sim | Sim | Sim |
| Visualizar eventos | Sim | Sim | Não |
| Cadastrar | Sim | Não | Não |
| Editar | Sim | Não | Não |
| Excluir | Sim | Não | Não |
| Logout | Sim | Sim | Não |

## 8. Rotas

| Método | Rota | Acesso |
|---|---|---|
| GET | `/` | Público |
| GET | `/login` | Público |
| POST | `/login` | Público + CSRF |
| POST | `/logout` | Autenticado + CSRF |
| GET | `/eventos` | Autenticado |
| GET | `/eventos/novo` | ADMIN |
| POST | `/eventos/salvar` | ADMIN + CSRF |
| GET | `/eventos/editar` | ADMIN |
| POST | `/eventos/atualizar` | ADMIN + CSRF |
| POST | `/eventos/excluir` | ADMIN + CSRF |

## 9. Ambiente de apresentação

A aplicação será executada localmente no XAMPP, utilizando Apache, PHP e MySQL. A URL de apresentação é:

`http://localhost/sistema-gerenciamento-eventos/public/`

## 10. Critérios de demonstração

A apresentação deve comprovar:

1. Login válido.
2. Login inválido.
3. Sessão autenticada.
4. CRUD completo como ADMIN.
5. Logout.
6. Login como USUARIO.
7. Visualização como USUARIO.
8. Bloqueio das operações administrativas.
9. Confirmação de exclusão.
10. Interface funcionando no navegador.
