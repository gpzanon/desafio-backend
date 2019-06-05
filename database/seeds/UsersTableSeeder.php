<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'HugoGeneras',
            'email' => 'huggo11@icloud.com',
            'cpf'	=> '00000000000',
            'isAdmin' => true,
            'password' => bcrypt('testezanon'),
        ]);
    }
}