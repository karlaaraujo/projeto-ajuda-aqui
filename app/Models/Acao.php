<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acao extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'acoes';

    protected $fillable = [
        'titulo',
        'descricao',
        'imagem',
        'categoria_id',
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
        'meta' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relacionamento: Uma ação pertence a uma categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    // Relacionamento: Uma ação tem muitos voluntários
    public function voluntarios()
    {
        return $this->hasMany(Voluntario::class, 'acao_id');
    }

    // Relacionamento: Uma ação tem muitos doadores
    public function doadores()
    {
        return $this->hasMany(Doador::class, 'acao_id');
    }

    // Relacionamento: Uma ação pertence a um organizador (usuário)
    public function organizador()
    {
        return $this->belongsTo(User::class, 'organizador_id');
    }

    // Scope: Ações ativas
    public function scopeAtivas($query)
    {
        return $query->where('status', 'ativa');
    }

    // Scope: Ações pausadas
    public function scopePausadas($query)
    {
        return $query->where('status', 'pausada');
    }

    // Scope: Ações encerradas
    public function scopeEncerradas($query)
    {
        return $query->where('status', 'encerrada');
    }

    // Scope: Filtrar por categoria
    public function scopePorCategoria($query, $categoriaId)
    {
        return $query->where('categoria_id', $categoriaId);
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

    // Método: Pausar ação
    public function pausar()
    {
        $this->status = 'pausada';
        $this->save();
    }

    // Método: Reativar ação
    public function reativar()
    {
        $this->status = 'ativa';
        $this->save();
    }

    // Método: Encerrar ação
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
