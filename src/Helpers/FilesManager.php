<?php
namespace App\Helpers;

use App\Connection;
use App\Helpers\ResizeImage;
use App\Table\{ImageTable, LogoTable, PostTable};


/**
 * Permet de gérer une collection d'images (vérif, upload, suppression)
 * SIGNATURE: $filesManager = new FilesManager($_FILES);
 */
class FilesManager{

    private $data = null;        // Données réçue à la construction (une image (string), ou une collection d'image (array))
    private $pdo;
    private $errors = []; // Tableau qui recevra les erreur s'il y en a (voir méthode valid())
    private $postTable;   // Permet entre autre de vérif si un champ existe dans la table post
    private $logoTable;   // Permet entre autre de vérif si un champ existe dans la table logo
    private $imageTable;  // Permet entre autre de vérif si un champ existe dans la table Image

    public function __construct($data)
    {
        $this->data = $data;
        $this->pdo = Connection::getPDO();
        $this->postTable = new PostTable($this->pdo);
        $this->logoTable = new LogoTable($this->pdo);
        $this->imageTable = new ImageTable($this->pdo);
    }
    
    
    // Valide un fichier ou une collection de fichiers, en param le nom du champs à valider (retourne un tableau d'erreurs, ou un tableau vide s'il y en a pas)
    public function valid($fieldName): array
    {
        // VERIF D'UNE IMAGE ('picture', notre photo principale)
        if(is_string($this->data[$fieldName]['name'])){

            $name = $this->data[$fieldName]['name']; // ai.png
            $size = $this->data[$fieldName]['size'];

            // Vérif si le champ est vide
            if(empty($name)){
                $this->errors[$fieldName] = "Sélectionner un fichier, l'image ne peut être vide !";
            }
            // Récup de l' extension du fichier reçu
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            if($ext){
                // Validation des extensions des fichiers
                if(!in_array($ext, array('jpg','jpeg','png','gif'))){
                    $this->errors[$fieldName] = "L'extension du fichier '{$name}' n'est pas valide.";
                }
            }
            // Validation de la taille des fichiers
            if($size/1024/1024 > 2){ // Limitation à 2Mo  (1ko = 1024 octets)
                $this->errors[$fieldName] = "Le fichier '{$name}' dépasse la taille autorisée.";
            }
            return $this->errors;

        }

        // VERIF D'UNE COLLECTION D'IMAGE (Nos logos et collection d'images)
        if(is_array($this->data[$fieldName]['name'])){

            $names = $this->data[$fieldName]['name']; // [ai.png, ps.jpg, ...]
            $sizes = $this->data[$fieldName]['size'];
            
            foreach($names as $name){
                // Récup des extension les fichiers reçus à partir du nom du fichier
                $exts[] = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            }
  
            // Validation des extensions des fichiers
            foreach($exts as $ext){
                if(!in_array($ext, array('jpg','jpeg','png','gif'))){
                    $this->errors[$fieldName] = 'L\'extension d\'un ou plusieurs fichier(s) n\'est pas valide.';
                }
            }
            // Validation de la taille des fichiers
            foreach($sizes as $size){
                // Limitation à 2Mo  (1ko = 1024 octets)
                if($size/1024/1024 > 2){
                    $this->errors[$fieldName] = 'Le fichier dépasse la taille autorisée.';
                }
            }
            return $this->errors;
        }
        return $this->errors; // Retournera un tableau ([]) vide s'il n'y a pas d'erreur

    }

