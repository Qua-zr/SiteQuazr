Banco:

CREATE DATABASE IF NOT EXISTS quazr_db;
USE quazr_db;

-- Tabela de usuários administradores
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela da equipe
CREATE TABLE IF NOT EXISTS equipe (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cargo VARCHAR(100) NOT NULL,
    descricao TEXT,
    idioma VARCHAR(5) DEFAULT 'pt',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de serviços
CREATE TABLE IF NOT EXISTS servicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    icone VARCHAR(50),
    idioma VARCHAR(5) DEFAULT 'pt',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de localização
CREATE TABLE IF NOT EXISTS localizacao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    endereco VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(100),
    horario_funcionamento VARCHAR(100),
    idioma VARCHAR(5) DEFAULT 'pt',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de informações de contato
CREATE TABLE IF NOT EXISTS contato (
    id INT AUTO_INCREMENT PRIMARY KEY,
    telefone VARCHAR(20),
    email VARCHAR(100),
    horario_funcionamento VARCHAR(100),
    idioma VARCHAR(5) DEFAULT 'pt',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO usuarios (usuario, senha, nome) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador');

INSERT INTO equipe (nome, cargo, descricao, idioma) VALUES
('Ana Bárbara Camero', 'Gestão de projetos', 'Teste', 'pt'),
('Nicole Smolii', 'Adminitativo', 'Teste', 'pt'),
('Kemilly Moreira', 'Publicidade e propaganda', 'Teste', 'pt'),
('Orlando Talasso', 'T.I.', 'Teste', 'pt');

INSERT INTO servicos (titulo, descricao, icone, idioma) VALUES
('Desenvolvimento Web', 'Teste', 'fas fa-laptop-code', 'pt'),
('Consultoria de Redes', 'Teste', 'fas fa-mobile-alt', 'pt'),
('Consultoria', 'Teste', 'fas fa-chart-line', 'pt'),
('Suporte Técnico', 'Teste', 'fas fa-headset', 'pt');

INSERT INTO localizacao (endereco, telefone, email, horario_funcionamento, idioma) VALUES
('Av. Brasil, 1200 - Americana, SP', '(19) 99999-9999', 'adm.quazr@gmail.com', 'Segunda a Sexta, 9h às 18h', 'pt');

INSERT INTO contato (telefone, email, horario_funcionamento, idioma) VALUES
('(19) 99999-9999', 'adm.quazr@gmail.com', 'Segunda a Sexta, 9h às 18h', 'pt');
