
# Instruções para Execução do Projeto

## 1. Subir o ambiente com Docker

Para iniciar o projeto, abra um terminal na pasta que contém o arquivo `docker-compose.yml` e execute o seguinte comando:

```bash
docker compose up --build -d
```

Isso irá construir e rodar os containers em segundo plano.

## 2. Acessar o terminal do Backend (Laravel)

Para rodar os comandos do Laravel, você precisa acessar o terminal do Docker onde o PHP está rodando. Para isso, abra um terminal na mesma pasta e execute:

```bash
docker compose exec php sh
```

Dentro do container, você poderá rodar os comandos do Laravel, como:

- `php artisan <comando>`
- `composer <comando>`

## 3. Acessar o terminal do Frontend (Vue.js)

Para executar comandos do frontend (com o NPM), abra um terminal na mesma pasta e execute:

```bash
docker compose exec vue-ui sh
```

Dentro do container, você poderá rodar os comandos do NPM, como:

- `npm install`

## 4. Primeira execução do Backend

Na primeira vez que você rodar o projeto, será necessário configurar o ambiente do backend.

1. Navegue até a pasta `backend` e crie um arquivo `.env` nela. 
2. Copie o conteúdo do arquivo `.env.example` para o novo arquivo `.env` (não apague o `.env.example`).

Depois disso, abra o terminal do Docker (com o comando mencionado acima) e execute os seguintes comandos para configurar o Laravel:

```bash
composer update
php artisan key:generate
php artisan migrate
```

Esses comandos irão:

- **Atualizar as dependências** com o `composer update`.
- **Gerar a chave de aplicação** com `php artisan key:generate`.
- **Rodar as migrações do banco de dados** com `php artisan migrate`.



php artisan storage:link