    /**
     * Upload un fichier de type 'file' ($data) dans un dossier ($path), et le renomme s'il existe déjà, puis retourne le nom du fichier traité (renommé si besoin ou non)
     * Signature: $fileName = $filesManager->upload('picture', 'assets/uploads/img-main/');
     *
     * @param string|array $fieldName (nom du champs de type 'file' à uploader, tableau si c'est une collection d'images)
     * @param string $path (Chemin du dossier dans lequel on upload les fichiers)
     * @param integer $currentPostId (optionnel, id du post en cours utilisé lors de l'édition pour vérif si un fichier existe déjà pour le renommer)
     * @return $file (retourne le nom du fichier, ou pour une collection retourne les noms et size des fichiers)
     */
    public function upload($fieldName, string $path, int $currentPostId = null) // '$currentPostId' pour l'id du post en cours (null par défaut, utilisé lors de l'édition d'un post)
    {
        //dd($fieldName); // 'picture' ou 'image-collection', ou 'logo-collection

        // Données du fichier reçu
        $data = $this->data[$fieldName];
        // UPLOAD D'UNE IMAGE (image seule)
        // Si c'est une image seule (pour notre image principale) alors on upload le fichier
        if(is_string($data['name'])){

            $file = $data['name']; // vimeo.png
            //dd($file);

            $name = pathinfo($file, PATHINFO_FILENAME); // nom du fichier sans son extension (vimeo)
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION)); // extension du fichier (png)

            // Si l'image à uploader existe déjà dans la bdd ('exists()' retourne true si un fichier existe dans la bdd)
            if($this->postTable->exists($fieldName, $file)){ 
                // Condition si le param de 'upload()' est défini (c'est que nous sommes en Edition, donc on ajoute l'id du post actuel)
                if($currentPostId !== null){
                    // On renomme le fichier avec des parenthèses et l'id du post actuel (édition)
                    $newfile = $name .'('. $currentPostId . ')' . '.'. $ext; // ex : image(12).jpg
                    $file = $newfile;
                // Sinon si le param de "upload()" n'est pas défini (c'est que nous sommes en Création, donc on ajoute l'id du post qui va être créé)
                }else{
                    // On récup l'id du post qui va être créé (création)
                    $nextPostId = $this->postTable->getNextId();
                    // On renomme le fichier avec des parenthèses et l'id du post en cours de création (création)
                    $newfile = $name .'('. $nextPostId . ')' . '.'. $ext; // ex : image(12).jpg
                    $file = $newfile;
                }
            }

            // Chemin + nom du fichier (assets/uploads/img-main/monImage.jpg)
            $pathFile = $path . $file;

            if($file){
                // UPLOAD des images reçues (stockage et si modification de l'image du post, alors suppression de l'image dans le dossier)
                copy( // Copy le nom du fichier "ackechi.png" dans le dossier "img/persona" (copy(source, destination))
                    $data['tmp_name'], // d:\Code\xampp\tmp\phpF319.tmp (chemin du fichier enregistré en le dossier tmp du serveur, qui crypte le nom)
                    $pathFile // direction ou le fichier est envoyé
                );
            }

            // GESTION DE LA REDIMENSION DE L'IMAGE PRINCIPALE
            // Création de notre "resizer" (en param le chemin complet du fichier)
            $resizer = new ResizeImage($pathFile);
            // Redimension de l'image (crop = redimentionne en gardant les proportions mais pas le ration largeur/hauteur, voir classe ResizeImage)
            $resizer->resizeImage(1920, 1080, 'crop'); 
            // Sauve l'image redimensionnée à la place de celle d'origine
            $resizer->saveImage('assets/uploads/img-main/'.$file, 100); 

