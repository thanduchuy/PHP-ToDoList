// update
USE LIST
DELIMITER $$
CREATE TRIGGER update_list
BEFORE UPDATE ON list
BEGIN
    if (deleted.content == NEW.content) 
    	BEGIN
        	ROLLBACK TRANSACTION
        END
END $$
DELIMITER ;

// insert
USE LIST
DELIMITER $$
CREATE TRIGGER update_list
BEFORE INSERT ON list
BEGIN
    DECLARE @so INT;
    SELECT @so = COUNT(id) 
    FROM list
    WHERE list.content = NEW.content
    if (@so > 1) 
    	BEGIN
        	ROLLBACK TRANSACTION
        END
END $$
DELIMITER ;

//
USE LIST
DELIMITER $$
CREATE TRIGGER `before_update_list` BEFORE UPDATE ON `list` 
FOR EACH ROW 
BEGIN 
  IF (NEW.date is null) THEN
       SET NEW.date = NOW();
  END IF;   
END;$$
DELIMITER ;
//
DELIMITER
    $$
CREATE TRIGGER before_list_delete AFTER DELETE
ON
BEGIN
    INSERT INTO history(
        history.content,
        history.date
    )
VALUES(
    OLD.content,
    OLD.date
) ;
END $$
DELIMITER
    ;
    //
    IF NEW.content <> OLD.content
THEN  
	UPDATE `list`
    SET 
    	`date` = NOW()
    WHERE
    	`id` = NEW.id
END IF
//
DELIMITER ;;
CREATE TRIGGER `before_update_list` 
BEFORE UPDATE ON `list` 
FOR EACH ROW
BEGIN
    SET NEW.date = NOW();
END;;
DELIMITER ;
//

DELIMITER $$

CREATE TRIGGER `before_insert_list`
BEFORE INSERT ON `list`
FOR EACH ROW
BEGIN
  IF (EXISTS(SELECT 1 FROM list WHERE content = NEW.content)) THEN
    SIGNAL SQLSTATE VALUE '45000' SET MESSAGE_TEXT = 'INSERT failed due to duplicate content';
  END IF;
END$$
DELIMITER ;
