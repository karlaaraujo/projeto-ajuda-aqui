<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nome',
        'descricao',
        'icone',
        'cor',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relacionamento: Uma categoria tem muitas campanhas
    public function campanhas()
    {
        return $this->hasMany(Campanha::class, 'categoria_id');
    }

    // Scope: Categorias ativas
    public function scopeAtivas($query)
    {
        return $query->where('ativo', true);
    }
}
