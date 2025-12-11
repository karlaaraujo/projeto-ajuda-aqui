<?php

namespace App\Http\Controllers;

use App\Models\Acao;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcaoController extends Controller
{
    /**
     * Listar todas as ações com filtros
     */
    public function listar(Request $request)
    {
        $query = Acao::ativas()->with('categoria');

        // Filtro por título
        if ($request->filled('titulo')) {
            $query->buscar($request->titulo);
        }

        // Filtro por categoria
        if ($request->filled('categoria_id')) {
            $query->porCategoria($request->categoria_id);
        }

        // Filtro por urgência
        if ($request->filled('urgencia')) {
            $query->porUrgencia($request->urgencia);
        }

        // Filtro por data
        if ($request->filled('data')) {
            $query->whereDate('data', '>=', $request->data);
        }

        $acoes = $query->orderByRaw("FIELD(urgencia, 'critica', 'alta', 'media', 'baixa')")
            ->orderBy('data', 'asc')
            ->paginate(12);

        $categorias = Categoria::ativas()->get();

        return view('acao.listar', compact('acoes', 'categorias'));
    }

    /**
     * Listar ações para hoje
     */
    public function listarHoje()
    {
        $acoes = Acao::ativas()
            ->with('categoria')
            ->whereDate('data', now())
            ->orderByRaw("FIELD(urgencia, 'critica', 'alta', 'media', 'baixa')")
            ->paginate(12);

        $categorias = Categoria::ativas()->get();

        return view('acao.listar', compact('acoes', 'categorias'));
    }

    /**
     * Exibir detalhes de uma ação
     */
    public function show(Acao $acao)
    {
        $acao->load(['categoria', 'organizador', 'voluntarios', 'doadores']);

        return view('acao.detalhar', compact('acao'));
    }

    /**
     * Exibir formulário de criação de ação
     */
    public function create()
    {
        $categorias = Categoria::ativas()->get();

        return view('dashboard', compact('categorias'));
    }

    /**
     * Salvar nova ação
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria_id' => 'nullable|exists:categorias,id',
            'localizacao' => 'nullable|string|max:255',
            'data' => 'nullable|date',
            'meta' => 'nullable|numeric|min:0',
            'urgencia' => 'required|in:baixa,media,alta,critica',
            'email_contato' => 'nullable|email',
            'telefone_contato' => 'nullable|string|max:20',
        ]);

        // Processar upload da imagem
        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('acoes', 'public');
            $validated['imagem'] = $imagemPath;
        }

        $validated['organizador_id'] = Auth::id();
        $validated['status'] = 'ativa';
        $validated['progresso'] = 0;

        $acao = Acao::create($validated);

        return redirect()->route('acoes.show', $acao)
            ->with('success', 'Ação criada com sucesso!');
    }
}
