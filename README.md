# Ajuda Aqui

**Ajuda Aqui** é uma plataforma web desenvolvida para conectar organizações de caridade, voluntários e doadores. Este projeto tem como objetivo centralizar informações sobre ações solidárias, campanhas de doação e oportunidades de voluntariado, facilitando que pessoas e organizações possam fazer a diferença em suas comunidades.

## 📋 Funcionalidades

- **Buscar ações solidárias**: Encontre ações por categoria, urgência, data ou localização
- **Visualizar detalhes**: Veja informações completas de cada ação, incluindo meta, progresso, contatos e descrição
- **Cadastro de ações**: Organizadores autenticados podem criar e gerenciar ações solidárias
- **Upload de imagens**: Adicione fotos para ilustrar suas ações
- **Filtros avançados**: Filtre por categoria (Alimentação, Vestuário, Saúde, Educação, Moradia, Meio Ambiente)
- **Níveis de urgência**: Visualize ações classificadas por urgência (baixa, média, alta, crítica)
- **Sistema de autenticação**: Registro e login para organizadores

## 🔧 Tecnologias Utilizadas

### Backend
- **PHP 8.2+**
- **Laravel 11.31**
- **Laravel Breeze** (autenticação)
- **MySQL 8.0**

### Frontend
- **Blade Templates**
- **Bootstrap 5.3.3**
- **Alpine.js**
- **CSS3** com variáveis customizadas

## 📦 Requisitos do Sistema

Antes de iniciar, certifique-se de ter instalado:

- **PHP** >= 8.2
- **Composer 2.x**
- **MySQL** >= 8.0
- **Node.js** >= 18.x e npm
- **Git**

## 🚀 Como Rodar o Projeto Localmente

### 1. Clone o Repositório

```bash
git clone <url-do-repositorio>
cd projeto-ajuda-aqui
```

### 2. Instale as Dependências do PHP

**Importante**: Este projeto requer Composer 2.x

```bash
composer install
```

Se você tiver problemas com a versão do Composer, use o caminho completo para o Composer 2:

```bash
# Exemplo no Windows
C:\caminho\para\composer-2\composer.bat install
```

### 3. Configure o Arquivo de Ambiente

Copie o arquivo de exemplo e configure as variáveis de ambiente:

```bash
cp .env.example .env
```

**Edite o arquivo `.env`** e configure as seguintes variáveis:

```env
APP_NAME="Ajuda Aqui"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ajuda_aqui
DB_USERNAME=seu_usuario_mysql
DB_PASSWORD=sua_senha_mysql
```

### 4. Gere a Chave da Aplicação

```bash
php artisan key:generate
```

### 5. Configure o Banco de Dados

#### 5.1. Crie o Banco de Dados

**Inicie o MySQL** e crie o banco de dados:

```sql
CREATE DATABASE ajuda_aqui CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### 5.2. Execute as Migrations

```bash
php artisan migrate
```

Isso criará as seguintes tabelas:
- `users` (usuários/organizadores)
- `categorias` (categorias de ações)
- `acoes` (ações solidárias)
- `voluntarios` (inscrições de voluntários)
- `doadores` (registros de doações)

#### 5.3. (Opcional) Popule o Banco com Dados Iniciais

```bash
php artisan db:seed
```

Isso criará 6 categorias padrão:
- Alimentação
- Vestuário
- Saúde
- Educação
- Moradia
- Meio Ambiente

### 6. Crie o Link Simbólico para o Storage

Para que as imagens enviadas sejam acessíveis publicamente:

```bash
php artisan storage:link
```

### 7. Instale as Dependências do Frontend

```bash
npm install
```

### 8. Compile os Assets do Frontend

**Para desenvolvimento** (com hot reload):

```bash
npm run dev
```

**Para produção**:

```bash
npm run build
```

### 9. Inicie o Servidor de Desenvolvimento

Em um novo terminal, execute:

```bash
php artisan serve
```

O projeto estará disponível em: **http://localhost:8000**

## 🗂️ Estrutura do Projeto

```
projeto-ajuda-aqui/
├── app/
│   ├── Http/Controllers/
│   │   ├── AcaoController.php       # Gerenciamento de ações
│   │   └── HomeController.php       # Página inicial
│   └── Models/
│       ├── Acao.php                 # Modelo de ações solidárias
│       ├── Categoria.php            # Categorias de ações
│       ├── Doador.php               # Registros de doações
│       ├── Voluntario.php           # Inscrições de voluntários
│       └── User.php                 # Usuários organizadores
├── database/
│   ├── migrations/                  # Migrações do banco de dados
│   └── seeders/                     # Seeders (dados iniciais)
├── public/
│   ├── css/                         # Estilos customizados
│   └── img/                         # Imagens estáticas
├── resources/
│   └── views/
│       ├── acao/                    # Views de ações
│       ├── layouts/                 # Layouts da aplicação
│       └── welcome.blade.php        # Página inicial
└── routes/
    └── web.php                      # Rotas da aplicação
```

## 🎯 Rotas Principais

- `GET /` - Página inicial com ações em destaque
- `GET /acoes` - Listagem de todas as ações
- `GET /acoes/hoje` - Ações acontecendo hoje
- `GET /acoes/{id}` - Detalhes de uma ação específica
- `GET /cadastrar-acao` - Formulário de cadastro de ação (requer autenticação)
- `POST /acoes` - Criar nova ação (requer autenticação)
- `GET /login` - Página de login
- `GET /register` - Página de registro

## 🔒 Credenciais de Teste

Após executar as migrations, você pode criar um usuário através da página de registro em:

**http://localhost:8000/register**

## 🛠️ Comandos Úteis do Artisan

```bash
# Limpar todos os caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Recriar banco de dados (ATENÇÃO: apaga todos os dados)
php artisan migrate:fresh --seed

# Atualizar autoload do Composer
composer dump-autoload

# Ver todas as rotas
php artisan route:list
```

## 🐛 Solução de Problemas Comuns

### Erro: "No application encryption key"
```bash
php artisan key:generate
```

### Erro: "SQLSTATE[HY000] [2002] Connection refused"
- Verifique se o MySQL está rodando
- Confirme as credenciais no arquivo `.env`

### Erro relacionado ao Composer
- Certifique-se de estar usando Composer 2.x
- Execute: `composer --version`

### Imagens não aparecem
```bash
php artisan storage:link
```

### Páginas não carregam estilos
```bash
npm run build
php artisan view:clear
```

## 👥 Equipe de Desenvolvimento

- **Ingrid Mônica**
- **Karla Cristina**
- **Haul Muller**

## 📄 Licença

Este projeto foi desenvolvido para fins educacionais.

---

**Ajuda Aqui** - Juntos fazemos a diferença! 💙
