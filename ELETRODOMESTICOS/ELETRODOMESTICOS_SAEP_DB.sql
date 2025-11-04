CREATE DATABASE ELETRODOMESTICOS_SAEP_DB;

USE ELETRODOMESTICOS_SAEP_DB;

-- =========================
-- Tabela USUARIO
-- =========================
CREATE TABLE USUARIO (
    USUARIO_ID INTEGER AUTO_INCREMENT PRIMARY KEY,
    NOME VARCHAR(255),
    EMAIL VARCHAR(255) UNIQUE,
    SENHA VARCHAR(255)
);

-- =========================
-- Tabela ELETRODOMESTICO
-- =========================
CREATE TABLE ELETRODOMESTICO (
    ELETRO_ID INTEGER AUTO_INCREMENT PRIMARY KEY,
    MARCA VARCHAR(255),
    CATEGORIA VARCHAR(255),
    FK_USUARIO_ID INTEGER,
    FORNECEDOR VARCHAR(255),
    POTENCIA VARCHAR(255),
    CONSUMO VARCHAR(255),
    GARANTIA DATE,
    PRIORIDADE_REPOSICAO VARCHAR(255),
    CONSTRAINT FK_ELETRODOMESTICO_USUARIO FOREIGN KEY (FK_USUARIO_ID)
	REFERENCES USUARIO (USUARIO_ID)
);

-- =========================
-- Tabela ESTOQUE
-- =========================
CREATE TABLE ESTOQUE (
    ESTOQUE_ID INTEGER AUTO_INCREMENT PRIMARY KEY,
    QUANTIDADE INTEGER,
    FK_ELETRO_ID INTEGER,
    CONSTRAINT FK_ESTOQUE_ELETRO FOREIGN KEY (FK_ELETRO_ID)
        REFERENCES ELETRODOMESTICO (ELETRO_ID)
        ON DELETE CASCADE
);

-- =========================
-- Tabela LOGS
-- =========================
CREATE TABLE LOGS (
    LOG_ID INTEGER AUTO_INCREMENT PRIMARY KEY,
    LOG_DESCRICAO VARCHAR(255),
    LOG_DATA_HORA DATE
);

-- =========================
-- Inserindo usuários
-- =========================
INSERT INTO USUARIO (NOME, EMAIL, SENHA)
VALUES
    ('Luan', 'luan@email.com', '123456789'),
    ('Liebert', 'liebert@email.com', '987654321'),
    ('Caua', 'caua@email.com', '24681012');

-- =========================
-- Inserindo eletrodomésticos
-- =========================
INSERT INTO ELETRODOMESTICO 
(MARCA, CATEGORIA, FK_USUARIO_ID, FORNECEDOR, POTENCIA, CONSUMO, GARANTIA, PRIORIDADE_REPOSICAO)
VALUES
('Samsung', 'Geladeira Frost Free 400L', 1, 'Eletro Distribuidora LTDA', '120W', '35 kWh/mês', '2026-11-01', 'Alta'),
('LG', 'Máquina de Lavar 11kg', 2, 'Tech House Imports', '1500W', '40 kWh/mês', '2027-03-15', 'Média'),
('Philips', 'Aspirador de Pó Sem Fio', 1, 'Doméstica Center', '600W', '20 kWh/mês', '2026-06-20', 'Baixa');

-- =========================
-- Inserindo estoque
-- =========================
INSERT INTO ESTOQUE (QUANTIDADE, FK_ELETRO_ID)
VALUES 
    (5, 1),
    (10, 2),
    (20, 3);

-- =========================
-- Consulta final
-- =========================
SELECT 
    E.ELETRO_ID, 
    E.MARCA, 
    E.CATEGORIA, 
    E.FORNECEDOR, 
    E.POTENCIA, 
    E.CONSUMO, 
    E.GARANTIA, 
    E.PRIORIDADE_REPOSICAO, 
    ES.QUANTIDADE AS ESTOQUE_QUANTIDADE, 
    U.NOME, 
    U.EMAIL
FROM ELETRODOMESTICO E
JOIN USUARIO U ON E.FK_USUARIO_ID = U.USUARIO_ID
LEFT JOIN ESTOQUE ES ON E.ELETRO_ID = ES.FK_ELETRO_ID
ORDER BY E.MARCA;