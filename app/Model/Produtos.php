<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table = 'produtos';
    protected $primarykey = 'id';
    protected $fillable = [
        'cadastro_kit_id',
        'categoria',
        'nome_descricao',
        'preco',
        'image',
        'tipo'
    ];
}
