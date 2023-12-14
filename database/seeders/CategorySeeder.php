<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Permite cria categorias em massa usando o Factory, aqui passamos apenas 10 como quantidade
        Category::factory(10)->create();

    }
}
