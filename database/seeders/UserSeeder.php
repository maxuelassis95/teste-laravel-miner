<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Aqui está criando dois usuarios para teste,
         * se quiser usar mais,use o factory descomentando a linha abaixo e comentando o restante desse bloco.
         */

        // User::factory(10)->create();

        User::create([
            'name' => 'João',
            'email' => 'joao@gmail.com',
            'password' => bcrypt('01234567'),
        ]);

        User::create([
            'name' => 'Natalia',
            'email' => 'natalia@gmail.com',
            'password' => bcrypt('11234567'),
        ]);

    }
}
