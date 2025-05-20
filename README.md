# 🛒 Marketplace Connector
Este projeto tem como objetivo implementar um conector entre marketplaces e um HUB de integração, processando anúncios de forma assíncrona e escalável, conforme proposto no desafio técnico de backend.

---

## 🚀 Funcionalidades

- 📥 Importação de anúncios a partir de uma API mock de Marketplace
- 📤 Envio dos anúncios para um HUB de integração
- ⚙️ Processamento assíncrono com Laravel Queues (Redis)
- 📄 Armazenamento e rastreamento de status da importação por oferta
- ♻️ Implementação do **State Pattern** para controle de fluxo
- 🔌 Suporte a múltiplos Marketplaces com injeção dinâmica de repositórios

---

## 🧱 Tecnologias utilizadas

- [Laravel](https://laravel.com/) 11+
- Docker + docker-compose
- Redis
- MySQL
- PHP 8.2
- Clean Architecture + princípios SOLID

---

## 📁 Estrutura de Pastas

- app/
    - Events/ & Listeners/ # Eventos para disparo (ex: AnuncioImportado)
    - Interfaces/ # Interfaces dos repositórios
    - Jobs/ # Job principal para execução da importação
    - Repositories/ # Implementações por marketplace
    - Resolvers/ # Service Resolver para marketplace dinâmico
    - States/ # Estados do processo de importação
    - UseCases/ # Lógica de aplicação (ImportarAnunciosUseCase)
- mocketplace.json # Mock para testes API 

---

## 📦 Como rodar o projeto (via Docker)

### 🔧 1. Clonar o repositório
```bash
git clone https://github.com/Koonac/trayChallengeMarketplace.git
cd trayChallengeMarketplace
```

### 📄 2. Copiar o arquivo .env
O .env.example já está configurado para rodar com Docker:

```bash
cp .env.example .env
```

### 🔍 3. Verificar arquivos Docker
Antes de subir os containers, certifique-se de que:

- O arquivo docker-compose.yml está adequado ao seu sistema (Linux, macOS, Windows).

- O Dockerfile está compatível com sua versão do Docker.

- As portas definidas no docker-compose.yml (ex: 8000, 3306, 6379) não estejam em uso.

Se necessário, edite as portas no docker-compose.yml.

### 🚀 4. Subir os containers
```bash
docker-compose up --build -d
```

### 📦 5. Instalar dependências PHP e Migrations
Acesse o container da aplicação:
```bash
# Acessando container
docker exec -it app bash

# Instalando dependências
composer install

# Rodando migrations
php artisan migrate
```

---

## 📥 Como usar a API e seu funcionamento

### 📬 Endpoint principal
```http
POST /api/importarAnuncios?marketplace=mocketplace
```

### 🔗 Parâmetros da requisição
| Nome          | Tipo   | Obrigatório | Descrição                                     |
| ------------- | ------ | ----------- | --------------------------------------------- |
| `marketplace` | string | ✅ Sim       | Identificador do marketplace a ser importado. (Padrão: `mocketplace`) |
