DROP TABLE Resztvesz;
DROP TABLE Tart;
DROP TABLE Vizsgazik;
DROP TABLE Vizsgaztat;
DROP TABLE Hallgato;
DROP TABLE Oktato;
DROP TABLE Adminisztrator;
DROP TABLE Uzenet;
DROP TABLE Kurzus;
DROP TABLE Targy;
DROP TABLE Vizsga;
DROP TABLE Terem;
DROP TABLE Szak;
DROP TABLE Felhasznalo;


-- Felhasznalo tabla
CREATE TABLE Felhasznalo (
  eha_kod VARCHAR2(20) PRIMARY KEY NOT NULL,
  vezetek VARCHAR2(100) NOT NULL,
  keresztnev VARCHAR2(100) NOT NULL,
  email VARCHAR2(100) NOT NULL,
  jelszo VARCHAR2(50) NOT NULL
 
);

-- Hallgato tabla
CREATE TABLE Hallgato (
  eha_kod VARCHAR2(20) PRIMARY KEY NOT NULL,
  atlag NUMBER(3, 2),
  FOREIGN KEY (eha_kod) REFERENCES Felhasznalo (eha_kod) ON DELETE CASCADE
);

-- Oktato tabla
CREATE TABLE Oktato (
  eha_kod VARCHAR2(20) PRIMARY KEY NOT NULL,
  beosztas VARCHAR2(50) NOT NULL,
  FOREIGN KEY (eha_kod) REFERENCES Felhasznalo (eha_kod) ON DELETE CASCADE
);


-- Adminisztrator tabla
CREATE TABLE Adminisztrator (
  eha_kod VARCHAR2(20) PRIMARY KEY NOT NULL,
  FOREIGN KEY (eha_kod) REFERENCES Felhasznalo (eha_kod) ON DELETE CASCADE
);

-- Szak tabla
CREATE TABLE Szak (
  szakid NUMBER(5) NOT NULL,
  szaknev VARCHAR2(50) NOT NULL,
  PRIMARY KEY (szakid)
);

-- uzenet tabla
CREATE TABLE Uzenet (
  eha_kod VARCHAR2(20) NOT NULL,
  tartalom VARCHAR2(4000) NOT NULL,
  datum DATE NOT NULL,
  FOREIGN KEY (eha_kod) REFERENCES Felhasznalo (eha_kod) ON DELETE CASCADE,
  PRIMARY KEY (eha_kod, datum)
);

-- Targy tabla
CREATE TABLE Targy (
  targy_kod VARCHAR2(20) PRIMARY KEY NOT NULL,
  nev VARCHAR2(100) NOT NULL,
  ajanlott_felev NUMBER(2) NOT NULL,
  ora_szam NUMBER(2) NOT NULL,
  szakid NUMBER(5) NOT NULL,
  FOREIGN KEY (szakid) REFERENCES Szak (szakid) ON DELETE CASCADE
);

-- Terem tabla
CREATE TABLE Terem (
  teremnev VARCHAR2(50) PRIMARY KEY NOT NULL,
  gepes NUMBER(1) NOT NULL,
  fero_hely NUMBER(3) NOT NULL
);

-- Kurzus tabla
CREATE TABLE Kurzus (
  kod VARCHAR2(20) PRIMARY KEY NOT NULL,
  nev VARCHAR2(100) NOT NULL,
  kredit NUMBER(2) NOT NULL,
  oraszam NUMBER(11) NOT NULL,
  nap VARCHAR2(30) NOT NULL,
  kezdet DATE NOT NULL,
  veg DATE NOT NULL,
  teremnev VARCHAR2(30) NOT NULL,
  targy_kod VARCHAR2(20)  NOT NULL,
  FOREIGN KEY (targy_kod) REFERENCES Targy (targy_kod) ON DELETE CASCADE,
  FOREIGN KEY (teremnev) REFERENCES Terem (teremnev) ON DELETE CASCADE
);

-- Vizsga tabla
CREATE TABLE Vizsga (
  azonosito VARCHAR2(20) PRIMARY KEY NOT NULL,
  tipus VARCHAR2(50) NOT NULL,
  kezdet TIMESTAMP NOT NULL,
  veg TIMESTAMP NOT NULL,
  teremnev VARCHAR2(100) NOT NULL,
  letszam NUMBER(3) NOT NULL,
  FOREIGN KEY (teremnev) REFERENCES Terem (teremnev) ON DELETE CASCADE
);

-- Resztvesz table
CREATE TABLE Resztvesz (
    hallgato_eha_kod VARCHAR2(10) REFERENCES Hallgato(eha_kod) ON DELETE CASCADE,
    kurzus_kod VARCHAR2(5) REFERENCES Kurzus(kod) ON DELETE CASCADE,
    erdemjegy NUMBER(1,0),
    PRIMARY KEY (hallgato_eha_kod, kurzus_kod)
);

-- Tart table
CREATE TABLE Tart (
    oktato_EHA_kod VARCHAR2(6) NOT NULL,
    kurzus_kod VARCHAR2(4) NOT NULL,
    FOREIGN KEY (oktato_EHA_kod) REFERENCES Oktato (eha_kod) ON DELETE CASCADE,
    FOREIGN KEY (kurzus_kod) REFERENCES Kurzus (kod) ON DELETE CASCADE,
    PRIMARY KEY (oktato_EHA_kod, kurzus_kod)
);

-- Vizsgazik table
CREATE TABLE Vizsgazik (
  azonosito VARCHAR2(10) NOT NULL,
  eha_kod VARCHAR2(10) NOT NULL,
  erdemjegy INT NOT NULL,
  PRIMARY KEY (azonosito, eha_kod),
  FOREIGN KEY (eha_kod) REFERENCES Hallgato(eha_kod) ON DELETE CASCADE,
  FOREIGN KEY (azonosito) REFERENCES Vizsga(azonosito) ON DELETE CASCADE
);

