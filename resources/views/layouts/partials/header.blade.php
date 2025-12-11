<header class="header">
    <div class="div-itens-nav">
        <a href="{{ route('home') }}">
            <img class="logo" src="{{ asset('img/2.png') }}" alt="logo Ajuda Aqui">
        </a>
        <a href="{{ route('acoes.listar') }}" class="item-nav">Todas as ações</a>
        <a href="{{ route('acoes.listar.hoje') }}" class="item-nav">Hoje</a>
        <a href="{{ route('acoes.listar') }}" class="item-nav">Próximas</a>
        <a href="{{ route('login') }}" class="item-nav">Cadastre sua ação</a>
    </div>

    <div class="container-btn-login">
        @auth
            <!-- Dropdown para usuários logados -->
            <div class="dropdown">
                <button class="btn btn-usuario dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">Minhas Ações</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">Sair</button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <!-- Botão para visitantes -->
            <a href="{{ route('login') }}" class="btn btn-primary">Entrar</a>
        @endauth
    </div>
</header>
