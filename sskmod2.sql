create database tour;

use tour;

CREATE TABLE Cidade (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE Hotel (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    endereco VARCHAR(200),
    cidade_id INT NOT NULL,
    FOREIGN KEY (cidade_id) REFERENCES Cidade(id)
);

CREATE TABLE PontoTuristico (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    endereco VARCHAR(200)
    descricao TEXT,
    cidade_id INT NOT NULL,
    FOREIGN KEY (cidade_id) REFERENCES Cidade(id)
);

CREATE TABLE Foto (
    id INT PRIMARY KEY AUTO_INCREMENT,
    hotel_id INT NOT NULL,
    url VARCHAR(255) NOT NULL,
    descricao VARCHAR(255),
    FOREIGN KEY (hotel_id) REFERENCES Hotel(id)
);

CREATE TABLE Acessibilidade (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(100) NOT NULL
);

CREATE TABLE Deficiencia (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(100) NOT NULL
);

CREATE TABLE Hotel_Acessibilidade (
    hotel_id INT,
    acessibilidade_id INT,
    PRIMARY KEY (hotel_id, acessibilidade_id),
    FOREIGN KEY (hotel_id) REFERENCES Hotel(id),
    FOREIGN KEY (acessibilidade_id) REFERENCES Acessibilidade(id)
);

CREATE TABLE Hotel_PontoTuristico (
    hotel_id INT,
    ponto_turistico_id INT,
    PRIMARY KEY (hotel_id, ponto_turistico_id),
    FOREIGN KEY (hotel_id) REFERENCES Hotel(id),
    FOREIGN KEY (ponto_turistico_id) REFERENCES PontoTuristico(id)
);

CREATE TABLE Hotel_Deficiencia (
    hotel_id INT,
    deficiencia_id INT,
    PRIMARY KEY (hotel_id, deficiencia_id),
    FOREIGN KEY (hotel_id) REFERENCES Hotel(id),
    FOREIGN KEY (deficiencia_id) REFERENCES Deficiencia(id)
);

INSERT INTO Cidade (nome) VALUES
('São Paulo'),
('Rio de Janeiro'),
('Salvador');

INSERT INTO Hotel (nome, endereco, cidade_id) VALUES
('Hotel Estrela', 'Rua das Flores, 100', 1),      -- São Paulo
('Hotel Mar Azul', 'Avenida Atlântica, 200', 2),  -- Rio de Janeiro
('Hotel Sol Nascente', 'Praça da Bahia, 300', 3); -- Salvador

INSERT INTO Acessibilidade (tipo) VALUES
('Rampa de acesso'),
('Elevador adaptado'),
('Banheiro acessível'),
('Sinalização em braile');

INSERT INTO PontoTuristico (nome, descricao, cidade_id) VALUES
('Parque Ibirapuera', 'Parque urbano com áreas verdes e lazer', 1),  -- São Paulo
('Cristo Redentor', 'Estátua icônica no topo do Corcovado', 2),      -- Rio de Janeiro
('Pelourinho', 'Centro histórico com arquitetura colonial', 3);      -- Salvador

INSERT INTO Deficiencia (tipo) VALUES
('Auditiva'),
('Visual'),
('Física');

INSERT INTO Foto (hotel_id, url, descricao) VALUES
(1, 'https://example.com/fotos/hotel_estrela_1.jpg', 'Entrada principal do Hotel Estrela'),
(1, 'https://example.com/fotos/hotel_estrela_2.jpg', 'Lobby do Hotel Estrela'),
(2, 'https://example.com/fotos/hotel_mar_azul_1.jpg', 'Vista da praia no Hotel Mar Azul'),
(3, 'https://example.com/fotos/hotel_sol_nascente_1.jpg', 'Piscina do Hotel Sol Nascente');

INSERT INTO Hotel_Acessibilidade (hotel_id, acessibilidade_id) VALUES
(1, 1), -- Hotel Estrela tem Rampa de acesso
(1, 4), -- Hotel Estrela tem Sinalização em braile
(2, 2), -- Hotel Mar Azul tem Elevador adaptado
(3, 3); -- Hotel Sol Nascente tem Banheiro acessível

INSERT INTO Hotel_PontoTuristico (hotel_id, ponto_turistico_id) VALUES
(1, 1), -- Hotel Estrela perto do Parque Ibirapuera
(2, 2), -- Hotel Mar Azul perto do Cristo Redentor
(3, 3); -- Hotel Sol Nascente perto do Pelourinho

INSERT INTO Hotel_Deficiencia (hotel_id, deficiencia_id) VALUES
(1, 2), -- Hotel Estrela atende deficiência Visual
(2, 1), -- Hotel Mar Azul atende deficiência Auditiva
(3, 3); -- Hotel Sol Nascente atende deficiência Física



SET @cidade = NULL;           -- ou 'São Paulo'
SET @acessibilidade = NULL;   -- ou 'Rampa de acesso'
SET @ponto_turistico = NULL;  -- ou 'Cristo Redentor'
SET @deficiencia = 'Auditiva'; -- exemplo fixo para filtrar deficiência auditiva

SELECT DISTINCT
    h.id AS hotel_id,
    h.nome AS hotel_nome,
    c.nome AS cidade
FROM Hotel h
JOIN Cidade c ON h.cidade_id = c.id
LEFT JOIN Hotel_Acessibilidade ha ON h.id = ha.hotel_id
LEFT JOIN Acessibilidade a ON ha.acessibilidade_id = a.id
LEFT JOIN Hotel_PontoTuristico hpt ON h.id = hpt.hotel_id
LEFT JOIN PontoTuristico pt ON hpt.ponto_turistico_id = pt.id
LEFT JOIN Hotel_Deficiencia hd ON h.id = hd.hotel_id
LEFT JOIN Deficiencia d ON hd.deficiencia_id = d.id
WHERE
    (c.nome = COALESCE(@cidade, c.nome))
    AND (a.tipo = COALESCE(@acessibilidade, a.tipo))
    AND (pt.nome = COALESCE(@ponto_turistico, pt.nome))
    AND (d.tipo = COALESCE(@deficiencia, d.tipo))
ORDER BY h.nome;