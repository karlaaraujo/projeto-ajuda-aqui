<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campanha extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'campanhas';

    protected $fillable = [
        'titulo',
        'descricao',
        'categoria',
        'localizacao',
        'data',
        'meta',
        'progresso',
        'urgencia',
        'email_contato',
        'telefone_contato',
        'status',
        'organizador_id',
    ];

    protected $casts = [
        'data' => 'date',
        'progresso' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relacionamento: Uma campanha tem muitos voluntários
    public function voluntarios()
    {
        return $this->hasMany(Voluntario::class, 'campanha_id');
    }

    // Relacionamento: Uma campanha tem muitos doadores
    public function doadores()
    {
        return $this->hasMany(Doador::class, 'campanha_id');
    }

    // Relacionamento: Uma campanha pertence a um organizador (usuário)
    public function organizador()
    {
        return $this->belongsTo(Usuario::class, 'organizador_id');
    }

    // Scope: Campanhas ativas
    public function scopeAtivas($query)
    {
        return $query->where('status', 'ativa');
    }

    // Scope: Campanhas pausadas
    public function scopePausadas($query)
    {
        return $query->where('status', 'pausada');
    }

    // Scope: Campanhas encerradas
    public function scopeEncerradas($query)
    {
        return $query->where('status', 'encerrada');
    }

    // Scope: Filtrar por categoria
    public function scopePorCategoria($query, $categoria)
    {
        return $query->where('categoria', $categoria);
    }

    // Scope: Filtrar por urgência
    public function scopePorUrgencia($query, $urgencia)
    {
        return $query->where('urgencia', $urgencia);
    }

    // Scope: Buscar por palavra-chave
    public function scopeBuscar($query, $termo)
    {
        return $query->where(function($q) use ($termo) {
            $q->where('titulo', 'like', "%{$termo}%")
                ->orWhere('descricao', 'like', "%{$termo}%")
                ->orWhere('localizacao', 'like', "%{$termo}%");
        });
    }

    // Accessor: Contagem de voluntários
    public function getQuantidadeVoluntariosAttribute()
    {
        return $this->voluntarios()->count();
    }

    // Accessor: Contagem de doadores
    public function getQuantidadeDoadoresAttribute()
    {
        return $this->doadores()->count();
    }

    // Accessor: Total de participantes
    public function getTotalParticipantesAttribute()
    {
        return $this->quantidade_voluntarios + $this->quantidade_doadores;
    }

    // Método: Pausar campanha
    public function pausar()
    {
        $this->status = 'pausada';
        $this->save();
    }

    // Método: Reativar campanha
    public function reativar()
    {
        $this->status = 'ativa';
        $this->save();
    }

    // Método: Encerrar campanha
    public function encerrar()
    {
        $this->status = 'encerrada';
        $this->save();
    }

    // Método: Atualizar progresso
    public function atualizarProgresso($novoProgresso)
    {
        $this->progresso = min(100, max(0, $novoProgresso));
        $this->save();
    }
}
