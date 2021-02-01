<?php

/* Teste completo da API:
     - Faz login
     - Pega o token para ser usado nas requisições
     - Cadastra um usuário
     - Consulta o usuário que foi cadastrado
     - Edita o usuário que foi cadastrado
     - Busca o usuário que foi cadastrado
     - Deleta o usuário que foi cadastrado
*/

namespace Tests\Feature;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    private $token;
    private $user;
    private $pass;
    private $response_login;
    private $dados;
    protected static $wasSetup = false;

    public function setUp(): void
    {
        parent::setUp();

        // login
        $this->response_login = $this->login();

        #guarda o token para ser usado nas requisições
        $this->token = $this->response_login->json()["access_token"];

        #dados que serão usados para cadastrar um novo usuário
        $this->dados   = [
            'name' => 'test name',
            'email' => 'teste@mailtesttttt.com',
            'password' => Hash::make('123'),
            'cpf' => '882.784.070-29'
        ];

        // roda somente uma vez
        if ( ! static::$wasSetup) {
            $user = User::where('email', $this->dados["email"])->first();

            if ($user) {
                $user->delete(); // caso ocorra algum problema no teste e o user fica na tabela, exclui ele
            }

            static::$wasSetup = true;
        }
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email) {
        #pega o id do usuário pelo email
        $user = User::where('email', $email)->first();
        $id = $user->id;

        return $id;
    }

    /**
     * @return \Illuminate\Testing\TestResponse
     * Faz login e retorna um response
     */
    public function login()
    {
        #pega infos do login do .env
        $this->user = env("LOGIN_EMAIL");
        $this->pass = env("LOGIN_PASS");

        #url da rota para login
        $url = "/api/login?email=$this->user&password=$this->pass";

        return $this->get($url);
    }

    /**
     * testa o login
     */
    public function testLogin()
    {
        $response = $this->response_login;

        $response->assertStatus(200);
    }

    /**
     * testa a criação de um usuário usando a API
     */
    public function testStore()
    {
        #seta o jwt token
        $headers = ['Authorization' => "Bearer $this->token"];

        #post para a rota
        $json = $this->json('POST', '/api/store', $this->dados, $headers);

        $json->assertStatus(201); //created
    }

    /**
     * testa edição de usuário
     */
    public function testUpdate()
    {
        #pega id do usuário cadastrado anteriormente
        $id = $this->getUserByEmail($this->dados["email"]);

        #seta o jwt token
        $headers = ['Authorization' => "Bearer $this->token"];
        $dados = $this->dados;

        #altera o nome do usuário
        $dados["name"] = "test name ATUALIZADO";

        #post para a rota /api/update/
        $json = $this->json("POST", "/api/update/$id", $dados, $headers);

        #verifica se o nome retornado é o mesmo que foi atualizado
        $this->assertEquals($dados["name"], $json->json()["name"]);

        $json->assertStatus(200);

    }

    /**
     * consulta usuário que foi cadastrado e atualizado
     */
    public function testUser() {

        #pega id do usuário cadastrado anteriormente
        $id = $this->getUserByEmail($this->dados["email"]);

        #get para a rota api/user/{id}
        $response = $this->get("api/user/$id");

        #checa o dado name
        $this->assertNotEmpty($response->json()["name"]);

        $response->assertStatus(200);
    }

    /**
     * testa o delete de usuário
     */
    public function testDelete()
    {
        #pega id do usuário cadastrado anteriormente
        $id = $this->getUserByEmail($this->dados["email"]);

        #delete para a rota /api/delete/{id}
        $response = $this->delete("/api/delete/$id");

        $response->assertStatus(200);

        #busca o usuário
        $user = User::find($id);

        #verifica se é null
        $this->assertNull($user);
    }
}
