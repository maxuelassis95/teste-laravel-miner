<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserPermission;
use App\Models\User;
use App\Models\Permission;

class UserPermissionFactory extends Factory
{
    protected $model = UserPermission::class;

    public function definition()
    {
        /**
             * Configura o Factory para gerar permissões aleatórias para usuarios,
             * mas trabalha a lógica, onde só poderá ter permissão, users que tenham registro
             * mas que o campo is_admin seja diferente de 1 (que não será admin)
             */

        $validUserIds = User::where('is_admin', '<>', '1')->pluck('id')->toArray();
        $validPermissionIds = Permission::pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($validUserIds),
            'permission_id' => $this->faker->randomElement($validPermissionIds),
        ];
    }
}

