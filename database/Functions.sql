DELIMITER //
CREATE TRIGGER before_insert_user
BEFORE INSERT serenitea_farms_utilisateurs
FOR EACH ROW
BEGIN
    DECLARE user_id INT;
    DECLARE user_seq VARCAHR(10);

    SELECT AUTO_INCREMENT INTO user_id
    FROM information_schema.TABLES
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'serenitea_farms_utilisateurs';

    SET user_seq = CONCAT('USER', LPAD(user_id,2,'0'));

    SET NEW.id_user = user_seq;
END//

DELIMITER;