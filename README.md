# API de cadastro de usuários em Laravel 6.12

- Autor: Nasser Suhail Farhat


##Instalando e executando
Para a execução do projeto é necessário conter o MYSQL instalado e rodando na porta 3306, além do Laravel 6.12.

Crie um banco de dados com o nome de "desafio-seguralta", clone este repositório na pasta que deseja.
Após o projeto estar clonado, execute os comandos abaixo:

- cd desafio-backend
- php artisan key:generate
- php artisan migrate
- php artisan serve

O projeto será inicializado no endereço http://127.0.0.1:8000. Assim que 
entra-se com o código artisan:migrate, todas as tabelas são criadas no banco de dados "desafio-seguralta".

##Usando o PostMan para testar a API
Para efetuar o cadastro de um novo usuário na DB é necessário utilizar o método POST atribuído a rota http://127.0.0.1:8000/api/cadastro/create/

![](https://image.prntscr.com/image/emAJAW2xQlOjuEDZ_0wd8g.png)
Perceba que após o endereço, é adicionado o símbolo "?" e as credênciais do usuário a ser criado, isso tudo é possível apenas preenchendo a aba KEY e em seguida a VALUE no próprio POSTMAN.

Para editar algum parâmetro de um usuário já existente, utilize o método POST, no final do endereço coloque o ID do usuário a ser editado.  http://127.0.0.1:8000/api/cadastro/edit/{id} "COLOQUE APENAS O ID, SEM AS CHAVES"
![](https://image.prntscr.com/image/nmoJRZvISL67Ni8GQTNVuQ.png)
Basta colocar o que será editado no parâmetro KEY e no VALUE a nova informação do usuário, seguindo o print.

Para efetuar o delete de algum cadastro, utilize o método DELETE, e no final do endereço também adicione o ID do cadastro a ser deletado, seguindo o exemplo do print.
http://127.0.0.1:8000/api/cadastro/delete/{id}" COLOQUE APENAS O ID, SEM AS CHAVES"
![](https://image.prntscr.com/image/e183O30jTdWcdBwT2m8h9w.png)



Para mostrar os usuário cadastrados ou algum usuário específico, utilize o método GET, utilizando o endereço : http://127.0.0.1:8000/api/cadastro
E caso deseja ver um usuário por seu ID, utilize http://127.0.0.1:8000/api/cadastro/{id} "COLOQUE APENAS O ID, SEM AS CHAVES"
![](https://image.prntscr.com/image/eLTUvOU_TKOrvlW4XhsjfA.png)

**Projeto finalizado e enviado para avialição do GrupoZanon.**
