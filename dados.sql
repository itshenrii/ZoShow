CREATE TABLE usuarios (
    CREATE TABLE usuarios (
        id INT PRIMARY KEY AUTO_INCREMENT,
        nome VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        senha VARCHAR(50) NOT NULL,
        nascimento DATE NOT NULL,
        criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );