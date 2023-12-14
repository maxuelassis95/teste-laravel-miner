<?php

namespace Database\Seeders;

use App\Models\UserPermission;
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
         * Cria as três permissões para o teste
         */

         UserPermission::create(['name' => 'manage_brands']);
         UserPermission::create(['name' => 'manage_categories']);
         UserPermission::create(['name' => 'manage_products']);

    }
}
