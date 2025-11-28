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
('Ibis Styles Barretos', 'Rua Luiz Durigan, 1744', 1, 'hosp/barretos/ibisBarretos.html'),
('Castelo Nacional Inn', 'Rua Roberto Pistrak Nemirovsky, 148 - Alto Boa Vista', 2, 'hosp/camposJordao/casteloNacional.html'),
('Dan Inn Premium Campos', 'Rua Joaquim Pinto Seabra, 170 - Vila Everest', 2, 'hosp/camposJordao/danInnCampos.html'),
('Hotel Toriba', 'Avenida Ernesto Diederichsen, 2962', 2, 'hosp/camposJordao/hotelToriba.html'),
("Solar d'Izabel", 'Rua Doutor Plínio Barbosa Lima, 59', 2, 'hosp/camposJordao/solar.html'),
('Summit Suítes', 'Comendador José Schafer, 559 - Alto da Vila Inglesa', 2, 'hosp/camposJordao/summit.html'),
('Delphin Beach', 'Avenida Miguel Estéfano, 1295', 3, 'hosp/guaruja/delphin.html'),
('Doral Guarujá', 'Avenida Miguel Estéfano, 2985 - Enseada', 3, 'hosp/guaruja/doral.html'),
('Enseada Beira Mar', 'Avenida Miguel Estéfano, 2817 - Enseada', 3, 'hosp/guaruja/enseada.html'),
('Grand Hotel', 'Alameda Mal. Floriano Peixoto, 311 - Morro do Maluf', 3, 'hosp/guaruja/grand.html'),
('Jequitimar Guarujá Resort & SPA By Accor', 'Avenida Marjory da Silva Prado, 1100 - Praia de Pernambuco', 3, 'hosp/guaruja/jequitimar.html'),
('Nacional Inn', 'Rua Luís Bianconi, 159 - Jardim Asturias', 3, 'hosp/guaruja/nacionalInn.html'),
('Santa Maria', 'Avenida Santa Maria, 140 - Enseada', 3, 'hosp/guaruja/santaMaria.html'),
('Ponta dos Corais', 'Rua das Samambaias, 10 - Praia de Pernambuco', 3, 'hosp/guaruja/pontaCorais.html'),
('Canoa Caiçara', 'Avenida Cel José Vicente de Faria Lima, 994 - Bairro Água Branca', 4, 'hosp/ilhabela/canoa.html'),
('Hotel Colonial', 'Avenida Brasil, 1751', 4, 'hosp/ilhabela/colonial.html'),
('Ilha Flat Hotel', 'Avenida Princesa Isabel, 747 - Pereque', 4, 'hosp/ilhabela/flat.html'),
('Itapemar', 'Avenida Pedro de Paula morais, 340', 4, 'hosp/ilhabela/itapemar.html'),
('Kalango Boutique', 'Avenida Brasil, 1140 - Piuva', 4, 'hosp/ilhabela/kalango.html'),
('Barra do Piuva Porto', 'Avenida Brasil, 1140 - Piuva', 4, 'hosp/ilhabela/piuva.html'),
('Hotel Reserva', 'Avenida José Lins do Rego, 20 e 29 - Feiticeira', 4, 'hosp/ilhabela/reserva.html'),
('Vista Bella Resort & SPA', 'Rua Bela Vista, 119 - Itaguassu', 4, 'hosp/ilhabela/vistabela.html'),
('Água Viva', 'Avenida Aurora Forti Neves, 350 - Jardim Santa Efigênia', 5, 'hosp/olimpia/aguaViva.html'),
('Enjoy Olímpia Park Resort', 'Avenida Aurora Forti Neves, 1030', 5, 'hosp/olimpia/enjoy.html'),
('Olímpia Park Resort', 'Avenida Aurora Forti Neves, 1030 - Jardim Sta. Efigenia', 5, 'hosp/olimpia/parkResort.html'),
('Pousada Parque das Águas', 'Avenida Alberto Oberg, 480 - Jardim Cizoto', 5, 'hosp/olimpia/parqueAguas.html'),
('Pousada Família Alegria', 'Rua Jose Aparecido Santana, 146', 5, 'hosp/olimpia/pousadaFamilia.html'),
('Pousada Villa Itália', 'Alameda Tiago Felício Santana, 14 - Jardim Universitário', 5, 'hosp/olimpia/pousadaVila.html'),
('Thermas Park Resort & SPA by Hot Beach', 'Avenida Waldemar Lopes Ferraz, 53 - Centro', 5, 'hosp/olimpia/thermasPark.html'),
('Tiffany', 'Avenida do Folclore, 1232 - Jardim Santa Efigênia', 5, 'hosp/olimpia/tiffany.html'),
('Bê Hotel', 'Rua Monte Alegre, 45 - Bairro Perdizes', 6, 'hosp/saoPaulo/beHotel.html'),
('Cozzy Suites Paraíso Hotel', 'Rua Cubatão, 993 - Bairro Vila Mariana', 6, 'hosp/saoPaulo/cozzySuites.html'),
('Hotel Dan Inn Planalto', 'Avenida Cásper Líbero, 115 - Centro', 6, 'hosp/saoPaulo/danInn.html'),
('Delplaza Excelsior', 'Avenida Ipiranga, 770 - Bairro República', 6, 'hosp/saoPaulo/delplaza.html'),
('Hotel Distrito 011', 'Rua Turiassu, 1424 - Barra Funda', 6, 'hosp/saoPaulo/distrito011.html'),
('Green Place Ibirapuera', 'Rua Dr. Diogo de Faria, 1201 - Vila Clementino', 6, 'hosp/saoPaulo/greenPlace.html'),
('H3 Hotel Paulista', 'Rua Rocha, 217 - Bela Vista', 6, 'hosp/saoPaulo/H3hotel.html'),
('Hotel Slim', 'Rua Baronesa de Bela Vista, 499 - Vila Congonhas', 6, 'hosp/saoPaulo/hotelSlim.html'),
('Ibis Ibirapuera', 'Avenida Santo Amaro, 1411 - Moema', 6, 'hosp/saoPaulo/ibisIbirapuera.html'),
('Ibis Styles Hotel', 'Avenida Santo Amaro, 1411 - Vila Nova Conceição', 6, 'hosp/saoPaulo/ibisStyles.html'),
('Laghetto Stilo', 'Rua Coronel Oscar Porto, 836 - Paraíso', 6, 'hosp/saoPaulo/laghettoStilo.html'),
('Leques Brasil Hotel', 'Rua São Joaquim, 216 - Liberdade', 6, 'hosp/saoPaulo/lequesBrasil.html'),
('Mercure Jardins', 'Rua Augusta, 1151 - Jardins', 6, 'hosp/saoPaulo/mercure.html'),
('Nacional Inn Hotel', 'Avenida Cásper Líbero, 125 - Centro', 6, 'hosp/saoPaulo/nacionalInn.html'),
('Nacional Inn Jaraguá', 'Rua Martins Fontes, 71 - Centro Histórico de São Paulo', 6, 'hosp/saoPaulo/nacionalJaragua.html'),
('Nikkey Palace Hotel', 'Rua Galvão Bueno, 425 - Liberdade', 6, 'hosp/saoPaulo/nikkeyPalace.html'),
('Slaviero Downtown', 'Rua República, 141 - Jardins', 6, 'hosp/saoPaulo/slaviero.html'),
('Hotel Wyndham', 'Rua Alameda Campinas, 540 - Jardim Paulista', 6, 'hosp/saoPaulo/wyndham.html'),
('Atlântico', 'Rua Jorge Tibiriçá, 04 - Gonzaga', 7, 'hosp/santos/atlantico.html'),
('Parque Balneário', 'Avenida Ana Costa, 555 - Gonzaga', 7, 'hosp/santos/balneario.html'),
('Estanconfor Vista Mar', 'Avenida Marechal Floriano Peixoto, 247 - Gonzaga', 7, 'hosp/santos/estanconfor.html'),
('Ibis Budget', 'Avenida Marechal Floriano Peixoto, 77 - Gonzaga', 7, 'hosp/santos/ibisBudget.html'),
('Ibis Santos Valongo', 'Rua Alexandre Gusmão, Praca Lions Clube 420 - Gonzaga', 7, 'hosp/santos/ibisSantos.html'),
('Sheraton Santos', 'Alameda Armenio Mendes, 70', 7, 'hosp/santos/sheraton.html'),
('Aquarius Chalés', 'Rua Pintor Gômide, 257 - Enseada', 8, 'hosp/ubatuba/aquariusChale.html'),
('Casa di Maria', 'Rua Mar das Antilhas, 80 - Parque Vivamar', 8, 'hosp/ubatuba/casaMaria.html'),
('Pousada El Shadday', 'Rua do Acesso, 263 - Toninhas', 8, 'hosp/ubatuba/elShadday.html'),
('Parque Atlântico', 'Rua Conceição, 185 - Centro', 8, 'hosp/ubatuba/parqueAtlantico.html'),
('Praia Hotel', 'Avenida Leovigildo Dias Vieira, 1336 - Itaguá', 8, 'hosp/ubatuba/praiaHotel.html'),
('Cyan Resort by Atlantica', 'Rodovia dos Bandeirantes', 9, 'hosp/vinhedo/cyan.html'),
('Intercity', 'Avenida das Indústrias, 855 - Distrito Industrial Benedito Storani', 9, 'hosp/vinhedo/intercity.html'),
('Vinhedo Plaza', 'Avenida Independência, 411 - Pinheirinho', 9, 'hosp/vinhedo/vinhedoPlaza.html');

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

