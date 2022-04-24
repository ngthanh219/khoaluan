CREATE TABLE tbl_detai (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    madetai varchar(255) COLLATE utf8_general_ci,
    tendetai varchar(255) COLLATE utf8_general_ci,
    selected int default 0 COLLATE utf8_general_ci,
    status int default 0 COLLATE utf8_general_ci
);