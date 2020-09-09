<?php

use App\Connection;

require dirname(__DIR__) . '/vendor/autoload.php';

// Initialisation de la librairie Faker (en français)
$faker = Faker\Factory::create('fr_FR');

// Connexion à la bdd
$pdo = Connection::getPDO();

// PREPARATION DES TABLE AVANT DE LES REMPLIR 
// On supprime la vérif des clés étrangères (pour les tables qui ont des liens entre elles)
$pdo->exec('SET FOREIGN_KEY_CHECKS = 0'); 
// Vidages des tables
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE logo');
$pdo->exec('TRUNCATE TABLE images');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('TRUNCATE TABLE commentary');
// On remet le param des clés étrangères par défaut (après la suppression de toute donnée des tables, pour éviter les erreurs)
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1'); 



// Tableaux qui vont contenir les id des tables user, post et category
$IdUsers = [];
$IdPosts = [];
$IdCategories = [1,2,3,4,5];

// TABLE User
$passwordKurtCobain = password_hash('16641664', PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO User (username, email, password, role) VALUES
('Baudelaire', 'baudelaire@email.com', '6fd4c29cbd6a758bce1acf991aa9f32e69ced155', 'user'),
('Rimbaud', 'rimbaud@email.com', '6fd4c29cbd6a758bce1acf991aa9f32e69ced155', 'user'),
('Victor Hugo', 'vhugo@email.com', '3edb6ce6e328ea8639a3a357c7c6997775ab52ea', 'user'),
('Jacques Prevert', 'j.prevert@email.com', '713f55ba75af01593dc4e845a8c0dcb9fbb45a88', 'user'),
('Janis Joplin', 'j.joplin@email.com', '713f55ba75af01593dc4e845a8c0dcb9fbb45a88', 'user'),
('Dolores Oriordan', 'd.oriordan@email.com', '713f55ba75af01593dc4e845a8c0dcb9fbb45a88', 'user'),
('Jimi Hendrix', 'j.hendrix@email.com', '713f55ba75af01593dc4e845a8c0dcb9fbb45a88', 'user'),
('Kurt Cobain', 'k.cobain@gmail.com', '$passwordKurtCobain', 'user'),
('Freddie Mercury', 'f.mercury@email.com', '713f55ba75af01593dc4e845a8c0dcb9fbb45a88', 'user'),
('Jim Morrison', 'j.Morrison@email.com', '713f55ba75af01593dc4e845a8c0dcb9fbb45a88', 'user')
");
// Admin de la table User (avec admin admin)
$password = password_hash('admin', PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO User SET username = 'admin', email = 'admin@admin.fr', password = '$password', role = 'admin' ");


// TABLE Post
for($i=1; $i<11; $i++){
    $pdo->exec("INSERT INTO Post SET 
        title='{$faker->sentence()}', 
        picture='picture{$i}', 
        slug='{$faker->slug}', 
        content='{$faker->paragraphs(rand(3, 15), true)}',
        created_at='{$faker->date} {$faker->time}',
        author_id='{$faker->numberBetween(1, 10)}',
        likes = '{$faker->randomDigit}',
        isLiked = '{$faker->numberBetween(0, 1)}'
    ");
    // On rempli le tableau $post des id des post
    $IdPosts[] = $pdo->lastInsertId(); // "$posts" va récupérer l'ensemble des id des articles (post)
}


// TABLE Category
$pdo->exec("INSERT INTO Category (name, slug) VALUES
('PHP', 'slug-php'),
('Javascript', 'slug-javascript'),
('React', 'slug-react'),
('Symphony', 'slug-symfony'),
('autre', 'slug-autre')
");

// TABLE POST_CATEGORY
// Boucle de remplissage de la table post_category
foreach($IdPosts as $IdPost){
    // $categories contiendra les catégories entre 1 et le nb de categories existantes
    //$categories = $faker->randomElements($IdCategories, count($IdCategories)); 
    foreach($IdCategories as $IdCategory){
        $pdo->exec("INSERT INTO post_category SET post_id = '$IdPost', category_id = '$IdCategory' ");
    }
}

// TABLE COMMENATARY (Commentaire des post)
$pdo->exec("INSERT INTO Commentary (post_id, author_id, content, date_commentary) VALUES
(1, 4, 'Mangifique', '2010-06-10 05:06:47'),
(1, NULL, 'Très joli', '2011-09-04 04:47:35'),
(2, NULL, 'J''ai pas tout compris...', '2012-101-14 06:34:30'),
(2, 2, 'Quel joli texte, j''adore !', '2016-05-05 23:07:52'),
(3, NULL, 'C''est gai tout ça...', '2019-07-26 05:42:04'),
(4, 1, 'Tellement beau, on ne s''en lasse pas.', '2014-04-23 07:44:33'),
(5, 1, 'Incroyable !!!', '2015-11-22 12:05:34'),
(5, 2, 'Pas mal, j''aime bien', '2020-11-24 08:47:15'),
(8, 1, 'Exceptionnel, mais un peu triste quand même...', '2014-04-15 21:56:05'),
(5, NULL, 'Mouais, pas convaincue...', '2012-11-09 09:09:09');
");
    


