# 🖨️ Contador de Impressão

Sistema web para monitoramento automático de contadores de impressoras em rede via **SNMP**, com armazenamento, visualização e histórico de leituras.

---

## 📸 Funcionalidades

- 🔐 Autenticação de usuários (login/logout)
- 🖨️ Cadastro e gerenciamento de impressoras
- 📡 Coleta automática de contadores via SNMP
- 📊 Cálculo automático de consumo entre leituras
- 📋 Histórico de leituras por impressora
- 🐳 Ambiente completo via Docker
- 📟 Painel de status do coletor com logs em tempo real

---

## 🛠️ Tecnologias

| Camada | Tecnologia |
|--------|-----------|
| Backend | Laravel 11 (PHP 8.2) |
| Frontend | Bootstrap 5 + Bootstrap Icons |
| Banco de dados | MySQL 8.0 |
| Servidor web | Nginx |
| Coleta SNMP | Python 3.11 + pysnmp |
| Infraestrutura | Docker + Docker Compose |

---

## 🚀 Instalação com Docker

### Pré-requisitos

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

### Passo a passo

**1. Clone o repositório**
```bash
git clone https://github.com/danielbsn1/Contador-impressao.git
cd Contador-impressao
```

**2. Configure o ambiente**
```bash
cp .env.example .env
```

Edite o `.env` com suas configurações:
```env
APP_NAME="Contador de Impressão"
APP_URL=http://localhost:8001

DB_HOST=db
DB_PORT=3306
DB_DATABASE=contador_impressao
DB_USERNAME=laravel
DB_PASSWORD=secret
```

**3. Suba os containers**
```bash
docker-compose up -d
```

**4. Gere a chave da aplicação**
```bash
docker exec laravel_app php artisan key:generate
```

**5. Rode as migrations**
```bash
docker exec laravel_app php artisan migrate
```

**6. Crie o primeiro usuário**
```bash
docker exec -it laravel_app php artisan tinker
```
```php
\App\Models\User::create([
    'name' => 'Seu Nome',
    'email' => 'seu@email.com',
    'password' => bcrypt('sua_senha'),
]);
```

**7. Acesse o sistema**

| Serviço | URL |
|---------|-----|
| Sistema | http://localhost:8001 |
| phpMyAdmin | http://localhost:8080 |

---

## 🐍 Coletor Python (SNMP)

O script coleta os contadores das impressoras via SNMP e envia para a API do Laravel.

### Configuração

```bash
pip install pysnmp==4.4.12 pyasn1==0.4.8 requests
```

### Execução manual

```bash
python script/coletor.py
```

### Via Docker

```bash
docker-compose --profile coletor up coletor
```

### OID utilizado

```
1.3.6.1.2.1.43.10.2.1.4.1.1
```

> Community SNMP padrão: `public` — certifique-se que está habilitado nas impressoras.

---

## 📡 API

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| GET | `/api/impressoras` | Lista todas as impressoras |
| GET | `/api/leituras` | Lista todas as leituras |
| POST | `/api/leitura` | Registra uma nova leitura |

### Exemplo de payload — POST `/api/leitura`

```json
{
    "impressora_id": 1,
    "contador": 15234
}
```

---

## 📁 Estrutura do Projeto

```
├── app/
│   ├── Http/Controllers/
│   │   ├── ImpressoraController.php
│   │   ├── LeituraController.php
│   │   └── Auth/
│   └── Models/
│       ├── Impressora.php
│       └── Leitura.php
├── docker/
│   └── nginx/
│       └── default.conf
├── script/
│   └── coletor.py
├── Dockerfile
├── Dockerfile.python
└── docker-compose.yml
```

---

## ⚙️ Variáveis de Ambiente

| Variável | Descrição | Padrão |
|----------|-----------|--------|
| `DB_HOST` | Host do banco (usar `db` no Docker) | `db` |
| `DB_DATABASE` | Nome do banco | `contador_impressao` |
| `DB_USERNAME` | Usuário do banco | `laravel` |
| `DB_PASSWORD` | Senha do banco | `secret` |
| `APP_URL` | URL da aplicação | `http://localhost:8001` |

---

## 🔒 Segurança

- Todas as rotas são protegidas por autenticação
- Senhas armazenadas com `bcrypt`
- Tokens CSRF em todos os formulários
- Validação de dados em todos os endpoints

---

## 🗺️ Melhorias Futuras

- [ ] Dashboard com gráficos de consumo (Chart.js)
- [ ] Relatórios mensais em PDF
- [ ] Alertas por e-mail em caso de falha na coleta
- [ ] Separação por tipo de impressão (mono/color)
- [ ] Exportação para Excel
- [ ] Agendamento automático da coleta via Laravel Scheduler

---

## 👨‍💻 Autor

Desenvolvido por **Daniel**

---

## 📄 Licença

Este projeto é livre para uso e modificação.
