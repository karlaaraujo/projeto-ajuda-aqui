<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voluntario extends Model
{
    use HasFactory;

    protected $table = 'voluntarios';

    protected $fillable = [
        'acao_id',
        'nome',
        'email',
        'telefone',
        'tipo_participacao', // 'voluntario', 'doador', 'ambos'
        'mensagem',
        'status',
        'confirmado_em',
    ];

    protected $casts = [
        'confirmado_em' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relacionamento: Um voluntário pertence a uma ação
    public function acao()
    {
        return $this->belongsTo(Acao::class, 'acao_id');
    }

    // Scope: Voluntários confirmados
    public function scopeConfirmados($query)
    {
        return $query->whereNotNull('confirmado_em')
            ->where('status', 'confirmado');
    }

    // Scope: Voluntários pendentes
    public function scopePendentes($query)
    {
        return $query->whereNull('confirmado_em')
            ->where('status', 'pendente');
    }

    // Scope: Por tipo de participação
    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo_participacao', $tipo);
    }

    // Método: Confirmar inscrição
    public function confirmar()
    {
        $this->confirmado_em = now();
        $this->status = 'confirmado';
        $this->save();

        // Aqui você pode enviar email de confirmação
        // Mail::to($this->email)->send(new ConfirmacaoInscricao($this));
    }

    // Método: Cancelar inscrição
    public function cancelar()
    {
        $this->status = 'cancelado';
        $this->save();
    }
}
