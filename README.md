### Requerimentos

- PHP >= 7.2.0

**Extensões PHP obrigatórias**

- BCMath
- Ctype PHP
- JSON PHP
- Mbstring PHP
- OpenSSL PHP
- PDO PHP
- Tokenizer
- XML

**Gerenciador de pacotes**
- Composer

# Instalação

####Faça o download do projeto ou clone o repositório

`$ git clone https://github.com/rodrigosarri/desafio-backend.git `

####Faça a instalação das dependências

`$ composer install `

Crie a base de dados utilizando a instrução (opcional)

    CREATE DATABASE IF NOT EXISTS `challenge` CHARSET `utf8mb4` COLLATE `utf8mb4_general_ci`;

Faça uma cópia do arquivo `.env.example` e renomei para `.env` e altere nas linhas 12, 13 e 14 para os dados da sua conexão com banco de dados e base de dados.

        DB_DATABASE=challenge
		DB_USERNAME=php
		DB_PASSWORD=123456

É necessário realizar a "instalação" das tabelas na base de dados, dessa forma para realizar essa ação é necessário abrir o CMD, PowerShell ou Terminal, acesse a pasta (*cd desafio-backend*): `desafio-backend` e execute o comando: 

    php artisan migrate

Gere uma chave para o Laravel através do comando:

    php artisan key:generate

Gere uma chave para o JWT (json web token):

    php artisan jwt:secret

Rode a aplicação API através do comando:

    php artisan serve

A aplicação está pronta para ser utilizada. As rotas para criar, selecionar o usuário, atualizar e apagar são:

http://localhost:8000/api/register
http://localhost:8000/api/profile
http://localhost:8000/api/update
http://localhost:8000/api/delete