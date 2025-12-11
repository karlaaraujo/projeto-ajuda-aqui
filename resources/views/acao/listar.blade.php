@section('styles')
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endsection

<x-guest-layout title="Listagem de Ações">
    <section class="container-homepage">
        <!-- Filtros de busca -->
        <section class="container-filtros">
            <h1 class="titulo-secao">Filtros</h1>
            <form action="{{ route('acoes.listar') }}" method="GET">
                <div class="filtros">
                    <!-- Filtro de Título -->
                    <input
                        type="text"
                        name="titulo"
                        class="campo-filtro"
                        placeholder="Título da Ação"
                        value="{{ request('titulo') }}" />

                    <!-- Filtro de Categoria -->
                    <select name="categoria_id" class="campo-filtro">
                        <option value="">Selecione a Categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Filtro de Urgência -->
                    <select name="urgencia" class="campo-filtro">
                        <option value="">Urgência</option>
                        <option value="baixa" {{ request('urgencia') == 'baixa' ? 'selected' : '' }}>Baixa</option>
                        <option value="media" {{ request('urgencia') == 'media' ? 'selected' : '' }}>Média</option>
                        <option value="alta" {{ request('urgencia') == 'alta' ? 'selected' : '' }}>Alta</option>
                        <option value="critica" {{ request('urgencia') == 'critica' ? 'selected' : '' }}>Crítica</option>
                    </select>

                    <!-- Filtro de Data -->
                    <input type="date" name="data" class="campo-filtro" value="{{ request('data') }}" />

                    <!-- Botão de Aplicar Filtro -->
                    <button type="submit" class="botao-saiba-mais btn">Filtrar</button>
                </div>
            </form>
        </section>

        <!-- Lista de Ações -->
        <section class="container-listagem-eventos">
            <h1 class="titulo-secao">Ações Solidárias</h1>

            @if($acoes->count())
                <div class="grid-eventos">
                    @foreach ($acoes as $acao)
                        <div class="evento-card">
                            <img src="{{ $acao->imagem ? asset('storage/' . $acao->imagem) : asset('img/placeholder-acao.jpg') }}" alt="Imagem da Ação" class="imagem-placeholder" />
                            <div class="evento-conteudo">
                                <h2 class="titulo-evento">{{ $acao->titulo }}</h2>
                                <p class="data-evento">{{ $acao->data ? $acao->data->format('d/m/Y') : 'Data a definir' }}</p>
                                <p class="descricao-evento">{{ Str::limit($acao->descricao, 100) }}</p>
                                @if($acao->categoria)
                                    <span class="badge bg-secondary">{{ $acao->categoria->nome }}</span>
                                @endif
                                <span class="badge bg-{{ $acao->urgencia === 'critica' ? 'danger' : ($acao->urgencia === 'alta' ? 'warning' : 'info') }}">
                                    {{ ucfirst($acao->urgencia) }}
                                </span>
                                <a href="{{ route('acoes.show', $acao->id) }}" class="botao-saiba-mais">Saiba mais</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginação -->
                <div class="mt-4">
                    {{ $acoes->links() }}
                </div>
            @else
                <p class="nenhum-evento">Nenhuma ação encontrada para os filtros aplicados.</p>
            @endif
        </section>
    </section>
</x-guest-layout>