-- Vizsgaztat table
CREATE TABLE Vizsgaztat (
  azonosito VARCHAR2(10) NOT NULL,
  eha_kod VARCHAR2(10) NOT NULL,
  PRIMARY KEY (azonosito, eha_kod),
  FOREIGN KEY (eha_kod) REFERENCES Oktato(eha_kod) ON DELETE CASCADE,
  FOREIGN KEY (azonosito) REFERENCES Vizsga(azonosito) ON DELETE CASCADE
);


-- felhasznalo 

INSERT INTO Felhasznalo VALUES ('AJZX6D', 'Rencenji', 'Denes', 'email037@gmail.com', '6273983abd274bc510f0f0c2939ed94e');
INSERT INTO Felhasznalo VALUES ('B0A3OI', 'Rac', 'akos', 'email035@gmail.com', '7352aed43855bd10ce696fc03212dd5e');
INSERT INTO Felhasznalo VALUES ('B6GQEW', 'Beke', 'Norbert', 'email02@gmail.com', 'd130e7eb3528b837e070ab82c822dd36');
INSERT INTO Felhasznalo VALUES ('C1K4ZB', 'Toth', 'Andras', 'email045@gmail.com', '0b60d94828b5f4b7e472259dc33795d1');
INSERT INTO Felhasznalo VALUES ('C54MSQ', 'Putz', 'Koppany', 'email034@gmail.com', '5641b0c88123a610a7a0c52f0d5df62b');
INSERT INTO Felhasznalo VALUES ('CFEKVK', 'Szanto', 'Dominik', 'email042@gmail.com', '1166983415b1a9f30b67b6e79d71102e');
INSERT INTO Felhasznalo VALUES ('CMRHX8', 'Garamvolgyi', 'Soma', 'email014@gmail.com', '0d11790deaf135d520ac7ddc92ff50af');
INSERT INTO Felhasznalo VALUES ('CXGGSG', 'Motyan', 'Roland', 'email028@gmail.com', '74bdc08e9cea131afdfc517c4edd6b26');
INSERT INTO Felhasznalo VALUES ('CXPIH4', 'Bors', 'Matyas', 'email04@gmail.com', 'c80ee12b9dc86c3461c05b9da3370014');
INSERT INTO Felhasznalo VALUES ('DNVP2H', 'Gyulai-Nagy', 'Tamas', 'email017@gmail.com', '08064f9b6095f4c334c5c59ae6b75487');
INSERT INTO Felhasznalo VALUES ('EG00FK', 'Garab', 'Dorian', 'email013@gmail.com', '9ac0eea8e0f28794ef0bd6a64d7aad7a');
INSERT INTO Felhasznalo VALUES ('EL9JKS', 'Vass', 'Levente', 'email051@gmail.com', '7b0c699f9764bd6c4f70af4b529e44d6');
INSERT INTO Felhasznalo VALUES ('F79NO8', 'Dinya', 'David', 'email09@gmail.com', '2610dac4a0df05800d20e98908c49b2d');
INSERT INTO Felhasznalo VALUES ('FDE2ZK', 'Horvath', 'arpad', 'email019@gmail.com', 'cbf58602cf9e1149e7dbe4ad2898daf8');
INSERT INTO Felhasznalo VALUES ('FM0LW6', 'Dome', 'Viktor', 'email010@gmail.com', '895bfb283030b71fa6a2ab2e673f5072');
INSERT INTO Felhasznalo VALUES ('FT14WX', 'Hegyes', 'Rajmond', 'email018@gmail.com', 'e09b4775e30ea49335e534374a57d40e');
INSERT INTO Felhasznalo VALUES ('FXLP42', 'Peter', 'Gergely', 'email033@gmail.com', '0f7446386fda2f47c55beb939c8ccefb');
INSERT INTO Felhasznalo VALUES ('GZA4YX', 'Green', 'Greta', 'email015@gmail.com', 'df96564b667a313af128f8a4f9a74ed3');
INSERT INTO Felhasznalo VALUES ('HCBCOV', 'Nagygeci', 'Noemi', 'email029@gmail.com', '8cc5a81a716ab26cb93e670aed02e3c3');
INSERT INTO Felhasznalo VALUES ('I0GGSY', 'Sulaiman', 'Zakiyya', 'email041@gmail.com', 'bb6fe5837f90d04b7811a41b1c713aa9');
INSERT INTO Felhasznalo VALUES ('I2U52Y', 'Boza', 'Kitti', 'email05@gmail.com', '82a2eee089a357d8e60d2a2f52a3b6da');
INSERT INTO Felhasznalo VALUES ('IBRP6D', 'Kromek', 'Balint', 'email024@gmail.com', 'bc021260bfeb99ecdb72d4d29b6d6bfb');
INSERT INTO Felhasznalo VALUES ('IEK09S', 'Nyari', 'Emese', 'email031@gmail.com', 'e4b25b27980871b60a7b17483bfb8c19');
INSERT INTO Felhasznalo VALUES ('IWZCI8', 'Nahimi', 'Hanga', 'email030@gmail.com', '0ce07fe5b29d50f1304803c36491bdfc');
INSERT INTO Felhasznalo VALUES ('JOESES', 'Toth', 'Daniel', 'email053@gmail.com', 'd6eb63c20b3b2d5d88df0d49df8f185a');
INSERT INTO Felhasznalo VALUES ('KB24FJ', 'Sari', 'Balint', 'email039@gmail.com', '61d69bf89ff73a1e11c05026aae64f14');
INSERT INTO Felhasznalo VALUES ('MHE82U', 'Mester', 'Daniel', 'email027@gmail.com', 'ee574d94dd4660ffdaecd93d4806d26b');
INSERT INTO Felhasznalo VALUES ('MI2WS5', 'Kovacs', 'David', 'email022@gmail.com', '523e9db2aa67edc67231e997919ba1bd');
INSERT INTO Felhasznalo VALUES ('OB6T8E', 'Janki', 'Zoltan', 'email054@gmail.com', '2a0878c7f811ec8e3f8fd80a5a39ee88');
INSERT INTO Felhasznalo VALUES ('OMK2OY', 'Denes', 'Martin', 'email08@gmail.com', '56c6af928dab7c9dc2148e79e4b9eb82');
INSERT INTO Felhasznalo VALUES ('OO2BYO', 'Mate', 'Istvan', 'email025@gmail.com', 'fa7796feb50ccbd58d62ecd6b426bc82');
INSERT INTO Felhasznalo VALUES ('OTJB6G', 'Weinhardt', 'Bence', 'email050@gmail.com', 'a59926775ec3615183236ec28fd6d5d8');
INSERT INTO Felhasznalo VALUES ('PBJ3HT', 'Fullajtar', 'Martin', 'email012@gmail.com', '651befabf4da951c9ab4a8c32db2ccfd');
INSERT INTO Felhasznalo VALUES ('PLMWRJ', 'Balassa', 'Balint', 'email00@gmail.com', '120d6d8763c8100ff55b6de04b56e0e8');
INSERT INTO Felhasznalo VALUES ('Q65IYT', 'Savanya', 'Zsolt', 'email040@gmail.com', '2ab929add042f74976f8bf9e0d1e29bd');
INSERT INTO Felhasznalo VALUES ('QRSPV6', 'Varga', 'Gergo', 'email047@gmail.com', '8ec0dd1dbb19ab8c4683bb9acf7d7d68');
INSERT INTO Felhasznalo VALUES ('R86VM0', 'Balint', 'Mate', 'email01@gmail.com', 'dba272b5e2056c2e56fc52af69e5fce6');
INSERT INTO Felhasznalo VALUES ('RJCXM4', 'Matos', 'Tamas', 'email026@gmail.com', '3976736cf133ae0a42636dc7d4c25adf');
INSERT INTO Felhasznalo VALUES ('S9QWNI', 'Abt', 'David', 'email052@gmail.com', '358befb3edc5e3ac3d73849b8ab78838');
INSERT INTO Felhasznalo VALUES ('SCZPWX', 'Szrnka', 'Szabolcs', 'email044@gmail.com', '374d3a65189d96eb4c96774ba501fcd4');
INSERT INTO Felhasznalo VALUES ('SLWLGS', 'Kiss', 'Koppany', 'email020@gmail.com', 'd19a3eebf1a64fc2b85c8f27dcb40530');
INSERT INTO Felhasznalo VALUES ('TE3NUE', 'Vas', 'Benedek', 'email048@gmail.com', '0c1aa14c23c1f3efe08e321481b1f6d8');
INSERT INTO Felhasznalo VALUES ('TJ7I4M', 'Szarka', 'Gabor', 'email043@gmail.com', 'f75999b0b640814bdf29816042f9c046');
INSERT INTO Felhasznalo VALUES ('TO2DD6', 'Deli', 'Zoltan', 'email07@gmail.com', '56934f50d1d14b649b37b3ea324ba6c8');
INSERT INTO Felhasznalo VALUES ('UZOLLA', 'Radnai', 'Petra', 'email036@gmail.com', 'ff9e9ec31b764262280dbfd6aa21a5d7');
INSERT INTO Felhasznalo VALUES ('V4PUDX', 'Urban', 'adam', 'email046@gmail.com', '76de20377d33447690d4ac565218f435');
INSERT INTO Felhasznalo VALUES ('VUD6X0', 'Csavas', 'Levente', 'email06@gmail.com', 'f1d3d8080306f64df33e19837188b929');
INSERT INTO Felhasznalo VALUES ('W1EY2O', 'Ver', 'Csaba', 'email049@gmail.com', '66628e98650213590ecfe75af37bf60e');
INSERT INTO Felhasznalo VALUES ('WKXEGB', 'Berta', 'Marcell', 'email03@gmail.com', 'a561c1c692b499f917af6a7a429a6832');
INSERT INTO Felhasznalo VALUES ('WVCK8I', 'Patkos', 'Tekla', 'email032@gmail.com', '5db58a9309f543d70bd257d2b9f34811');
INSERT INTO Felhasznalo VALUES ('X88V3R', 'Konyves', 'Liliana', 'email023@gmail.com', '89db114ccfe320efd2f304b07786afeb');
INSERT INTO Felhasznalo VALUES ('XE7TAP', 'Felfoldi', 'Mate', 'email011@gmail.com', 'deb72940ddcc0a621adba549f6b6122f');
INSERT INTO Felhasznalo VALUES ('XFJGDH', 'Santa', 'Vivien', 'email038@gmail.com', '004577c1eb2a34b88b31ecefea57dc69');
INSERT INTO Felhasznalo VALUES ('Z3AQXJ', 'Kompadith', 'Santisouk', 'email021@gmail.com', 'bcc7894545dd14267c11f5afe5534868');
INSERT INTO Felhasznalo VALUES ('ZZO229', 'Grujan', 'Bendeguz', 'email016@gmail.com', '5e7e91f87cd964ff1da380632d7b78cb');


