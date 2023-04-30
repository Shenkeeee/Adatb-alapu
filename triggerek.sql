-- A 'Kurzus' táblához egy trigger, amely ellenőrzi, hogy a kurzus kezdeti és befejező dátuma helyes-e
CREATE OR REPLACE TRIGGER trg_Kurzus_dates
BEFORE INSERT OR UPDATE ON kurzus
FOR EACH ROW
BEGIN
IF :NEW.kezdet >= :NEW.veg THEN
RAISE_APPLICATION_ERROR(-20001, 'A kurzus befejező dátuma nem lehet korábbi vagy egyenlő a kezdő dátumnál.');
END IF;
END;
/


CREATE OR REPLACE TRIGGER trg_Kurzus_letszam
BEFORE INSERT OR UPDATE ON kurzus
FOR EACH ROW
DECLARE
v_ferohely terem.fero_hely%TYPE;
v_letszam NUMBER;
BEGIN
SELECT fero_hely INTO v_ferohely FROM terem WHERE teremnev = :NEW.teremnev;
SELECT COUNT(*) INTO v_letszam FROM resztvesz WHERE kurzus_kod = :NEW.kod;

IF v_letszam > v_ferohely THEN
RAISE_APPLICATION_ERROR(-20005, 'A kurzus résztvevőinek száma meghaladja a terem kapacitását. Kérlek, válassz másik termet vagy csökkentsd a résztvevők számát.');
END IF;
END;
/


-- A 'Szak' táblához egy trigger, amely ellenőrzi a szakid egyediségét
CREATE OR REPLACE TRIGGER trg_Szak_unique_szakid
BEFORE INSERT OR UPDATE ON szak
FOR EACH ROW
DECLARE
v_count NUMBER;
BEGIN
SELECT COUNT(*) INTO v_count FROM szak WHERE szakid = :NEW.szakid;

IF v_count > 0 THEN
RAISE_APPLICATION_ERROR(-20006, 'A megadott szakid már létezik. Kérlek, adj meg egy egyedi szakid-t.');
END IF;
END;
/

-- A vizsga létszámát 
CREATE OR REPLACE TRIGGER trg_Resztvesz_noveles
AFTER INSERT ON vizsgazik
FOR EACH ROW
BEGIN
UPDATE vizsga
SET letszam = letszam + 1
WHERE azonosito = (SELECT azonosito FROM vizsga WHERE azonosito = :NEW.azonosito);
END;
/


