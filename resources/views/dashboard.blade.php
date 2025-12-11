@section('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-adicionar-eventos">
        <h2 class="titulo-secao">Cadastrar Ação Solidária</h2>

        <div class="container-cadastro-evento">
            <form action="{{ route('acoes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <h3 class="titulo">Informações da Ação</h3>
                <div class="form-grid">
                    <div class="full-width">
                        <input type="text" id="titulo" name="titulo" class="input-padrao-evento"
                            placeholder="Título da Ação*" value="{{ old('titulo') }}" required>
                    </div>

                    <div class="full-width">
                        <textarea id="descricao" name="descricao" class="textarea-padrao" rows="5"
                            placeholder="Descrição da Ação">{{ old('descricao') }}</textarea>
                    </div>

                    <div class="full-width">
                        <label for="imagem" class="text-comum">Imagem da Ação</label>
                        <input type="file" id="imagem" name="imagem" class="input-padrao-evento" accept="image/*">
                        <small class="text-muted">Formatos aceitos: JPG, PNG, GIF (máx. 2MB)</small>
                    </div>

                    <div>
                        <label for="categoria_id" class="text-comum">Categoria</label>
                        <select id="categoria_id" name="categoria_id" class="input-padrao-evento">
                            <option value="">Selecione uma categoria</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="urgencia" class="text-comum">Urgência*</label>
                        <select id="urgencia" name="urgencia" class="input-padrao-evento" required>
                            <option value="baixa" {{ old('urgencia') == 'baixa' ? 'selected' : '' }}>Baixa</option>
                            <option value="media" {{ old('urgencia', 'media') == 'media' ? 'selected' : '' }}>Média</option>
                            <option value="alta" {{ old('urgencia') == 'alta' ? 'selected' : '' }}>Alta</option>
                            <option value="critica" {{ old('urgencia') == 'critica' ? 'selected' : '' }}>Crítica</option>
                        </select>
                    </div>

                    <div>
                        <label for="data" class="text-comum">Data da Ação</label>
                        <input type="date" id="data" name="data" class="input-padrao-evento"
                            value="{{ old('data') }}">
                    </div>

                    <div>
                        <label for="meta" class="text-comum">Meta (R$)</label>
                        <input type="number" step="0.01" id="meta" name="meta" class="input-padrao-evento"
                            placeholder="0.00" value="{{ old('meta') }}">
                    </div>

                    <div class="full-width">
                        <input type="text" id="localizacao" name="localizacao" class="input-padrao-evento"
                            placeholder="Localização" value="{{ old('localizacao') }}">
                    </div>
                </div>

                <h3 class="titulo">Informações de Contato</h3>
                <div class="form-grid">
                    <div>
                        <input type="email" id="email_contato" name="email_contato" class="input-padrao-evento"
                            placeholder="Email de Contato" value="{{ old('email_contato') }}">
                    </div>
                    <div>
                        <input type="text" id="telefone_contato" name="telefone_contato" class="input-padrao-evento"
                            placeholder="Telefone de Contato" value="{{ old('telefone_contato') }}">
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-4 mb-2">
                    <button type="submit" class="btn btn-enviar">Cadastrar Ação</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function () {
        $('#categorias').select2({
            placeholder: "Selecione as categorias",
            allowClear: true
        });
    });
</script>

