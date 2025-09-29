<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Aponta para sua tabela correta
    protected $table = 'usuarios';

    public $timestamps = false; 

    // Quais campos podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'data_nascimento',
        'endereco',
        'telefone',
        'email',
        'senha_hash',  // campo da senha
        'genero'
    ];

    // Ocultar campos sensíveis ao serializar o usuário
    protected $hidden = [
        'senha_hash',
    ];

    /**
     * Para que o Laravel saiba que a senha está no campo 'senha_hash',
     * sobrescrevemos o getter da senha:
     */
    public function getAuthPassword()
    {
        return $this->senha_hash;
    }
}