INSERT INTO Hotel_PontoTuristico (hotel_id, ponto_turistico_id) VALUES
-- ================= BARRETOS =================
(1, 1), (1, 2), (1, 3),
(2, 1), (2, 2), (2, 3),

-- ================= CAMPOS DO JORDÃO =================
(3, 4), (3, 5), (3, 6),
(4, 4), (4, 5), (4, 6),
(5, 4), (5, 5), (5, 6),
(6, 4), (6, 5), (6, 6),
(7, 4), (7, 5), (7, 6),

-- ================= GUARUJÁ =================
(8, 7), (8, 8), (8, 9),
(9, 7), (9, 8), (9, 9),
(10, 7), (10, 8), (10, 9),
(11, 7), (11, 8), (11, 9),
(12, 7), (12, 8), (12, 9),
(13, 7), (13, 8), (13, 9),
(14, 7), (14, 8), (14, 9),
(15, 7), (15, 8), (15, 9),

-- ================= ILHABELA =================
(16, 10), (16, 11), (16, 12), (16, 13), (16, 14),
(17, 10), (17, 11), (17, 12), (17, 13), (17, 14),
(18, 10), (18, 11), (18, 12), (18, 13), (18, 14),
(19, 10), (19, 11), (19, 12), (19, 13), (19, 14),
(20, 10), (20, 11), (20, 12), (20, 13), (20, 14),
(21, 10), (21, 11), (21, 12), (21, 13), (21, 14),
(22, 10), (22, 11), (22, 12), (22, 13), (22, 14),
(23, 10), (23, 11), (23, 12), (23, 13), (23, 14),

