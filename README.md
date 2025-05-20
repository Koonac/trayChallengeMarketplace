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

- [Laravel](https://laravel.com/) 10+
- Docker + Laravel Sail
- Redis (fila)
- Guzzle (HTTP Client)
- MySQL/PostgreSQL
- PHP 8.1+
- Clean Architecture + SOLID principles

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
