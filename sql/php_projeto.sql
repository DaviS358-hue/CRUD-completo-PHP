create database if not exists projeto_php;
use projeto_php;
CREATE TABLE usuario (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    nome_user VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL, 
    password_hash VARCHAR(255) NOT NULL,
    birth_date DATE NOT NULL,
    token_recuperacao VARCHAR(255) NULL,
    token_expiracao DATETIME NULL
);
CREATE TABLE address_user (
    id_address INT PRIMARY KEY AUTO_INCREMENT,
    street VARCHAR(300) NOT NULL,
    number_address VARCHAR(15) NOT NULL,
    neighborhood VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    cep VARCHAR(8) NOT NULL,
    user_id INT NOT NULL,
    CONSTRAINT fk_address_usuario 
        FOREIGN KEY (user_id) 
        REFERENCES usuario(user_id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE
);

select * from usuario;
select * from address_user;

