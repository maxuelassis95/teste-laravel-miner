# Aplicação teste Laravel Miner (Back-End)

Este é um guia rápido para configurar e executar a aplicação em seu ambiente local.

## Foco Principal

Esta aplicação é projetada com um foco central no desenvolvimento back-end, lidando com a lógica, manipulação de dados e integração com o banco de dados. O front-end é mantido de forma simplificada para fins de teste, e a ênfase está na construção de uma robusta camada de servidor.

## Tecnologias Utilizadas

- **Laravel 10.37.2:** O framework PHP moderno e poderoso para desenvolvimento web.
- **PHP 8.1.10:** A linguagem de programação principal para o back-end da aplicação.
- **Blade:** O mecanismo de template do Laravel, utilizado para criar views de forma elegante e eficiente.
- **Composer 2.4.1:** O gerenciador de dependências para PHP utilizado para instalar e gerenciar pacotes no Laravel.
- **MySQL 8.0.30:** Sistema de gerenciamento de banco de dados relacional usado para armazenar dados da aplicação.

## Pré-requisitos

1. **Ambiente de Desenvolvimento:**
   - Recomendo o uso de um ambiente como o [Laragon](https://laragon.org/) para facilitar a configuração do Apache, PHP e MySQL.

2. **PHP:**
   - Certifique-se de ter o PHP instalado (versão recomendada: 7.4 ou superior).

3. **Composer:**
   - Instale o [Composer](https://getcomposer.org/), uma ferramenta de gerenciamento de dependências para PHP.

## Servidor de Desenvolvimento

1. **Inicie os Serviços do Laragon:**
   - Antes de iniciar o servidor embutido do Laravel, certifique-se de ter iniciado os serviços do Laragon (ou ambiente de desenvolvimento similar). Isso inclui o servidor web (por exemplo, Apache) e o servidor de banco de dados (por exemplo, MySQL).

     - No Laragon, clique no botão "Start All" no painel do Laragon para iniciar todos os serviços necessários.

2. **Inicie o Servidor Embutido do Laravel:**
   - Após iniciar os serviços do Laragon, você pode iniciar o servidor embutido do Laravel usando o seguinte comando:

     ```bash
     php artisan serve
     ```

   - Acesse a aplicação em [http://localhost:8000](http://localhost:8000).

## Configuração Inicial

1. **Clone o Repositório:**
   - Clone este repositório para o seu ambiente de desenvolvimento local. Escolha a pasta apropriada com base no seu servidor local:

     - **Laragon (www):**
       ```bash
       git clone https://github.com/maxuelassis95/teste-laravel-miner.git C:/laragon/www/teste-laravel-miner
       ```

     - **XAMPP (htdocs):**
       ```bash
       git clone https://github.com/maxuelassis95/teste-laravel-miner.git C:/xampp/htdocs/teste-laravel-miner
       ```

     - **Wamp (www):**
       ```bash
       git clone https://github.com/maxuelassis95/teste-laravel-miner.git C:/wamp/www/teste-laravel-miner
       ```

2. **Instale as Dependências:**
   - Execute o seguinte comando para instalar as dependências do Laravel.
     ```bash
     composer install
     ```

3. **Crie um Arquivo .env:**
   - Copie o arquivo de exemplo `.env.example` para um novo arquivo chamado `.env`.
     ```bash
     cp .env.example .env
     ```

4. **Configure o .env:**
   - Edite o arquivo `.env` e ajuste as configurações, especialmente as relacionadas ao banco de dados.

     ```dotenv
     APP_NAME=SuaAplicacao
     APP_ENV=local
     APP_KEY=ChaveGeradaAutomaticamenteAoExecutarArtisanKeyGenerate
     ...
     ```

   - **Importante:** Execute o seguinte comando para gerar a chave única da aplicação.

     ```bash
     php artisan key:generate
     ```


## Banco de Dados

1. **Criação do Banco de Dados:**
   - Antes de prosseguir, crie um banco de dados vazio no seu sistema de gerenciamento de banco de dados (por exemplo, MySQL).

2. **Atualização do Arquivo .env:**
   - Abra o arquivo `.env` e ajuste as configurações do banco de dados conforme necessário.

     ```dotenv
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=nome_do_seu_banco_de_dados
     DB_USERNAME=seu_usuario
     DB_PASSWORD=sua_senha
     ```

   - Substitua `nome_do_seu_banco_de_dados`, `seu_usuario` e `sua_senha` pelos detalhes do banco de dados que você acabou de criar.

3. **Execução de Migrações e Seeders:**
   - Após configurar o arquivo `.env`, execute as migrações do banco de dados para criar as tabelas necessárias.

     ```bash
     php artisan migrate
     ```

   - Em seguida, preencha o banco de dados com dados de exemplo usando os seeders.

     ```bash
     php artisan db:seed
     ```

## Usuários de Teste

- **Usuário Padrão:**
  - Email: user@user.com
  - Senha: 12345

- **Usuário Administrador:**
  - Email: admin@admin.com
  - Senha: 12345

## Contato para Suporte

Se encontrar problemas ou tiver dúvidas durante a configuração, entre em contato pelo email: [maxuelassis95@gmail.com](mailto:maxuelassis95@gmail.com).

---
