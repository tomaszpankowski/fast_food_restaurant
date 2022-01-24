CREATE TABLE fastfood_restaurant_messages(
    id INT NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(80) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    phone VARCHAR(14) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message VARCHAR(250) NOT NULL,
    time DATETIME DEFAULT CURRENT_TIMESTAMP, 
    PRIMARY KEY(id)
);