# 🎫 Sacramentum - Gerenciador de Festividades - Backend (API)

Este repositório contém o backend em **Laravel / PHP** do sistema **Sacramentum: Controle de Fichas de Quermesse**.  
A API é responsável pelas regras de negócio, autenticação, armazenamento de dados, geração de relatórios e comunicação com o frontend e o app mobile.

---

## 🧭 Visão Geral

O backend fornece os seguintes serviços:

- Autenticação e autorização (login, logout, refresh)  
- CRUD de **usuários / operadores / permissões**  
- CRUD de **produtos / categorias**  
- Registro de **vendas de fichas**  
- Controle de **caixa** (abertura, fechamento, movimentações)  
- Geração de **relatórios** (por evento, data, produto)  
- Integrações diversas (exportação PDF / CSV, possíveis extensões com IA)  

Ele se comunica tanto com o **frontend web** quanto com o **aplicativo mobile**, atuando como núcleo do sistema.

---

## 🛠 Tecnologias e Dependências

- PHP 
- Laravel (versão usada no projeto)  
- Bibliotecas / pacotes extras (ex: `laravel/sanctum`)  
- Banco de dados: MySQL 
- Serviço de armazenamento S3
- Middlewares de logging, autenticação, CORS  

---

## 📦 Instalação e Configuração

1. Clone o repositório:
   ```bash
   git clone https://github.com/MaduFurini/controle-fichas-backend.git