            return $file;
        }
        
        // UPLOAD D'UNE COLLECTION D'IMAGES
        // Si c'est une collection d'images (pour les images ou les logos) alors on upload les fichiers
        if(is_array($data['name'])){
            // Contiendra les données (nom et size des fichiers) après vérif si le nom du fichier exist
            $newData = []; 
            // Compte total des fichiers
            $countfiles = count($data['name']);

            // Boucle sur tous les fichiers
            for($i=0; $i<$countfiles; $i++){

                $file = $data['name'][$i];

                $name = pathinfo($file, PATHINFO_FILENAME); // nom du fichier sans son extension (vimeo)
                $ext  = strtolower(pathinfo($file, PATHINFO_EXTENSION)); // extension du fichier (png)
                $size = $data['size'][$i];

                // Si un nom de fichier (de la collection de logos OU de la collection d'images) existe déja dans la bdd alors... on renomme avec son id (image(12).jpg)
                if($this->logoTable->existsLogo($file) || $this->imageTable->existsImage($file)){
                    // Condition si le param 'currentPostId' de 'upload()' est défini (c'est que nous sommes en Edition, donc on ajoute l'id du post actuel)
                    if($currentPostId !== null){
                        // On renomme le fichier avec des parenthèses et l'id du post actuel (édition)
                        $newfile = $name .'('. $currentPostId . ')' . '.'. $ext; // ex : image(12).jpg
                        $file = $newfile;
                    // Sinon si le param 'currentPostId' de "upload()" n'est pas défini (c'est que nous sommes en Création, donc on ajoute l'id du post qui va être créé)
                    }else{
                        // On récup l'id du post qui va être créé
                        $nextPostId = $this->postTable->getNextId() - 1;
                        // On renomme le fichier avec des parenthèses et l'id du post
                        $newfile = $name .'('. $nextPostId . ')' . '.'. $ext; // ex : image(12).jpg
                        $file = $newfile;
                    }
                }

                // Chemin et nom du fichier (assets/uploads/img-collection/momFichier.jpg)
                $pathFile = $path . $file; 
                // Upload des fichiers (move_uploaded_file() permet de déplacer un fichier param1 = nom du fichier à déplacer, param2= direction)
                move_uploaded_file($data['tmp_name'][$i], $pathFile);
                // On rempli notre tableau '$newDate' avec le nom et taille des fichiers
                $newData['name'][$i] = $file; 
                $newData['size'][$i] = $size;

                // GESTION DE LA REDIMENSION DES COLLECTIONS D'IMAGES (Images et logos)
                // Si le champs est la collection d'images alors... RESIZE des images
                if($fieldName === "image-collection"){
                    // Création de notre "resizer" (en param le chemin complet du fichier)
                    $resizer = new ResizeImage($pathFile);
                    // Redimension de l'image (crop = redimentionne en gardant les proportions mais pas le ration largeur/hauteur, voir classe ResizeImage)
                    $resizer->resizeImage(640, 480, 'crop');
                    // Sauve l'image redimensionnée à la place de celle d'origine (param2 = qualité)
                    $resizer->saveImage('assets/uploads/img-collection/'.$file, 100);
                }
                /*
                // Si le champs est la collection de logos alors... RESIZE des logos
                if($fieldName === "logo-collection"){
                    // Création de notre "resizer" (en param le chemin complet du fichier)
                    $resizer = new ResizeImage($pathFile);
                    // Redimension de l'image (crop = redimentionne en gardant les proportions mais pas le ration largeur/hauteur, voir classe ResizeImage)
                    $resizer->resizeImage(128, 128, 'crop');
                    // Sauve l'image redimensionnée à la place de celle d'origine
                    $resizer->saveImage('assets/uploads/logo-collection/'.$file, 50);
                }
                */
            }
            return $newData; // Retourne le tableau avec les données traitées (le nom s'il a été renommé)
        }
        return false;
        
    }

    /**
     * Supprime un fichier du dossier
     * SIGNATURE: $filesManager->remove('monImage.jpg', 'assets/uploads/img-main/');
     *
     * @param string $fileName (nom du fichier)
     * @param string $path (chemin du fichier)
     * @return void
     */
    public static function remove(string $fileName, string $path): void
    {
        // 'file_exists()' vérifie si un fichier ou un dossier existe (param = Chemin vers le fichier ou le dossier)
        if(file_exists($path . $fileName)){
            unlink($path . $fileName); // 'unlink' efface un fichier (param = Chemin vers le fichier)
        }
    }




}