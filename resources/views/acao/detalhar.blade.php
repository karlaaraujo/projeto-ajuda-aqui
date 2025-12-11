@section('styles')
    <link rel="stylesheet" href="{{ asset('css/homepage.css')}}">
@endsection
<x-guest-layout title="{{ $acao->titulo }}">
    <section class="container-homepage">

        <section class="container-eventos-destaque">

            <h1 class="titulo-secao">{{ $acao->titulo }}</h1>
            <div class="evento-destaque">
                <div class="evento-card destaque">
                    <img src="{{ $acao->imagem ? asset('storage/' . $acao->imagem) : asset('img/placeholder-acao.jpg') }}" alt="Imagem" class="imagem-evento" />
                </div>
            </div>

        </section>

        <section class="container-proximos-eventos">
            <div class="grid-eventos">
                <div class="evento-card">
                    <div class="evento-conteudo">
                        <h2 class="titulo-evento">O que?</h2>
                        <p class="descricao-evento">{{ $acao->descricao }}</p>
                        @if($acao->categoria)
                            <span class="badge bg-secondary">{{ $acao->categoria->nome }}</span>
                        @endif
                    </div>
                </div>

                <div class="evento-card">
                    <div class="evento-conteudo">
                        <h2 class="titulo-evento">Quando?</h2>
                        <p class="descricao-evento">{{ $acao->data ? $acao->data->format('d/m/Y') : 'Data a definir' }}</p>
                        <span class="badge bg-{{ $acao->urgencia === 'critica' ? 'danger' : ($acao->urgencia === 'alta' ? 'warning' : 'info') }}">
                            Urgência: {{ ucfirst($acao->urgencia) }}
                        </span>
                    </div>
                </div>

                <div class="evento-card">
                    <div class="evento-conteudo">
                        <h2 class="titulo-evento">Onde?</h2>
                        <p class="descricao-evento">{{ $acao->localizacao ?? 'Local a definir' }}</p>
                    </div>
                </div>

                <div class="evento-card">
                    <div class="evento-conteudo">
                        <h2 class="titulo-evento">Progresso</h2>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $acao->progresso }}%"
                                aria-valuenow="{{ $acao->progresso }}" aria-valuemin="0" aria-valuemax="100">
                                {{ $acao->progresso }}%
                            </div>
                        </div>
                        @if($acao->meta)
                            <p class="mt-2">Meta: R$ {{ number_format($acao->meta, 2, ',', '.') }}</p>
                        @endif
                    </div>
                </div>

                <div class="evento-card">
                    <div class="evento-conteudo">
                        <h2 class="titulo-evento">Contato</h2>
                        @if($acao->email_contato)
                            <p>Email: {{ $acao->email_contato }}</p>
                        @endif
                        @if($acao->telefone_contato)
                            <p>Telefone: {{ $acao->telefone_contato }}</p>
                        @endif
                    </div>
                </div>

                <div class="evento-card">
                    <div class="evento-conteudo">
                        <h2 class="titulo-evento">Participação</h2>
                        <p>Voluntários: {{ $acao->quantidade_voluntarios }}</p>
                        <p>Doadores: {{ $acao->quantidade_doadores }}</p>
                    </div>
                </div>
            </div>
        </section>

    </section>
</x-guest-layout>
