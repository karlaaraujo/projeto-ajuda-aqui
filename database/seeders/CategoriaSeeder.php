<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nome' => 'Alimentação',
                'descricao' => 'Campanhas de arrecadação de alimentos',
                'icone' => 'food',
                'cor' => '#FF6B6B',
                'ativo' => true,
            ],
            [
                'nome' => 'Vestuário',
                'descricao' => 'Doação de roupas e calçados',
                'icone' => 'clothing',
                'cor' => '#4ECDC4',
                'ativo' => true,
            ],
            [
                'nome' => 'Saúde',
                'descricao' => 'Ações relacionadas à saúde e bem-estar',
                'icone' => 'health',
                'cor' => '#95E1D3',
                'ativo' => true,
            ],
            [
                'nome' => 'Educação',
                'descricao' => 'Apoio educacional e material escolar',
                'icone' => 'education',
                'cor' => '#F38181',
                'ativo' => true,
            ],
            [
                'nome' => 'Moradia',
                'descricao' => 'Apoio a pessoas em situação de vulnerabilidade habitacional',
                'icone' => 'home',
                'cor' => '#AA96DA',
                'ativo' => true,
            ],
            [
                'nome' => 'Meio Ambiente',
                'descricao' => 'Ações de preservação ambiental',
                'icone' => 'environment',
                'cor' => '#81C784',
                'ativo' => true,
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
