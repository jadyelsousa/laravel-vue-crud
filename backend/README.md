## Api em Laravel

Este projeto é uma API construída em Laravel, que permite a criação, leitura, atualização e exclusão de recursos da aplicação.

## Instalação
Requerido: PHP 8 e Laravel 9.0

Para instalar este projeto, siga os seguintes passos:

Clone o repositório:
```terminal
git clone https://github.com/jadyelsousa/laravel-vue-crud.git
```
Entre na pasta do projeto:
```terminal
cd laravel-vue-crud/backend
```
Instale as dependências do projeto:
```terminal
composer install
```
Crie um arquivo .env com as configurações do seu ambiente. Você pode copiar o arquivo .env.example e configurar as variáveis de ambiente de acordo com seu ambiente:
```terminal
cp .env.example .env
``` 
Gere uma chave para o aplicativo:
```terminal
php artisan key:generate
``` 
Crie um banco de dados MySQL e configure as variáveis de ambiente DB_DATABASE, DB_USERNAME e DB_PASSWORD com as informações de conexão.

Execute as migrações do banco de dados e popule com os Seeders:
```terminal
php artisan migrate --seed
```
Inicie o servidor de desenvolvimento:
```terminal
php artisan serve
```
O servidor de desenvolvimento estará disponível em http://localhost:8000.

As rotas estão configuradas no arquivo `routes/api.php`.

* `GET api/products`, para pegar os dados cadastrados de todos os produtos;
* `GET api/products/{id}`, para pegar um produto específico pelo id;
* `POST api/products/store`, para criar um novo produto;
* `POST api/products/{id}`, para atualizar um produto específico pelo id;
* `DELETE api/products/{id}`, para excluir um produto específico pelo id;
