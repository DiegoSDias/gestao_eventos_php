# 🚀 EventManager - Documentação de Configuração

Este guia contém as instruções necessárias para configurar o ambiente de desenvolvimento, banco de dados e dependências do projeto.

---

## 🗄️ 1. Esquema do Banco de Dados (SQL)

O script abaixo cria o banco de dados e as tabelas com otimizações de integridade (`ON DELETE CASCADE`) e travas de segurança (`UNIQUE KEY`) para evitar duplicidade de inscrições.

```sql
-- Criação do Banco de Dados
CREATE DATABASE IF NOT EXISTS crud_gestao_eventos;
USE crud_gestao_eventos;

-- 1. Tabela de Usuários
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 2. Tabela de Eventos
CREATE TABLE events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    event_date DATETIME NOT NULL,
    location VARCHAR(100),
    number_registrations INT DEFAULT 0,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
);

-- 3. Tabela de Inscrições (Relacionamento N:M)
CREATE TABLE registrations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    UNIQUE KEY unique_registration (user_id, event_id) -- Trava de segurança contra duplicidade
);
```

## 🛠️ 2. Gerenciamento de Dependências
O projeto utiliza o Composer. A principal dependência para configuração de ambiente é o phpdotenv.

Instalação:
Execute o comando abaixo na raiz do projeto:

```bash
composer require vlucas/phpdotenv
```

## 🔐 3. Variáveis de Ambiente (.env)
Crie um arquivo chamado .env na raiz do projeto para armazenar suas credenciais sensíveis.

Atenção: Este arquivo NUNCA deve ser enviado para o controle de versão (Git).

```bash
# Configurações do Banco de Dados
DB_HOST=localhost
DB_NAME=crud_gestao_eventos
DB_USER=root
DB_PASS=

# Configurações Globais
URL_BASE=http://localhost/crud_php/
```
Crie também um arquivo .env.example apenas com as chaves para servir de modelo.

## 📁 4. Arquivo de Ignorados (.gitignore)
Crie um arquivo .gitignore na raiz para evitar o upload de arquivos desnecessários:

```bash
# Dependências do Composer
/vendor/

# Arquivos de Configuração Sensíveis
.env
```