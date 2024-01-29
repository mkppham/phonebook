CREATE TABLE if not exists `phonebook`(
     id int(111) NOT NULL AUTO_INCREMENT,
    name text(100) NOT NULL ,
    phonenumber int NOT NULL ,
    PRIMARY KEY (id)
    ) ENGINE =InnoDB DEFAULT  CHARSET = latin1 AUTO_INCREMENT=2;
INSERT INTO `phonebook` (`name`, `phonenumber`) VALUES
                                                   ('Pham Van A', '74738759'),
                                                   ('Nguyen Trong H', '26587645'),
                                                   ('Mai Viet D', '87645839'),
                                                   ('Pham Kim K', '267582');