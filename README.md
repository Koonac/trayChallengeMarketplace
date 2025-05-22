# 🛒 Marketplace Connector
Este projeto tem como objetivo implementar um conector entre marketplaces e um HUB de integração, processando anúncios de forma assíncrona e escalável, conforme proposto no desafio técnico de backend.

---

## 🚀 Funcionalidades

- 📥 Importação de anúncios a partir de uma API mock de Marketplace
- 📤 Envio dos anúncios para um HUB de integração
- ⚙️ Processamento assíncrono com Laravel Queues (Redis)
- 📄 Armazenamento e rastreamento de status da importação por oferta

---

## 🧱 Tecnologias utilizadas

- [Laravel](https://laravel.com/) 11+
- Docker + docker-compose
- Redis
- MySQL
- PHP 8.2
- Clean Architecture + princípios SOLID

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

### 👷 Iniciar o worker
Acesse o container da aplicação:
```bash
# Acessando container
docker exec -it app bash

# Rodando migrations
php artisan queue:work
```

### 📬 Endpoint principal
```http
POST /api/importar-anuncios
```

### ⚙️ O que acontece por trás da requisição?
Quando você faz uma requisição para o endpoint `/api/importar-anuncios`, o seguinte fluxo é executado:

1. O **Controller** recebe a requisição e despacha um job (`ProcessOfferListJob`) para a fila, responsável por listar as ofertas do marketplace.
2. Para cada oferta encontrada, o `ProcessOfferListJob` dispara o evento `OfferProcessed`, que agenda o próximo job na fila: `ProcessOfferImportJob`.
3. O `ProcessOfferImportJob` executa a lógica de importação da oferta. Ao concluir, dispara o evento `OfferImported`, que encaminha a oferta para o próximo job: `ProcessOfferSendHubJob`.
4. O `ProcessOfferSendHubJob` é responsável por enviar a oferta importada para a API do HUB, finalizando o ciclo.
5. Durante todo o processo, o status de cada oferta é persistido no banco de dados, permitindo rastreabilidade e retomada em caso de falhas. Os possíveis estados são:
    - `processing` → processamento em andamento
    - `imported` → importação concluída
    - `completed` → envio ao HUB finalizado
    - `failed` → falha em alguma etapa da importação
  



