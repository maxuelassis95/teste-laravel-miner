<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Permission extends Model
{
    use HasFactory;

    /**
     * É responsável por criar o relacionamento de muitos para muitos entre User e Permission
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_permissions');
    }

}