-- hallgato

INSERT INTO Hallgato VALUES ('AJZX6D', 4.38);
INSERT INTO Hallgato VALUES ('B0A3OI', 1.77);
INSERT INTO Hallgato VALUES ('B6GQEW', 2.62);
INSERT INTO Hallgato VALUES ('C1K4ZB', 3.24);
INSERT INTO Hallgato VALUES ('C54MSQ', 1.56);
INSERT INTO Hallgato VALUES ('CFEKVK', 2.14);
INSERT INTO Hallgato VALUES ('CMRHX8', 1.92);
INSERT INTO Hallgato VALUES ('CXGGSG', 2.13);
INSERT INTO Hallgato VALUES ('CXPIH4', 1.48);
INSERT INTO Hallgato VALUES ('DNVP2H', 3.41);
INSERT INTO Hallgato VALUES ('EG00FK', 2.33);
INSERT INTO Hallgato VALUES ('F79NO8', 4.36);
INSERT INTO Hallgato VALUES ('FDE2ZK', 3.05);
INSERT INTO Hallgato VALUES ('FM0LW6', 4.05);
INSERT INTO Hallgato VALUES ('FT14WX', 4.51);
INSERT INTO Hallgato VALUES ('FXLP42', 2.64);
INSERT INTO Hallgato VALUES ('GZA4YX', 3.41);
INSERT INTO Hallgato VALUES ('HCBCOV', 4.36);
INSERT INTO Hallgato VALUES ('I0GGSY', 4.77);
INSERT INTO Hallgato VALUES ('I2U52Y', 1.26);
INSERT INTO Hallgato VALUES ('IBRP6D', 3.98);
INSERT INTO Hallgato VALUES ('IEK09S', 1.43);
INSERT INTO Hallgato VALUES ('IWZCI8', 1.85);
INSERT INTO Hallgato VALUES ('KB24FJ', 2.54);
INSERT INTO Hallgato VALUES ('MHE82U', 4.15);
INSERT INTO Hallgato VALUES ('MI2WS5', 3.85);
INSERT INTO Hallgato VALUES ('OMK2OY', 3.14);
INSERT INTO Hallgato VALUES ('OO2BYO', 4.11);
INSERT INTO Hallgato VALUES ('OTJB6G', 1.78);
INSERT INTO Hallgato VALUES ('PBJ3HT', 4.21);
INSERT INTO Hallgato VALUES ('PLMWRJ', 2.05);
INSERT INTO Hallgato VALUES ('Q65IYT', 1.64);
INSERT INTO Hallgato VALUES ('QRSPV6', 2.63);
INSERT INTO Hallgato VALUES ('R86VM0', 3.89);
INSERT INTO Hallgato VALUES ('RJCXM4', 2.14);
INSERT INTO Hallgato VALUES ('S9QWNI', 1.58);
INSERT INTO Hallgato VALUES ('SCZPWX', 2.67);
INSERT INTO Hallgato VALUES ('SLWLGS', 4.46);
INSERT INTO Hallgato VALUES ('TE3NUE', 1.84);
INSERT INTO Hallgato VALUES ('TJ7I4M', 3.21);
INSERT INTO Hallgato VALUES ('TO2DD6', 1.92);
INSERT INTO Hallgato VALUES ('UZOLLA', 4.32);
INSERT INTO Hallgato VALUES ('V4PUDX', 3.13);
INSERT INTO Hallgato VALUES ('VUD6X0', 4.44);
INSERT INTO Hallgato VALUES ('W1EY2O', 3.43);
INSERT INTO Hallgato VALUES ('WKXEGB', 2.88);
INSERT INTO Hallgato VALUES ('WVCK8I', 4.12);
INSERT INTO Hallgato VALUES ('X88V3R', 4.87);
INSERT INTO Hallgato VALUES ('XE7TAP', 4.32);
INSERT INTO Hallgato VALUES ('XFJGDH', 3.89);
INSERT INTO Hallgato VALUES ('Z3AQXJ', 4.71);
INSERT INTO Hallgato VALUES ('ZZO229', 4.45);


