/*
        MEMO

        SHOW TABLE STATUS FROM nom_de_la_bdd LIKE 'nom_de_la_table';  
        (Commande sql pour récup les informations sur la table comme le moteur, la version, le nb de ligne ou le prochaine id) 
*/

/*********************** BDD PORTFOLIO V3 ********************************/
CREATE DATABASE portfolio2 CHARACTER SET 'utf8';
SET lc_time_names = 'fr_FR'; /* PERMET D'AFFICHER LES JOURS ET MOIS DES DATE EN FRANCAIS */


/* TABLE UTILISATEUR */
CREATE TABLE User(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(200) NOT NULL UNIQUE, -- email sera unique
    password VARCHAR(60) NOT NULL, -- le mot de passe sera hashé avec BCRYPT, ce qui donne toujours une chaîne de 40 caractères
    role ENUM('user', 'visitor', 'admin') NOT NULL,  -- Par défaut le rôle sera "user"
    PRIMARY KEY (id)
);

/* TABLE DES POST DU BLOG */
CREATE TABLE IF NOT EXISTS Post(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    picture VARCHAR(255) DEFAULT NULL,
    slug VARCHAR(255) NOT NULL,
    content TEXT(650000) NOT NULL,
    created_at DATETIME NOT NULL,
    author_id INT UNSIGNED NOT NULL,
    likes INT DEFAULT NULL,
    isLiked BOOLEAN NOT NULL,
    PRIMARY KEY (id),
    -- Un post appartient à un user (auteur du post)
    CONSTRAINT fk_Post_User
        FOREIGN KEY (author_id)
        REFERENCES User(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

/* TABLE DES LOGO DU BLOG */
CREATE TABLE Logo(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    size INT UNSIGNED NOT NULL,
    post_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    -- un logo appartient à un post (clé étrangère entre post_id de cette table et id de la table Post)
    CONSTRAINT fk_Logo_Post
        FOREIGN KEY (post_id)
        REFERENCES Post(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

/* TABLE DES IMAGES DU BLOG */
CREATE TABLE Images(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    size INT UNSIGNED NOT NULL,
    post_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    -- une image appartient à un post (clé étrangère entre post_id de cette table et id de la table Post)
    CONSTRAINT fk_Image_Post
        FOREIGN KEY (post_id)
        REFERENCES Post(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

/* TABLE DES CATEGORIE DU BLOG */
CREATE TABLE Category(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(200) NOT NULL,
    PRIMARY KEY (id)
);

/* TABLE QUI SERT DE LIEN ENTRE "post" et "category" */
CREATE TABLE Post_category(
    post_id INT UNSIGNED NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (post_id, category_id),

    CONSTRAINT fk_Post_category_Category
        FOREIGN KEY (category_id)
        REFERENCES Category(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_Post_category_Post
        FOREIGN KEY (post_id)
        REFERENCES Post(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

/* TABLE COMMENTAIRES */
CREATE TABLE Commentary(
	id INT UNSIGNED AUTO_INCREMENT,
	post_id INT UNSIGNED NOT NULL,
	author_id INT UNSIGNED,
	content TEXT NOT NULL,
	date_commentary DATETIME NOT NULL,
	PRIMARY KEY(id),
    -- un commentaire appartient à un post (article)
    CONSTRAINT fk_Commentary_Post
        FOREIGN KEY (post_id)
        REFERENCES Post(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    -- un commentaire appartient à un user
    CONSTRAINT fk_Commentary_User
        FOREIGN KEY (author_id)
        REFERENCES User(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);