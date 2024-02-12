DELIMITER //
CREATE TRIGGER before_insert_user
BEFORE INSERT serenitea_farms_utilisateurs
FOR EACH ROW
BEGIN
    DECLARE user_id INT;
    DECLARE user_seq VARCHAR(10);

    SELECT AUTO_INCREMENT INTO user_id
    FROM information_schema.TABLES
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'serenitea_farms_utilisateurs';

    SET user_seq = CONCAT('USER', LPAD(user_id,2,'0'));

    SET NEW.id_user = user_seq;
END//

DELIMITER;

DELIMITER //
CREATE TRIGGER before_insert_user
BEFORE INSERT serenitea_farms_parcelles
FOR EACH ROW
BEGIN
    DECLARE parcelle_id INT;
    DECLARE parcelle_seq VARCHAR(10);

    SELECT AUTO_INCREMENT INTO parcelle_id
    FROM information_schema.TABLES
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'serenitea_farms_parcelles';

    SET parcelle_seq = CONCAT('PARC', LPAD(parcelle_id,10,'0'));

    SET NEW.reference = parcelle_seq;
END//

DELIMITER;

DELIMITER //
CREATE TRIGGER before_insert_user
BEFORE INSERT serenitea_farms_ceuilleurs
FOR EACH ROW
BEGIN
    DECLARE ceuilleur_id INT;
    DECLARE ceuilleur_seq VARCHAR(10);

    SELECT AUTO_INCREMENT INTO ceuilleur_id
    FROM information_schema.TABLES
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'serenitea_farms_ceuilleurs';

    SET ceuilleur_seq = CONCAT('PARC', LPAD(ceuilleur_id,10,'0'));

    SET NEW.reference = ceuilleur_seq;
END//

DELIMITER;