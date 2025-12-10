<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doador extends Model
{
    use HasFactory;

    protected $table = 'doadores';

    protected $fillable = [
        'campanha_id',
        'nome',
        'email',
        'telefone',
        'tipo_doacao', // 'dinheiro', 'alimentos', 'roupas', 'outros'
        'valor_estimado',
        'descricao_doacao',
        'status',
        'data_doacao',
    ];

    protected $casts = [
        'valor_estimado' => 'decimal:2',
        'data_doacao' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relacionamento: Um doador pertence a uma campanha
    public function campanha()
    {
        return $this->belongsTo(Campanha::class, 'campanha_id');
    }

    // Scope: Doações confirmadas
    public function scopeConfirmadas($query)
    {
        return $query->where('status', 'confirmada');
    }

    // Scope: Doações pendentes
    public function scopePendentes($query)
    {
        return $query->where('status', 'pendente');
    }

    // Scope: Por tipo de doação
    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo_doacao', $tipo);
    }

    // Método: Confirmar doação
    public function confirmar()
    {
        $this->status = 'confirmada';
        $this->data_doacao = now();
        $this->save();
    }
}
