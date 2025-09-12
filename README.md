# BankManager: Painel Administrativo de Matrículas

Bem-vindo(a) ao **BankManager**, uma aplicação para gerenciar a matrícula de alunos em cursos. O projeto foi desenvolvido em PHP com arquitetura MVC, com um backend Orientado a Objeto e um frontend desacoplado em ReactJS, seguindo os requisitos do teste técnico da Finnet.

## 🎯 Objetivo

O objetivo desta aplicação é fornecer um painel administrativo para:

  - Gerenciar o **CRUD** (Criar, Ler, Atualizar, Deletar) de Cursos, Alunos e Matrículas.
  - Permitir a busca de Alunos por nome ou e-mail.
  - Fornecer um sistema de autenticação para acesso ao painel.

O projeto foi construído para demonstrar o conhecimento em **PHP MVC** e as **melhores práticas de desenvolvimento**, como o uso de migrations para o banco de dados e testes unitários.

## ⚙️ Estrutura do Projeto

A arquitetura do projeto é dividida em duas partes principais:

  - **`backend/`**: A aplicação principal em PHP, responsável por expor a API RESTful.
  - **`frontend/`**: A interface do usuário em ReactJS, que consome a API do backend.

<!-- end list -->

```
finnet-case-bankmanager/
├── backend/
│   ├── app/
│   │   ├── Controllers/
│   │   │   └── API/    (Controladores da API)
│   │   ├── Core/       (Router, Database, etc.)
│   │   └── Models/     (Models da API)
│   ├── database/
│   │   └── migrations/ (Migrations do banco de dados)
│   ├── docker/
│   ├── tests/          (Testes unitários)
│   ├── vendor/
│   ├── composer.json
│   └── docker-compose.yml
│   └── Dockerfile
├── frontend/
│   ├── public/
│   ├── src/
│   │   ├── components/
│   │   └── pages/      (Páginas)
│   ├── package.json
│   └── vite.config.js
└── README.md
```

## 🚀 Instalação e Execução

Siga os passos abaixo para ter a aplicação rodando em sua máquina.

### Pré-requisitos

  - Docker e Docker Compose instalados.
  - Node.js e npm instalados.

### 1\. Iniciar o Backend

O Docker irá gerenciar a aplicação PHP e o banco de dados MySQL automaticamente.

  - Construa e inicie os contêineres do Docker:
    `docker-compose up --build -d`

### 2\. Configurar o Banco de Dados

  - Execute as migrations para criar as tabelas no banco de dados:
    `docker-compose exec app php vendor/bin/phinx migrate`

  - (Opcional, mas recomendado) Execute a seeder para popular o banco de dados com dados de teste para Alunos e Cursos:
    `docker-compose exec app php vendor/bin/phinx seed:run --seed=InitialDataSeeder`

### 3\. Configurar o Frontend

  - Navegue até a pasta `frontend`:
    `cd frontend`

  - Instale as dependências do Node.js:
    `npm install`

  - Inicie o servidor de desenvolvimento do frontend:
    `npm run dev`

### 4\. Acessar a Aplicação

Sua aplicação estará disponível em `http://localhost:5173`.

### Credenciais de Login

Para acessar o painel, use as seguintes credenciais:

  - **Email**: `jubilut@gmail.com`
  - **Senha**: `jubilut123`

## ✅ Testes e Qualidade

  - **Testes Unitários**: O projeto conta com testes unitários para os principais modelos (Course, Enrollment). Para rodar os testes, execute:
    `docker-compose exec app vendor/bin/phpunit`

  - **Migrations**: Todas as alterações no esquema do banco de dados são geridas por migrations, garantindo um ambiente de desenvolvimento consistente.

  - **Boas Práticas**: A arquitetura desacoplada permite que a equipe de backend e frontend trabalhe de forma independente.
