Projeto encontra-se em fase de desenvolvimento...
# Template de Sistema pré Configurado Laravel

Template base para desenvolvimento rápido de sistemas utilizando **Laravel + Docker**, já preparado com:

* Autenticação
* Controle de nível de acesso (RBAC)
* Gerenciamento de perfil da empresa
* Ambiente Docker pronto para desenvolvimento
* Estrutura pensada para reutilização em múltiplos projetos

A ideia é que qualquer novo sistema possa começar a partir deste template sem precisar reconfigurar infraestrutura ou funcionalidades comuns.

---

# 1. Requisitos

Antes de iniciar, é necessário ter instalado:

* Docker Desktop
* Docker Compose
* Git

Não é necessário instalar PHP, Composer ou MySQL localmente.

---

# 2. Subindo o ambiente

Clone o projeto:

```bash
git clone <repo>
cd template-sistema-configurado
```

Suba o ambiente:

```bash
docker compose up --build
```

O Docker irá automaticamente:

* Construir os containers
* Instalar dependências do Composer
* Gerar a chave da aplicação
* Executar migrations
* Executar seeders
* Iniciar o PHP-FPM
* Iniciar o Nginx
* Iniciar o MySQL

Após a inicialização, acesse:

```
http://localhost:8000
```

---

# 3. Estrutura do ambiente Docker

O ambiente é composto por três containers principais:

### App (PHP + Laravel)

Responsável por executar:

* Laravel
* Composer
* Artisan
* PHP-FPM

### Nginx

Responsável por servir a aplicação web.

Porta exposta:

```
8000
```

### MySQL

Banco de dados da aplicação.

Porta exposta:

```
3307
```

Credenciais padrão:

```
database: base_db
user: root
password: root
```

---

# 4. Estrutura do projeto

```
app
 ├ Models
 │   ├ User
 │   ├ Role
 │   ├ Permission
 │   └ Company
 │
 ├ Http
 │   ├ Controllers
 │   │   ├ AuthController
 │   │   ├ CompanyController
 │   │   └ UserController
 │
 │   └ Middleware
 │       └ RoleMiddleware
 │
docker
 ├ nginx
 │   └ default.conf
 │
 └ php
     ├ Dockerfile
     └ start.sh
```

---

# 5. Sistema de Autenticação

A autenticação é implementada via **API**.

Fluxo básico:

1. Usuário envia email e senha
2. Sistema valida credenciais
3. Sistema retorna token de acesso
4. Token é utilizado para acessar endpoints protegidos

Exemplo de login:

```
POST /api/auth/login
```

Resposta:

```json
{
  "token": "jwt_token",
  "user": {
    "id": 1,
    "name": "Admin"
  }
}
```

---

# 6. Controle de acesso (RBAC)

O sistema utiliza um modelo simples de controle de acesso baseado em **roles**.

Estrutura:

```
roles
permissions
role_permissions
```

Cada usuário possui um nível de acesso definido por uma role.

Exemplos de roles:

```
admin
manager
user
```

Middleware de controle:

```
role:admin
role:manager
```

Exemplo de uso em rotas:

```php
Route::middleware(['role:admin'])->group(function () {
    // rotas administrativas
});
```

---

# 7. Perfil da empresa (branding do sistema)

O template possui suporte a **configuração da empresa**, permitindo que o sistema adapte aparência e informações conforme a empresa.

Tabela:

```
companies
```

Campos principais:

```
id
name
logo
primary_color
secondary_color
created_at
```

Isso permite:

* Alterar nome da empresa
* Alterar logotipo
* Alterar cores do sistema
* Aplicar branding dinâmico

---

# 8. Gerenciamento da empresa

Endpoint responsável pela configuração:

```
PUT /api/company
```

Campos atualizáveis:

```
name
logo
primary_color
secondary_color
```

Exemplo de resposta:

```json
{
  "name": "Minha Empresa",
  "logo": "/storage/logos/logo.png",
  "primary_color": "#1E40AF",
  "secondary_color": "#F59E0B"
}
```

O frontend pode consumir essas informações para alterar:

* Navbar
* Botões
* Dashboard
* Emails
* Tema visual

Isso permite **white label básico do sistema**.

---

# 9. Relacionamentos principais

Usuário pertence a uma empresa:

```
User -> Company
```

Empresa possui múltiplos usuários:

```
Company -> Users
```

Usuário possui uma role:

```
User -> Role
```

---

# 10. Seeder inicial

O sistema cria automaticamente dados iniciais para facilitar o desenvolvimento.

Roles criadas:

```
admin
manager
user
```

Empresa padrão:

```
Default Company
```

Usuário administrador inicial:

```
email: admin@admin.com
senha: 123456
```

---

# 11. Comandos úteis

Entrar no container da aplicação:

```bash
docker exec -it laravel_app bash
```

Rodar migrations:

```bash
php artisan migrate
```

Rodar seeders:

```bash
php artisan db:seed
```

Ver rotas:

```bash
php artisan route:list
```

---

# 12. Objetivo do template

Este projeto serve como **base para desenvolvimento de novos sistemas**, evitando a necessidade de configurar repetidamente:

* infraestrutura Docker
* autenticação
* controle de acesso
* configuração de empresa
* estrutura inicial do backend

A partir deste template é possível iniciar rapidamente projetos como:

* sistemas de gestão
* CRMs
* ERPs
* plataformas SaaS
* sistemas internos corporativos

---

# 13. Expansões recomendadas

Futuras melhorias que podem ser adicionadas ao template:

* Sistema de permissões mais granular
* Multi-tenant completo
* Filas com Redis
* Scheduler automático
* Documentação de API com Swagger
* Sistema de logs estruturado
* Health check endpoint

---