-- ================= OLÍMPIA =================
(24, 15), (24, 16), (24, 17), (24, 18), (24, 19),
(25, 15), (25, 16), (25, 17), (25, 18), (25, 19),
(26, 15), (26, 16), (26, 17), (26, 18), (26, 19),
(27, 15), (27, 16), (27, 17), (27, 18), (27, 19),
(28, 15), (28, 16), (28, 17), (28, 18), (28, 19),
(29, 15), (29, 16), (29, 17), (29, 18), (29, 19),
(30, 15), (30, 16), (30, 17), (30, 18), (30, 19),
(31, 15), (31, 16), (31, 17), (31, 18), (31, 19),

-- ================= SÃO PAULO =================
(32, 20), (32, 24),
(33, 21),
(34, 22),
(35, 23),
(36, 24),
(37, 25),
(38, 26),
(39, 27),
(40, 28),
(41, 29),
(42, 30),
(43, 31),

-- ================= UBATUBA =================
(44, 32),
(45, 33),
(46, 34),
(47, 35),
(48, 36),

-- ================= SANTOS =================
(49, 37),
(50, 38),
(51, 39),
(52, 40),

-- ================= VINHEDO =================
(53, 41), (53, 42), (53, 43),
(54, 41), (54, 42), (54, 43),
(55, 41), (55, 42), (55, 43);



-- Relacionando hotéis e deficiências atendidas (corrigido)
INSERT INTO Hotel_Deficiencia (hotel_id, deficiencia_id) VALUES
-- ================= BARRETOS =================
(1, 3),
(2, 3), (2, 1), (2, 2),

-- =========== CAMPOS DO JORDÃO ===============
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),

-- ================== GUARUJÁ =================
(8, 3), (8, 1),
(9, 3), (9, 1),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 1),
(15, 1),

-- ================== ILHABELA =================
(16, 3), (16, 2),
(17, 3),
(18, 3),
(19, 3),
(20, 3), (20, 1), (20, 2),
(21, 3), (21, 1),
(22, 3),

-- ================== OLÍMPIA ==================
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3), (28, 2),
(29, 3),
(30, 3),

-- ================= SÃO PAULO =================
(31, 3),
(32, 3), (32, 1),
(33, 3),
(34, 3),
(35, 3), (35, 1),
(36, 3),
(37, 3),
(38, 3),
(39, 3),
(40, 3), (40, 1),
(41, 3),
(42, 3),
(43, 3), (43, 1),
(44, 3), (44, 1),
(45, 3),
(46, 3), (46, 1), (46, 2),
(47, 3),
(48, 3),
(49, 3),

-- ================== SANTOS ===================
(50, 3),
(51, 3),
(52, 3),
(53, 3), (53, 1), (53, 2),
(54, 3),
(55, 3),

-- ================= UBATUBA ===================
(56, 3),
(57, 1),
(58, 3),
(59, 3),
(60, 3),

-- ================= VINHEDO ===================
(61, 3), (61, 1),
(62, 3),
(63, 3);