-- OKTATOK

INSERT INTO Oktato VALUES ('B0A3OI', 'oktato');
INSERT INTO Oktato VALUES ('EL9JKS', 'demo');
INSERT INTO Oktato VALUES ('JOESES', 'demo');
INSERT INTO Oktato VALUES ('OB6T8E', 'gyakorlatvezeto');
INSERT INTO Oktato VALUES ('S9QWNI', 'demo');

--ADMINISZTRATOR

INSERT INTO Adminisztrator VALUES('AJZX6D');
INSERT INTO Adminisztrator VALUES('CMRHX8');
INSERT INTO Adminisztrator VALUES('EL9JKS');

-- SZAK

INSERT INTO Szak VALUES(1, 'Programtervezo Informatikus');
INSERT INTO Szak VALUES(2, 'Jogasz');
INSERT INTO Szak VALUES(3, 'Marketing');
INSERT INTO Szak VALUES(4, 'Fogaszat');
INSERT INTO Szak VALUES(5, 'Orvostudomany');
INSERT INTO Szak VALUES(6, 'Muszaki Menedzser');
INSERT INTO Szak VALUES(7, 'Gazdasaginformatikus');
INSERT INTO Szak VALUES(8, 'Pszichologus');
INSERT INTO Szak VALUES(9, 'Media es Kommunikacio');
INSERT INTO Szak VALUES(10, 'Kozgazdasz');
INSERT INTO Szak VALUES(11, 'Muveszettortenesz');
INSERT INTO Szak VALUES(12, 'Biologus');
INSERT INTO Szak VALUES(13, 'Informatikus');
INSERT INTO Szak VALUES(14, 'Fizikus');
INSERT INTO Szak VALUES(15, 'Tortenesz');
INSERT INTO Szak VALUES(16, 'Szociologus');
INSERT INTO Szak VALUES(17, 'allatorvos');
INSERT INTO Szak VALUES(18, 'Grafikus');
INSERT INTO Szak VALUES(19, 'Turizmus');
INSERT INTO Szak VALUES(20, 'Villamosmernok');
INSERT INTO Szak VALUES(21, 'Kozlekedesmernok');
INSERT INTO Szak VALUES(22, 'Gepeszmernok');
INSERT INTO Szak VALUES(23, 'epiteszmernok');
INSERT INTO Szak VALUES(24, 'Muvesz');
INSERT INTO Szak VALUES(25, 'Szoftvertervezo');
INSERT INTO Szak VALUES(26, 'Matematikus');
INSERT INTO Szak VALUES(27, 'Kemikus');
INSERT INTO Szak VALUES(28, 'Kornyezetvedelmi Mernok');
INSERT INTO Szak VALUES(29, 'Geologus');
INSERT INTO Szak VALUES(30, 'Penzugy');



