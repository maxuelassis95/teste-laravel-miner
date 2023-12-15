<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /**
         * Como irá ter apenas três permissões, manage-product, manage-brand e manage-category,
         * eu realizo uma verificação, para caso tente rodar o db:seed novamente não ocorra erro
         */

         // Verifica se já existem registros na tabela 'permissions'
        if (Permission::count() === 0) {
            // Se não houver registros, cria novos
            Permission::create(['name' => 'manage_brands']);
            Permission::create(['name' => 'manage_categories']);
            Permission::create(['name' => 'manage_products']);
        } else {

            $this->command->info('Permissions já foram seedados. Pulando a operação.');

        }
    }

}
