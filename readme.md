# Desafio Desenvolvedor BackEnd

## Índice
- [Requisitos](#Requisitos)
- [Instalação](#instalacao)
- [Rotas](#Rotas)

## Requisitos
- Nginx ou Apache
- PHP 7.1.^
- Composer
- MySQL 5.7

<a name="instalacao"></a>
## Instalação
Clone este repositório:
```
git clone https://github.com/mathxbap/desafio-backend.git
```
No terminal, acesse ao diretório:
```
cd desafio-backend
```
Instale as dependências:
```
composer install
```
Clone o arquivo .env.example
```
cp .env.example .env
```
Gere a chave de segurança
```
php artisan key:generate
```
Configure o arquivo .env para acessar ao seu banco de dados
Execute as migrations
```
php artisan migrate
```
Inicie o Laravel\Passport
```
php artisan passport:install
```
Crie um link simbólico de public para storage
```
php artisan storage:link
```
Configure um virtual host ou inicie um servidor para acessar a API
```
php artisan serve
```

## Rotas

|     Rota     |   Método  | Middleware |                              Descrição                             |
|:------------:|:---------:|:----------:|:------------------------------------------------------------------:|
|     /user    |    GET    |     ---    | Retorna JSON com todos usuários.                                   |
|     /user    |    POST   |     ---    | Registra um novo usuário.                                          |
|   /user/id   |    GET    |  auth:api  | Retorna, se encontrado, JSON do usuário corresponde ao ID da rota. |
|   /user/id   | PUT/PATCH |  auth:api  | Atualiza, se encontrado, usuário corresponde ao ID da rota.        |
|   /user/id   |   DELETE  |  auth:api  | Deleta, se encontrado, usuário corresponde ao ID da rota.          |
|  /auth/login |    POST   |     ---    | Efetua login do usuário e retorna seu access_token.                |
| /auth/logout |    GET    |  auth:api  | Efetua logout do usuário autenticado.                              |
|  /auth/user  |    GET    |  auth:api  | Retorna JSON do usuário autenticado.                               |