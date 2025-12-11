@section('styles')
<link rel="stylesheet" href="{{ asset('css/homepage.css')}}">
@endsection

<x-guest-layout title="Bem-vindo">
    <section class="container-homepage">
        <!-- Ações em destaque -->
        <section class="container-eventos-destaque">
            <h1 class="titulo-secao">Ações em Destaque</h1>
            <div class="evento-destaque">
                @foreach ($acoesDestaque as $acao)
                    <div class="evento-card destaque">
                        <img src="{{ $acao->imagem ? asset('storage/' . $acao->imagem) : asset('img/placeholder-acao.jpg') }}" alt="Imagem" class="imagem-placeholder" />
                        <div class="evento-conteudo">
                            <h2 class="titulo-evento">{{ $acao->titulo }}</h2>
                            <p class="descricao-evento">{{ Str::limit($acao->descricao, 150) }}</p>
                            <span class="badge bg-{{ $acao->urgencia === 'critica' ? 'danger' : ($acao->urgencia === 'alta' ? 'warning' : 'info') }}">
                                Urgência: {{ ucfirst($acao->urgencia) }}
                            </span>
                            <a href="{{ route('acoes.show', $acao->id) }}" class="botao-saiba-mais">Saiba mais</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Próximas ações -->
        <section class="container-proximos-eventos">
            <h1 class="titulo-secao">Próximas Ações</h1>
            <div class="grid-eventos">
                @foreach ($proximasAcoes as $acao)
                    <div class="evento-card">

                        <img src="{{ $acao->imagem ? asset('storage/' . $acao->imagem) : asset('img/placeholder-acao.jpg') }}" alt="Imagem" class="imagem-placeholder" />
                        <div class="evento-conteudo">
                            <h2 class="titulo-evento">{{ $acao->titulo }}</h2>
                            <p class="data-evento">{{ $acao->data ? $acao->data->format('d/m/Y') : 'Data a definir' }}</p>
                            <p class="descricao-evento">{{ Str::limit($acao->descricao, 100) }}</p>
                            @if($acao->categoria)
                                <span class="badge bg-secondary">{{ $acao->categoria->nome }}</span>
                            @endif
                            <a href="{{ route('acoes.show', $acao->id) }}" class="botao-saiba-mais">Saiba mais</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Categorias -->
        <section class="container-categorias">
            <h1 class="titulo-secao categorias">Categorias</h1>
            <p class="descricao-categorias">Explore as diversas categorias de ações solidárias disponíveis na plataforma.</p>
            <div class="grid-categorias">
                @foreach ($categorias as $categoria)
                    <div class="categoria-item">
                        <div class="imagem-placeholder"></div>
                        <p class="categoria-nome">{{ $categoria->nome }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Cadastre sua ação -->
        <section class="divulgue-evento">
            <h1 class="titulo-secao">Cadastre sua ação solidária!</h1>
            <a href="{{ route('cadastro.acao') }}" class="botao-saiba-mais">Cadastrar</a>
        </section>
    </section>
</x-guest-layout>
