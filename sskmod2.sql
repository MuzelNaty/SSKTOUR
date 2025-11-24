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
    site varchar(100),
    FOREIGN KEY (cidade_id) REFERENCES Cidade(id)
);

CREATE TABLE PontoTuristico (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    endereco VARCHAR(200),
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
    tipo VARCHAR(100)
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

-- Inserindo cidades
INSERT INTO Cidade (nome) VALUES 
('Barretos'),
('Campos do Jordão'),
('Guarujá'),
('Ilhabela'),
('Olímpia'),
('São Paulo'),
('Santos'),
('Ubatuba'),
('Vinhedo');

-- Inserindo hotéis
INSERT INTO Hotel (nome, endereco, cidade_id, site) VALUES 
('Thermas Park Flat', 'Rodovia Brigadeiro Faria Lima, S/N - Parque do Peão', 1, 'hosp/barretos/thermasPark.html'),
('Ibis Styles Barretos', 'Rua Luiz Durigan, 1744', 1, null),
('Castelo Nacional Inn', 'Rua Roberto Pistrak Nemirovsky, 148 - Alto Boa Vista', 2, null),
('Dan Inn Premium Campos', 'Rua Joaquim Pinto Seabra, 170 - Vila Everest', 2, null),
('Hotel Toriba', 'Avenida Ernesto Diederichsen, 2962', 2, null),
("Solar d'Izabel", 'Rua Doutor Plínio Barbosa Lima, 59', 2, null),
('Summit Suítes', 'Comendador José Schafer, 559 - Alto da Vila Inglesa', 2, null),
('Delphin Beach', 'Avenida Miguel Estéfano, 1295', 3, null),
('Doral Guarujá', 'Avenida Miguel Estéfano, 2985 - Enseada', 3, null),
('Enseada Beira Mar', 'Avenida Miguel Estéfano, 2817 - Enseada', 3, null),
('Grand Hotel', 'Alameda Mal. Floriano Peixoto, 311 - Morro do Maluf', 3, null),
('Jequitimar Guarujá Resort & SPA By Accor', 'Avenida Marjory da Silva Prado, 1100 - Praia de Pernambuco', 3, null),
('Nacional Inn', 'Rua Luís Bianconi, 159 - Jardim Asturias', 3, null),
('Santa Maria', 'Avenida Santa Maria, 140 - Enseada', 3, null),
('Ponta dos Corais', 'Rua das Samambaias, 10 - Praia de Pernambuco', 3, null),
('Canoa Caiçara', 'Avenida Cel José Vicente de Faria Lima, 994 - Bairro Água Branca', 4, null),
('Hotel Colonial', 'Avenida Brasil, 1751', 4, null),
('Ilha Flat Hotel', 'Avenida Princesa Isabel, 747 - Pereque', 4, null),
('Itapemar', 'Avenida Pedro de Paula morais, 340', 4, null),
('Kalango Boutique', 'Avenida Brasil, 1140 - Piuva', 4, null),
('Barra do Piuva Porto', 'Avenida Brasil, 1140 - Piuva', 4, null),
('Hotel Reserva', 'Avenida José Lins do Rego, 20 e 29 - Feiticeira', 4, null),
('Vista Bella Resort & SPA', 'Rua Bela Vista, 119 - Itaguassu', 4, null),
('Água Viva', 'Avenida Aurora Forti Neves, 350 - Jardim Santa Efigênia', 5, null),
('Enjoy Olímpia Park Resort', 'Avenida Aurora Forti Neves, 1030', 5, null),
('Olímpia Park Resort', 'Avenida Aurora Forti Neves, 1030 - Jardim Sta. Efigenia', 5, null),
('Pousada Parque das Águas', 'Avenida Alberto Oberg, 480 - Jardim Cizoto', 5, null),
('Pousada Família Alegria', 'Rua Jose Aparecido Santana, 146', 5, null),
('Pousada Villa Itália', 'Alameda Tiago Felício Santana, 14 - Jardim Universitário', 5, null),
('Thermas Park Resort & SPA by Hot Beach', 'Avenida Waldemar Lopes Ferraz, 53 - Centro', 5, null),
('Tiffany', 'Avenida do Folclore, 1232 - Jardim Santa Efigênia', 5, null),
('Bê Hotel', 'Rua Monte Alegre, 45 - Bairro Perdizes', 6, null),
('Cozzy Suites Paraíso Hotel', 'Rua Cubatão, 993 - Bairro Vila Mariana', 6, null),
('Hotel Dan Inn Planalto', 'Avenida Cásper Líbero, 115 - Centro', 6, null),
('Delplaza Excelsior', 'Avenida Ipiranga, 770 - Bairro República', 6, null),
('Hotel Distrito 011', 'Rua Turiassu, 1424 - Barra Funda', 6, null),
('Green Place Ibirapuera', 'Rua Dr. Diogo de Faria, 1201 - Vila Clementino', 6, null),
('H3 Hotel Paulista', 'Rua Rocha, 217 - Bela Vista', 6, null),
('Hotel Slim', 'Rua Baronesa de Bela Vista, 499 - Vila Congonhas', 6, null),
('Ibis Ibirapuera', 'Avenida Santo Amaro, 1411 - Moema', 6, null),
('Ibis Styles Hotel', 'Avenida Santo Amaro, 1411 - Vila Nova Conceição', 6, null),
('Laghetto Stilo', 'Rua Coronel Oscar Porto, 836 - Paraíso', 6, null),
('Leques Brasil Hotel', 'Rua São Joaquim, 216 - Liberdade', 6, null),
('Mercure Jardins', 'Rua Augusta, 1151 - Jardins', 6, null),
('Nacional Inn Hotel', 'Avenida Cásper Líbero, 125 - Centro', 6, null),
('Nacional Inn Jaraguá', 'Rua Martins Fontes, 71 - Centro Histórico de São Paulo', 6, null),
('Nikkey Palace Hotel', 'Rua Galvão Bueno, 425 - Liberdade', 6, null),
('Slaviero Downtown', 'Rua República, 141 - Jardins', 6, null),
('Hotel Wyndham', 'Rua Alameda Campinas, 540 - Jardim Paulista', 6, null),
('Atlântico', 'Rua Jorge Tibiriçá, 04 - Gonzaga', 7, null),
('Parque Balneário', 'Avenida Ana Costa, 555 - Gonzaga', 7, null),
('Estanconfor Vista Mar', 'Avenida Marechal Floriano Peixoto, 247 - Gonzaga', 7, null),
('Ibis Budget', 'Avenida Marechal Floriano Peixoto, 77 - Gonzaga', 7, null),
('Ibis Santos Valongo', 'Rua Alexandre Gusmão, Praca Lions Clube 420 - Gonzaga', 7, null),
('Sheraton Santos', 'Alameda Armenio Mendes, 70', 7, null),
('Aquarius Chalés', 'Rua Pintor Gômide, 257 - Enseada', 8, null),
('Casa di Maria', 'Rua Mar das Antilhas, 80 - Parque Vivamar', 8, null),
('Pousada El Shadday', 'Rua do Acesso, 263 - Toninhas', 8, null),
('Parque Atlântico', 'Rua Conceição, 185 - Centro', 8, null),
('Praia Hotel', 'Avenida Leovigildo Dias Vieira, 1336 - Itaguá', 8, null),
('Cyan Resort by Atlantica', 'Rodovia dos Bandeirantes', 9, null),
('Intercity', 'Avenida das Indústrias, 855 - Distrito Industrial Benedito Storani', 9, null),
('Vinhedo Plaza', 'Avenida Independência, 411 - Pinheirinho', 9, null);

-- Inserindo pontos turísticos
INSERT INTO PontoTuristico (nome, endereco, cidade_id) VALUES 
('Barretos Country Park', 'Rodovia Armando de Oliveira, Km 03', 1),
('Catedral do Espírito Santo', 'Pr. Francisco Barreto, 107', 1),
('Memorial do Peão', 'Av. 25 de Agosto, 178-244', 1),
('Parque Amantikir', 'R. Simplício Ribeiro de Toledo Neto, 2200', 2),
('Ducha de Prata', 'Av. Mariane Baungart, 2485', 2),
('Museu Felícia Leirner', 'Av. Dr. Luis Arrobas Martins, 1880', 2),
('Praia da Enseada', 'Avenida Dom Pedro I', 3),
('Acqua Mundo', 'Av. Miguel Estefno, 2001', 3),
('Praia Branca', 'Balsa de Bertioga', 3),
('Avenida Paulista', 'Av. Paulista, São Paulo', 1),
('Parque Ibirapuera', 'Av. Pedro Álvares Cabral, São Paulo', 1),
('Cristo Redentor', 'Parque Nacional da Tijuca, Rio de Janeiro', 2),
('Pão de Açúcar', 'Av. Pasteur, Rio de Janeiro', 2),
('Praça da Liberdade', 'Praça da Liberdade, Belo Horizonte', 3);

-- Inserindo tipos de acessibilidade
INSERT INTO Acessibilidade (tipo) VALUES 
('Rampa de acesso'),
('Elevador adaptado'),
('Banheiro acessível'),
('Piso tátil'),
('Portas adaptadas'),
('Cadeiras de rodas no local'),
('Corrimãos nas escadas'),
('Academia adaptada'),
('Restaurante adaptado'),
('Piscina acessível'),
('Estacionamento acessível'),
('Spa acessível'),
('Orientacão auditiva'),
('Animais de serviço permitidos'),
('Sinalização em braile'),
('Quarto adaptado');


-- Inserindo tipos de deficiência
INSERT INTO Deficiencia (tipo) VALUES 
('Visual'),
('Auditiva'),
('Física');

-- Relacionando hotéis e acessibilidades
INSERT INTO Hotel_Acessibilidade (hotel_id, acessibilidade_id) VALUES 
(1, 1), (1, 2), (1, 3),
(2, 1), (2, 4),
(3, 2), (3, 3), (3, 4),
(4, 1), (4, 3);

-- Relacionando hotéis e pontos turísticos
INSERT INTO Hotel_PontoTuristico (hotel_id, ponto_turistico_id) VALUES 
(1, 1), (1, 2),
(2, 1), (2, 2),
(3, 3), (3, 4),
(4, 5);

-- Relacionando hotéis e deficiências atendidas
INSERT INTO Hotel_Deficiencia (hotel_id, deficiencia_id) VALUES 
(1, 1), (1, 3),
(2, 2), (2, 3), 
(3, 1), (3, 2), (3, 3),
(4, 3), (4, 4);




SET @cidade = null;
SET @hotel = NULL;
SET @deficiencia = null;
SET @ponto_turistico = NULL;

SELECT 
    h.nome AS hotel,
    c.nome AS cidade,
    d.tipo AS deficiencia,
    p.nome AS ponto_turistico
FROM 
    Hotel h
JOIN 
    Cidade c ON h.cidade_id = c.id
LEFT JOIN 
    Hotel_Deficiencia hd ON h.id = hd.hotel_id
LEFT JOIN 
    Deficiencia d ON hd.deficiencia_id = d.id
LEFT JOIN 
    Hotel_PontoTuristico hp ON h.id = hp.hotel_id
LEFT JOIN 
    PontoTuristico p ON hp.ponto_turistico_id = p.id
WHERE 
    (@cidade IS NULL OR c.nome LIKE CONCAT('%', @cidade, '%'))
    AND (@hotel IS NULL OR h.nome LIKE CONCAT('%', @hotel, '%'))
    AND (@deficiencia IS NULL OR d.tipo LIKE CONCAT('%', @deficiencia, '%'))
    AND (@ponto_turistico IS NULL OR p.nome LIKE CONCAT('%', @ponto_turistico, '%'));



SELECT * FROM Hotel WHERE nome LIKE '%Bê Hotel%';

SELECT * FROM Hotel_Deficiencia WHERE hotel_id = 1;
SELECT * FROM Hotel_PontoTuristico WHERE hotel_id = 1;