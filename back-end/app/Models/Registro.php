<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $table = "registro_usuarios";

    protected $fillable = [
        'id', 'nome', 'cpf', 'data_nascimento', 'email'
    ];
}
