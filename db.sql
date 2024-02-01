--users
CREATE TABLE `loren`.`users` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `login` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `roleID` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

--users
INSERT INTO `users`(`name`, `login`, `password`, `roleID`) VALUES 
('Свинтокская Ядвига Владимировна','svin911@gmail.com','111','1'),
('Вежлива Марина Александровна','marisha22@gmail.com','111','2'),
('Абрамова Дарья Аркадьевна','ada96@gmail.com','111','3')

