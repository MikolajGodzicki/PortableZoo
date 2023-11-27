CREATE TABLE IF NOT EXISTS portablezoo.`kolory` (
    `ID_Koloru` int(11) NOT NULL,
    `Kolor` varchar(256) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS portablezoo.`leki` (
    `ID_Leku` int(11) NOT NULL,
    `Nazwa` varchar(256) NOT NULL,
    `Cena` decimal(65, 2) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS portablezoo.`wizyty` (
    `ID_Wizyty` int(11) NOT NULL,
    `ID_Zwierzaka` int(11) NOT NULL,
    `Kiedy` date NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS portablezoo.`wlasciciele` (
    `ID_Wlasciciela` int(11) NOT NULL,
    `Nazwisko` varchar(256) NOT NULL,
    `Imie` varchar(256) NOT NULL,
    `Ulica` varchar(256) NOT NULL,
    `Miasto` varchar(256) NOT NULL,
    `Poczta` varchar(256) NOT NULL,
    `Telefon` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS portablezoo.`wykonane_zabiegi` (
    `ID_Zabiegu` int(11) NOT NULL,
    `ID_Wizyty` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS portablezoo.`wykorzystane_leki` (
    `ID_Leku` int(11) NOT NULL,
    `ID_Wizyty` int(11) NOT NULL,
    `Ilosc` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS portablezoo.`zabiegi` (
    `ID_Uslugi` int(11) NOT NULL,
    `Nazwa` varchar(256) NOT NULL,
    `Cena` decimal(65, 2) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS portablezoo.`zwierzeta` (
    `ID_Zwierza` int(11) NOT NULL,
    `Rodzaj_zwierza` varchar(256) NOT NULL,
    `Imie` varchar(256) NOT NULL,
    `Data_urodzin` date NOT NULL,
    `ID_Koloru` int(11) NOT NULL,
    `ID_Wlasciciela` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

ALTER TABLE
    portablezoo.`kolory`
ADD
    PRIMARY KEY (`ID_Koloru`);

ALTER TABLE
    portablezoo.`leki`
ADD
    PRIMARY KEY (`ID_Leku`);

ALTER TABLE
    portablezoo.`wizyty`
ADD
    PRIMARY KEY (`ID_Wizyty`),
ADD
    KEY `ID_Zwierzaka` (`ID_Zwierzaka`);

ALTER TABLE
    portablezoo.`wlasciciele`
ADD
    PRIMARY KEY (`ID_Wlasciciela`);

ALTER TABLE
    portablezoo.`wykonane_zabiegi`
ADD
    KEY `ID_Zabiegu` (`ID_Zabiegu`),
ADD
    KEY `ID_Wizyty` (`ID_Wizyty`);

ALTER TABLE
    portablezoo.`wykorzystane_leki`
ADD
    KEY `ID_Leku` (`ID_Leku`),
ADD
    KEY `ID_Wizyty` (`ID_Wizyty`);

ALTER TABLE
    portablezoo.`zabiegi`
ADD
    PRIMARY KEY (`ID_Uslugi`);

ALTER TABLE
    portablezoo.`zwierzeta`
ADD
    PRIMARY KEY (`ID_Zwierza`),
ADD
    KEY `ID_Koloru` (`ID_Koloru`),
ADD
    KEY `ID_Wlasciciela` (`ID_Wlasciciela`);

ALTER TABLE
    portablezoo.`kolory`
MODIFY
    `ID_Koloru` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE
    portablezoo.`leki`
MODIFY
    `ID_Leku` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE
    portablezoo.`wizyty`
MODIFY
    `ID_Wizyty` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE
    portablezoo.`wlasciciele`
MODIFY
    `ID_Wlasciciela` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE
    portablezoo.`zabiegi`
MODIFY
    `ID_Uslugi` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE
    portablezoo.`zwierzeta`
MODIFY
    `ID_Zwierza` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE
    portablezoo.`wizyty`
ADD
    CONSTRAINT `wizyty_ibfk_1` FOREIGN KEY (`ID_Zwierzaka`) REFERENCES portablezoo.`zwierzeta` (`ID_Zwierza`);

ALTER TABLE
    portablezoo.`wykonane_zabiegi`
ADD
    CONSTRAINT `wykonane_zabiegi_ibfk_1` FOREIGN KEY (`ID_Zabiegu`) REFERENCES portablezoo.`zabiegi` (`ID_Uslugi`),
ADD
    CONSTRAINT `wykonane_zabiegi_ibfk_2` FOREIGN KEY (`ID_Wizyty`) REFERENCES portablezoo.`wizyty` (`ID_Wizyty`);

ALTER TABLE
    portablezoo.`wykorzystane_leki`
ADD
    CONSTRAINT `wykorzystane_leki_ibfk_1` FOREIGN KEY (`ID_Leku`) REFERENCES portablezoo.`leki` (`ID_Leku`),
ADD
    CONSTRAINT `wykorzystane_leki_ibfk_2` FOREIGN KEY (`ID_Wizyty`) REFERENCES portablezoo.`wizyty` (`ID_Wizyty`);

ALTER TABLE
    portablezoo.`zwierzeta`
ADD
    CONSTRAINT `zwierzeta_ibfk_1` FOREIGN KEY (`ID_Koloru`) REFERENCES portablezoo.`kolory` (`ID_Koloru`),
ADD
    CONSTRAINT `zwierzeta_ibfk_2` FOREIGN KEY (`ID_Wlasciciela`) REFERENCES portablezoo.`wlasciciele` (`ID_Wlasciciela`);