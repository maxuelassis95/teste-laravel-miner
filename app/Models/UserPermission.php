<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;


    /**
     * Métodos responsaveis pelo relacionamentos
     */

     public function user(){

        return $this->belongsTo(User::class);

    }

     public function permission(){

        return $this->belongsTo(Permission::class);

    }

}
