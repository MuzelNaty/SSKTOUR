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
    endereco VARCHAR(200),
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
('Barretos'),
('Campos do Jordão'),
('Guarujá'),
('Ilhabela'),
('Olímpia'),
('Santos'),
('São Paulo'),
('Ubatuba'),
('Vinhedo');

INSERT INTO Hotel (nome, endereco, cidade_id) VALUES
('Ibis Styles Barretos', 'Rua Luiz Durigan, 1744', 1),                  -- Barretos
('Castelo Nacional Inn', 'Rua Roberto Pistrak Nemirovsky, 148', 2),     -- Campos do Jordão
('Delphin Beach', 'Avenida Miguel Estéfano, 1295', 3),                  -- Guarujá
('Canoa Caiçara', 'Avenida Cel José Vicente de Faria Lima, 994', 4),    -- Ilhabela
('Água Viva', 'Avenida Aurora Forti Neves, 350', 5),                    -- Olímpia
('Atlântico', 'Rua Jorge Tibiriçá, 04', 6),                             -- Santos
('Bê Hotel', 'Rua Monte Alegre, 45', 7),                                -- São Paulo
('Aquarius Chalés', 'Rua Pintor Gômide, 257', 8),                       -- Ubatuba
('Cyan Resort', 'Rodovia dos Bandeirantes', 9);                         -- Vinhedo

INSERT INTO Acessibilidade (tipo) VALUES
('Rampa de acesso'),
('Elevador adaptado'),
('Banheiro acessível'),
('Sinalização em braile');

INSERT INTO PontoTuristico (nome, endereco, descricao, cidade_id) VALUES
('Barretos Country Park', 'Rodovia Brigadeiro Faria Lima', 'O Barretos Country Park é um complexo turístico localizado na cidade de Barretos, no interior do estado de São Paulo, conhecido por sua temática sertaneja e estrutura voltada ao turismo familiar.', 1),                                       -- Barretos
('Parque Amantikir', 'Rua Simplício Ribeiro de Toledo Neto, 2200', 'O Amantikir Garden, localizado em Campos do Jordão, São Paulo, é um dos mais belos e bem-cuidados jardins do Brasil, atraindo visitantes de todas as idades com seu projeto paisagístico inspirado em jardins do mundo inteiro.', 2),   -- Campos do Jordão
('Acqua Mundo', 'Avenida Miguel Stéfano, 2001', 'O Acqua Mundo, localizado no Guarujá, é o maior aquário da América do Sul, dedicado à preservação e educação ambiental voltada para a vida marinha.', 3),                                                                                                  -- Guarujá
('Baía de Castelhanos', 'Estrada Parque de Castelhanos, s/n', 'A Baía de Castelhanos, localizada na Ilha Bela, litoral norte do estado de São Paulo, é um dos destinos mais emblemáticos e preservados da região.', 4),                                                                                     -- Ilhabela
('Hot Beach', 'Rua Edson Jesus de Abreu, 606, 350', 'O Hot Beach Olímpia é um dos principais complexos de lazer do interior paulista, localizado na cidade de Olímpia, São Paulo.', 5),                                                                                                                     -- Olímpia
('Aquário Municipal', 'Praça Vereador Luiz La Scala, s/n', 'O Aquário Municipal de Santos, inaugurado em 2 de julho de 1945, é o mais antigo do Brasil e um dos pontos turísticos mais visitados da cidade.', 6),                                                                                           -- Santos
('Allianz Parque', 'Avenida Francisco Matarazzo, 1705', 'O Allianz Parque, também conhecido como Arena Palmeiras, é um dos estádios mais modernos e versáteis da América Latina, localizado na zona oeste de São Paulo, no bairro da Água Branca.', 7),                                                     -- São Paulo
('Praia Domingas', 'Rua Praia Domingas Dias, s/n', 'A Praia Domingas Dias é um dos tesouros escondidos de Ubatuba, no litoral norte de São Paulo.', 8),                                                                                                                                                     -- Ubatuba
('Adega Família Ferragut', 'Avenida Rosa Zanetti Ferragut, 449', 'A Adega Família Ferragut é uma das mais tradicionais de Vinhedo, preservando a história da imigração italiana e a cultura do vinho na região.', 9);                                                                                       -- Vinhedo

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