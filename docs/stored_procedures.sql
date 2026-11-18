-- ==============================================================================
-- Stored Procedures: BE-opdracht 03 - Wijzigen Leverancier
-- Auteur: KadhimH
-- Datum: 04-11-2026
-- ==============================================================================

USE Jamin;

-- ------------------------------------------------------------------------------
-- 1. Overzicht Leveranciers met Server-side Pagination (Max 4 per pagina)
-- ------------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS spGetLeveranciersOverzichtPaginated;
DELIMITER //
CREATE PROCEDURE spGetLeveranciersOverzichtPaginated(IN p_Limit INT, IN p_Offset INT)
BEGIN
    SELECT 
         Id
        ,Naam
        ,ContactPersoon
        ,LeverancierNummer
        ,Mobiel
    FROM Leverancier
    ORDER BY Id ASC
    LIMIT p_Limit OFFSET p_Offset;
END //
DELIMITER ;

-- ------------------------------------------------------------------------------
-- 2. Leverancier Details ophalen (inclusief Contact- / Adresgegevens)
-- ------------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS spGetLeverancierDetailsById;
DELIMITER //
CREATE PROCEDURE spGetLeverancierDetailsById(IN p_LeverancierId INT)
BEGIN
    SELECT 
         l.Id AS LeverancierId
        ,l.Naam
        ,l.ContactPersoon
        ,l.LeverancierNummer
        ,l.Mobiel
        ,c.Id AS ContactId
        ,c.Straat AS Straatnaam
        ,c.Huisnummer
        ,c.Postcode
        ,c.Stad
    FROM Leverancier l
    LEFT JOIN Contact c ON l.ContactId = c.Id
    WHERE l.Id = p_LeverancierId;
END //
DELIMITER ;

-- ------------------------------------------------------------------------------
-- 3. Wijzig Leveranciergegevens en Contactgegevens
-- ------------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS spWijzigLeverancier;
DELIMITER //
CREATE PROCEDURE spWijzigLeverancier(
    IN p_LeverancierId INT,
    IN p_Naam VARCHAR(100),
    IN p_ContactPersoon VARCHAR(100),
    IN p_LeverancierNummer VARCHAR(20),
    IN p_Mobiel VARCHAR(20),
    IN p_Straat VARCHAR(100),
    IN p_Huisnummer VARCHAR(20),
    IN p_Postcode VARCHAR(10),
    IN p_Stad VARCHAR(100)
)
BEGIN
    DECLARE v_ContactId INT;

    -- Haal het gekoppelde ContactId op
    SELECT ContactId INTO v_ContactId
    FROM Leverancier
    WHERE Id = p_LeverancierId;

    -- Update Leverancier
    UPDATE Leverancier
    SET Naam = p_Naam,
        ContactPersoon = p_ContactPersoon,
        LeverancierNummer = p_LeverancierNummer,
        Mobiel = p_Mobiel,
        DatumGewijzigd = NOW(6)
    WHERE Id = p_LeverancierId;

    -- Update of Insert Contact
    IF v_ContactId IS NOT NULL THEN
        UPDATE Contact
        SET Straat = p_Straat,
            Huisnummer = p_Huisnummer,
            Postcode = p_Postcode,
            Stad = p_Stad,
            DatumGewijzigd = NOW(6)
        WHERE Id = v_ContactId;
    ELSE
        INSERT INTO Contact (Straat, Huisnummer, Postcode, Stad, IsActief, DatumAangemaakt, DatumGewijzigd)
        VALUES (p_Straat, p_Huisnummer, p_Postcode, p_Stad, 1, NOW(6), NOW(6));

        UPDATE Leverancier
        SET ContactId = LAST_INSERT_ID()
        WHERE Id = p_LeverancierId;
    END IF;
END //
DELIMITER ;