-- UZENET

INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('AJZX6D', 'Szia! Holnap van az eloadas, ne felejtsd el.', TO_DATE('2023-03-10 09:00:00', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('DNVP2H', 'Mikor tudnank talalkozni, hogy megbeszeljuk az orarendunket?', TO_DATE('2022-03-24 13:30:45', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('QRSPV6', 'Rendben, hol es mikor talalkozzunk?', TO_DATE('2022-03-25 16:20:10', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('WKXEGB', 'Nagyon hasznos volt az eloadas, koszonjuk!', TO_DATE('2022-03-23 09:15:30', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('CXPIH4', 'Sziasztok! Van valakinek valami jo programtervezesi konyvajanlata?', TO_DATE('2022-03-22 11:40:55', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('QRSPV6', 'Jo napot kivanok! Az eloadasokra meg mindig online is lehet csatlakozni?', TO_DATE('2022-03-21 14:25:20', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('F79NO8', 'Igen, itt a link az eloadashoz: https://zoom.us/123456', TO_DATE('2022-03-21 15:35:40', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('QRSPV6', 'Koszonom szepen!', TO_DATE('2022-03-22 08:55:15', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('GZA4YX', 'Milyen temat fogunk holnap targyalni?', TO_DATE('2022-03-23 10:10:25', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('DNVP2H', 'A programozasi alapokat fogjuk feldolgozni.', TO_DATE('2022-03-24 13:55:50', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('GZA4YX', 'Koszonom, mar talaltam a tema reszleteit a honlapon!', TO_DATE('2022-03-25 10:30:15', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('IEK09S', 'Sziasztok! A Java tanfolyamra mar lehet jelentkezni?', TO_DATE('2022-03-26 12:40:30', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('I2U52Y', 'Igen, a honlapon mar elerhetoek az informaciok.', TO_DATE('2022-03-26 10:05:13', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('IEK09S', 'Rendben, utananezek. Koszonom szepen!', TO_DATE('2022-03-24 13:25:42', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('TE3NUE', 'Koszonom a valaszt, ertem.', TO_DATE('2022-03-25 17:30:59', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('TE3NUE', 'Sajnos nem tudok jonni az eloadasra, koszonom a lehetoseget.', TO_DATE('2022-03-22 08:10:21', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('IBRP6D', 'Kerlek jelezd, ha szukseged lenne tovabbi informaciokra. Koszonom.', TO_DATE('2022-03-20 14:37:49', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('TE3NUE', 'Nagyon szepen koszonom a segitseget, mar ertem a feladatot.', TO_DATE('2022-03-23 19:45:32', 'YYYY-MM-DD HH24:MI:SS'));
INSERT INTO Uzenet (eha_kod, tartalom, datum) VALUES ('OB6T8E', 'Kerem a tavoktatasi lehetoseget, mivel nem tudok szemelyesen reszt venni az orakon.', TO_DATE('2022-03-21 11:55:17', 'YYYY-MM-DD HH24:MI:SS'));

--TARGY

INSERT INTO Targy VALUES ('MT101E', 'Matematikai Analizis', 1, 4, 1);
INSERT INTO Targy VALUES ('PT102E', 'Programozasi Technikak', 1, 4, 1);
INSERT INTO Targy VALUES ('IT101E', 'Informaciotechnologiai Alapok', 1, 4, 1);
INSERT INTO Targy VALUES ('AD101E', 'Adatbazis-kezeles', 2, 4, 1);
INSERT INTO Targy VALUES ('MM101E', 'Mikro- es Makrookonomia', 3, 4, 1);
INSERT INTO Targy VALUES ('PJ101E', 'Jogtudomany', 3, 4, 2);
INSERT INTO Targy VALUES ('RJ101E', 'Jogi szakszovegolvasas', 3, 2, 2);
INSERT INTO Targy VALUES ('MK101E', 'Marketingkutatas', 4, 4, 3);
INSERT INTO Targy VALUES ('KJ101E', 'Jogtortenet', 4, 2, 2);
INSERT INTO Targy VALUES ('AA101E', 'Alkalmazott Anatomia', 5, 4, 5);
INSERT INTO Targy VALUES ('OJ101E', 'Orvosi jogi ismeretek', 5, 2, 5);
INSERT INTO Targy VALUES ('MM201E', 'Menedzsment alapjai', 6, 4, 6);
INSERT INTO Targy VALUES ('MM202E', 'Marketingkommunikacio', 6, 4, 6);
INSERT INTO Targy VALUES ('GG101E', 'Gazdasagi statisztika', 7, 4, 7);
INSERT INTO Targy VALUES ('GG102E', 'Gazdasagi matematika', 7, 4, 7);
INSERT INTO Targy VALUES ('PP101E', 'Pszichologiai alapismeretek', 8, 4, 8);
INSERT INTO Targy VALUES ('PP102E', 'Pszihoanalitikus elmelet', 8, 2, 8);
INSERT INTO Targy VALUES ('MK202E', 'Marketing menedzsment', 9, 4, 3);
INSERT INTO Targy VALUES ('MK201E', 'Marketing alapjai', 9, 4, 3);
INSERT INTO Targy VALUES ('GG103E', 'Penzugyi matematika', 10, 4, 30);
INSERT INTO Targy VALUES ('GG104E', 'Penzugyi statisztika', 10, 4, 30);
INSERT INTO Targy VALUES ('MT102E', 'Diszkret matematika', 11, 4, 1);
INSERT INTO Targy VALUES ('MT103E', 'Differencialegyenletek', 11, 4, 1);
INSERT INTO Targy VALUES ('MT201E', 'Valoszinusegszamitas', 12, 4, 1);
INSERT INTO Targy VALUES ('MT202E', 'Statisztika', 12, 4, 1);
INSERT INTO Targy VALUES ('TT101E', 'Tortenelem elmelete es modszertana', 13, 4, 15);
INSERT INTO Targy VALUES ('TT102E', 'Kozepkor tortenete', 13, 2, 15);
INSERT INTO Targy VALUES ('FT101E', 'Fizikai alapfogalmak', 14, 4, 14);
INSERT INTO Targy VALUES ('FT102E', 'Elektromagneses jelensegek', 14, 4, 14);
INSERT INTO Targy VALUES ('TT103E', 'ujkor tortenete', 15, 4, 15);
INSERT INTO Targy VALUES ('BL101E', 'Biologia alapjai', 16, 4, 16);
INSERT INTO Targy VALUES ('BL102E', 'Sejtbiologia', 16, 4, 16);
INSERT INTO Targy VALUES ('KK101E', 'Kommunikacio elmeletei', 17, 4, 17);
INSERT INTO Targy VALUES ('KK102E', 'Szovegertes es szovegalkotas', 17, 4, 17);
INSERT INTO Targy VALUES ('FK101E', 'Filozofiai antropologia', 18, 4, 18);
INSERT INTO Targy VALUES ('FK102E', 'Vallasfilozofia', 18, 2, 18);
INSERT INTO Targy VALUES ('NT101E', 'Nyelveszet alapjai', 19, 4, 19);
INSERT INTO Targy VALUES ('NT102E', 'Szociolingvisztika', 19, 4, 19);
INSERT INTO Targy VALUES ('AT101E', 'Algebrai alapok', 20, 4, 1);
INSERT INTO Targy VALUES ('AT102E', 'Linearis algebra', 20, 4, 1);
INSERT INTO Targy VALUES ('HT101E', 'Tortenelmi modszertan', 21, 4, 15);
INSERT INTO Targy VALUES ('HT102E', 'ujkori Magyarorszag tortenete', 21, 2, 15);
INSERT INTO Targy VALUES ('MT301E', 'Numerikus modszerek', 22, 4, 1);
INSERT INTO Targy VALUES ('MT302E', 'Komplex analizis', 22, 4, 1);
INSERT INTO Targy VALUES ('GT101E', 'Gazdasagi jog', 23, 4, 7);
INSERT INTO Targy VALUES ('GT102E', 'Vallalkozasi jog', 23, 2, 7);
INSERT INTO Targy VALUES ('ST101E', 'Statisztikai adatelemzes', 24, 4, 1);
INSERT INTO Targy VALUES ('ST102E', 'okonometria', 24, 4, 7);
INSERT INTO Targy VALUES ('CT101E', 'Compiler-tervezes', 25, 4, 1);
INSERT INTO Targy VALUES ('CT102E', 'Programozasi paradigma', 25, 4, 1);


-- TEREM

INSERT INTO Terem (teremnev, gepes, fero_hely) VALUES ('terem-001', 1, 50);
INSERT INTO Terem (teremnev, gepes, fero_hely) VALUES ('terem-002', 1, 40);
INSERT INTO Terem (teremnev, gepes, fero_hely) VALUES ('terem-003', 0, 60);
INSERT INTO Terem (teremnev, gepes, fero_hely) VALUES ('terem-004', 1, 30);
INSERT INTO Terem (teremnev, gepes, fero_hely) VALUES ('terem-005', 1, 50);
INSERT INTO Terem (teremnev, gepes, fero_hely) VALUES ('terem-006', 0, 80);
INSERT INTO Terem (teremnev, gepes, fero_hely) VALUES ('terem-007', 1, 35);
INSERT INTO Terem (teremnev, gepes, fero_hely) VALUES ('terem-008', 0, 90);
INSERT INTO Terem (teremnev, gepes, fero_hely) VALUES ('terem-009', 1, 45);
INSERT INTO Terem (teremnev, gepes, fero_hely) VALUES ('terem-010', 0, 70);
INSERT INTO Terem (teremnev, gepes, fero_hely) VALUES ('Konyvtar', 0, 70);
INSERT INTO Terem (teremnev, gepes, fero_hely) VALUES ('Deli terem', 0, 70);

--KURZUS

INSERT INTO Kurzus VALUES ('K001', 'Matematikai Analizis 1', 6, 120, 'H-CS', TO_DATE('08:00:00', 'HH24:MI:SS'), TO_DATE('10:00:00', 'HH24:MI:SS'), 'Konyvtar', 'MT101E');
INSERT INTO Kurzus VALUES ('K002', 'Programozasi Technikak 1', 5, 90, 'H-SZ', TO_DATE('12:00:00', 'HH24:MI:SS'), TO_DATE('14:00:00', 'HH24:MI:SS'), 'terem-004', 'PT102E');
INSERT INTO Kurzus VALUES ('K003', 'Adatbazis-kezeles 1', 4, 60, 'K-CS', TO_DATE('14:00:00', 'HH24:MI:SS'), TO_DATE('16:00:00', 'HH24:MI:SS'), 'Deli terem', 'AD101E');
INSERT INTO Kurzus VALUES ('K004', 'Mikro- es Makrookonomia 1', 5, 90, 'H-SZ', TO_DATE('08:00:00', 'HH24:MI:SS'), TO_DATE('10:00:00', 'HH24:MI:SS'), 'terem-001', 'MM101E');
INSERT INTO Kurzus VALUES ('K005', 'Jogtudomany 1', 4, 60, 'K-P', TO_DATE('10:00:00', 'HH24:MI:SS'), TO_DATE('12:00:00', 'HH24:MI:SS'), 'terem-003', 'PJ101E');
INSERT INTO Kurzus VALUES ('K006', 'Jogi szakszovegolvasas 1', 2, 30, 'H-SZ', TO_DATE('16:00:00', 'HH24:MI:SS'), TO_DATE('17:00:00', 'HH24:MI:SS'), 'terem-002', 'RJ101E');
INSERT INTO Kurzus VALUES ('K007', 'Marketingkutatas 1', 4, 60, 'K-CS', TO_DATE('10:00:00', 'HH24:MI:SS'), TO_DATE('12:00:00', 'HH24:MI:SS'), 'terem-007', 'MK101E');
INSERT INTO Kurzus VALUES ('K008', 'Jogtortenet 1', 2, 30, 'H-CS', TO_DATE('12:00:00', 'HH24:MI:SS'), TO_DATE('13:00:00', 'HH24:MI:SS'), 'terem-008', 'KJ101E');
INSERT INTO Kurzus VALUES ('K009', 'Alkalmazott Anatomia 1', 5, 90, 'K-SZ', TO_DATE('08:00:00', 'HH24:MI:SS'), TO_DATE('10:00:00', 'HH24:MI:SS'), 'terem-006', 'AA101E');
INSERT INTO Kurzus VALUES ('K010', 'Orvosi jogi ismeretek 1', 2, 30, 'H-SZ', TO_DATE('10:00:00', 'HH24:MI:SS'), TO_DATE('11:00:00', 'HH24:MI:SS'), 'Konyvtar', 'OJ101E');
INSERT INTO Kurzus VALUES ('K011', 'Menedzsment alapjai 1', 4, 60, 'K-CS', TO_DATE('14:00:00', 'HH24:MI:SS'), TO_DATE('16:00:00', 'HH24:MI:SS'), 'terem-009', 'MM201E');
INSERT INTO Kurzus VALUES ('K012', 'Marketingkommunikacio 1', 4, 60, 'H-CS', TO_DATE('16:00:00', 'HH24:MI:SS'), TO_DATE('18:00:00', 'HH24:MI:SS'), 'Konyvtar', 'MM202E');
INSERT INTO Kurzus VALUES ('K013', 'Gazdasagi statisztika 1', 5, 90, 'K-SZ', TO_DATE('08:00:00', 'HH24:MI:SS'), TO_DATE('10:00:00', 'HH24:MI:SS'), 'Deli terem', 'GG101E');

-- VIZSGA

INSERT INTO Vizsga (azonosito, tipus, kezdet, veg, teremnev, letszam)
VALUES ('VIZ001', 'szobeli', TO_DATE('2023-04-10 09:00:00', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-04-10 10:00:00', 'YYYY-MM-DD HH24:MI:SS'), 'terem-001', 30);

INSERT INTO Vizsga (azonosito, tipus, kezdet, veg, teremnev, letszam)
VALUES ('VIZ002', 'irasbeli', TO_DATE('2023-04-12 13:00:00', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-04-12 15:00:00', 'YYYY-MM-DD HH24:MI:SS'), 'terem-002', 40);

INSERT INTO Vizsga (azonosito, tipus, kezdet, veg, teremnev, letszam)
VALUES ('VIZ003', 'szobeli', TO_DATE('2023-04-15 10:00:00', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-04-15 11:00:00', 'YYYY-MM-DD HH24:MI:SS'), 'terem-003', 50);

INSERT INTO Vizsga (azonosito, tipus, kezdet, veg, teremnev, letszam)
VALUES ('VIZ004', 'irasbeli', TO_DATE('2023-04-17 14:00:00', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-04-17 16:00:00', 'YYYY-MM-DD HH24:MI:SS'), 'terem-004', 25);

INSERT INTO Vizsga (azonosito, tipus, kezdet, veg, teremnev, letszam)
VALUES ('VIZ005', 'szobeli', TO_DATE('2023-04-20 11:00:00', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-04-20 12:00:00', 'YYYY-MM-DD HH24:MI:SS'), 'terem-005', 40);

INSERT INTO Vizsga (azonosito, tipus, kezdet, veg, teremnev, letszam)
VALUES ('VIZ006', 'irasbeli', TO_DATE('2023-04-22 15:00:00', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-04-22 17:00:00', 'YYYY-MM-DD HH24:MI:SS'), 'terem-006', 60);



-- RESZTVESZ

INSERT INTO Resztvesz VALUES ('AJZX6D', 'K001', 3);
INSERT INTO Resztvesz VALUES ('B0A3OI', 'K002', 4);
INSERT INTO Resztvesz VALUES ('B6GQEW', 'K003', 2);
INSERT INTO Resztvesz VALUES ('C1K4ZB', 'K004', 5);
INSERT INTO Resztvesz VALUES ('C54MSQ', 'K005', 3);
INSERT INTO Resztvesz VALUES ('CFEKVK', 'K006', 5);
INSERT INTO Resztvesz VALUES ('CMRHX8', 'K007', 2);
INSERT INTO Resztvesz VALUES ('CXGGSG', 'K008', 4);
INSERT INTO Resztvesz VALUES ('CXPIH4', 'K009', 3);
INSERT INTO Resztvesz VALUES ('DNVP2H', 'K010', 4);
INSERT INTO Resztvesz VALUES ('EG00FK', 'K011', 2);
INSERT INTO Resztvesz VALUES ('F79NO8', 'K012', 5);
INSERT INTO Resztvesz VALUES ('FDE2ZK', 'K013', 4);
INSERT INTO Resztvesz VALUES ('FM0LW6', 'K001', 3);
INSERT INTO Resztvesz VALUES ('FT14WX', 'K002', 2);
INSERT INTO Resztvesz VALUES ('FXLP42', 'K003', 4);
INSERT INTO Resztvesz VALUES ('GZA4YX', 'K004', 3);
INSERT INTO Resztvesz VALUES ('HCBCOV', 'K005', 2);
INSERT INTO Resztvesz VALUES ('I0GGSY', 'K006', 5);
INSERT INTO Resztvesz VALUES ('I2U52Y', 'K007', 3);
INSERT INTO Resztvesz VALUES ('IBRP6D', 'K008', 4);
INSERT INTO Resztvesz VALUES ('IEK09S', 'K009', 5);
INSERT INTO Resztvesz VALUES ('IWZCI8', 'K010', 4);
INSERT INTO Resztvesz VALUES ('KB24FJ', 'K011', 3);
INSERT INTO Resztvesz VALUES ('MHE82U', 'K012', 2);
INSERT INTO Resztvesz VALUES ('MI2WS5', 'K013', 4);
INSERT INTO Resztvesz VALUES ('OMK2OY', 'K001', 5);
INSERT INTO Resztvesz VALUES ('OO2BYO', 'K002', 4);
INSERT INTO Resztvesz VALUES ('OTJB6G', 'K003', 3);
INSERT INTO Resztvesz VALUES ('PBJ3HT', 'K004', 2);
INSERT INTO Resztvesz VALUES ('PLMWRJ', 'K005', 3);


-- TART

INSERT INTO Tart VALUES ('B0A3OI', 'K001');
INSERT INTO Tart VALUES ('B0A3OI', 'K003');
INSERT INTO Tart VALUES ('EL9JKS', 'K001');
INSERT INTO Tart VALUES ('EL9JKS', 'K002');
INSERT INTO Tart VALUES ('JOESES', 'K003');
INSERT INTO Tart VALUES ('JOESES', 'K006');
INSERT INTO Tart VALUES ('OB6T8E', 'K001');
INSERT INTO Tart VALUES ('OB6T8E', 'K005');
INSERT INTO Tart VALUES ('S9QWNI', 'K002');
INSERT INTO Tart VALUES ('S9QWNI', 'K004');
INSERT INTO Tart VALUES ('B0A3OI', 'K008');
INSERT INTO Tart VALUES ('EL9JKS', 'K010');
INSERT INTO Tart VALUES ('JOESES', 'K011');
INSERT INTO Tart VALUES ('OB6T8E', 'K012');
INSERT INTO Tart VALUES ('S9QWNI', 'K013');
INSERT INTO Tart VALUES ('B0A3OI', 'K006');
INSERT INTO Tart VALUES ('EL9JKS', 'K009');
INSERT INTO Tart VALUES ('JOESES', 'K013');
INSERT INTO Tart VALUES ('S9QWNI', 'K011');

-- VIZSGAZIK

INSERT INTO Vizsgazik VALUES ('VIZ001', 'AJZX6D', 3);
INSERT INTO Vizsgazik VALUES ('VIZ001', 'B0A3OI', 5);
INSERT INTO Vizsgazik VALUES ('VIZ002', 'C1K4ZB', 2);
INSERT INTO Vizsgazik VALUES ('VIZ002', 'CFEKVK', 4);
INSERT INTO Vizsgazik VALUES ('VIZ003', 'CMRHX8', 5);
INSERT INTO Vizsgazik VALUES ('VIZ003', 'CXGGSG', 2);
INSERT INTO Vizsgazik VALUES ('VIZ004', 'DNVP2H', 3);
INSERT INTO Vizsgazik VALUES ('VIZ004', 'EG00FK', 5);
INSERT INTO Vizsgazik VALUES ('VIZ005', 'F79NO8', 2);
INSERT INTO Vizsgazik VALUES ('VIZ005', 'FDE2ZK', 4);
INSERT INTO Vizsgazik VALUES ('VIZ006', 'FM0LW6', 5);
INSERT INTO Vizsgazik VALUES ('VIZ006', 'FT14WX', 3);
INSERT INTO Vizsgazik VALUES ('VIZ001', 'GZA4YX', 4);
INSERT INTO Vizsgazik VALUES ('VIZ002', 'HCBCOV', 2);
INSERT INTO Vizsgazik VALUES ('VIZ003', 'I0GGSY', 5);
INSERT INTO Vizsgazik VALUES ('VIZ004', 'I2U52Y', 3);
INSERT INTO Vizsgazik VALUES ('VIZ005', 'IBRP6D', 5);
INSERT INTO Vizsgazik VALUES ('VIZ006', 'IEK09S', 2);
INSERT INTO Vizsgazik VALUES ('VIZ001', 'IWZCI8', 4);
INSERT INTO Vizsgazik VALUES ('VIZ002', 'KB24FJ', 2);

-- VIZSGAZTAT

INSERT INTO Vizsgaztat VALUES ('VIZ001', 'B0A3OI');
INSERT INTO Vizsgaztat VALUES ('VIZ001', 'EL9JKS');
INSERT INTO Vizsgaztat VALUES ('VIZ002', 'JOESES');
INSERT INTO Vizsgaztat VALUES ('VIZ002', 'OB6T8E');
INSERT INTO Vizsgaztat VALUES ('VIZ003', 'S9QWNI');
INSERT INTO Vizsgaztat VALUES ('VIZ003', 'EL9JKS');
INSERT INTO Vizsgaztat VALUES ('VIZ004', 'OB6T8E');
INSERT INTO Vizsgaztat VALUES ('VIZ004', 'B0A3OI');
INSERT INTO Vizsgaztat VALUES ('VIZ005', 'JOESES');
INSERT INTO Vizsgaztat VALUES ('VIZ005', 'S9QWNI');
