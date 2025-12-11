<?php

namespace App\Http\Controllers;

use App\Models\Acao;
use App\Models\Categoria;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage with featured actions and categories
     */
    public function index()
    {
        // Buscar ações em destaque (ativas, ordenadas por urgência e data de criação)
        $acoesDestaque = Acao::ativas()
            ->with('categoria')
            ->orderByRaw("FIELD(urgencia, 'critica', 'alta', 'media', 'baixa')")
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Buscar próximas ações (ordenadas por data)
        $proximasAcoes = Acao::ativas()
            ->with('categoria')
            ->whereDate('data', '>=', now())
            ->orderBy('data', 'asc')
            ->take(6)
            ->get();

        // Buscar categorias ativas
        $categorias = Categoria::ativas()->get();

        return view('welcome', compact('acoesDestaque', 'proximasAcoes', 'categorias'));
    }
}
