<?php
namespace App\Helpers;

/*
    Exemple utilisation :

    $resizer = new Resize('images/cars/large/input.jpg');
    $resizer->resizeImage(150, 100, 0);
    $resizer->saveImage('images/cars/large/output.jpg', 100);
*/

// Permet de redimentionner une image (à un chemin donné) et de la sauvegarder (à ce même chemin)
Class ResizeImage{

    private $image;
    private $width;
    private $height;
    private $imageResized;

    // param $fileName = chemin et nom du fichier (ex : assets/img/persona1.jpg)
    public function __construct(string $fileName){
        $this->image    = $this->openImage($fileName);
        $this->width    = imagesx($this->image);
        $this->height   = imagesy($this->image);
    }

    // Retourne le fichier sous forme de ressource ("gd") ou retourne une exception
    private function openImage($file){
        if (!is_file($file)){
            throw new \Exception("Le fichier '{$file}' n'existe pas!");
        }

        switch(pathinfo($file, PATHINFO_EXTENSION)){
            case 'JPG':
            case 'jpg': 
            case 'jpeg': return imagecreatefromjpeg($file); 
            case 'gif':	 return imagecreatefromgif($file);
            case 'PNG':
            case 'png':	 return imagecreatefrompng($file);
        }

        throw new \Exception("L'extension du fichier '{$file}' n'est pas autorisée!. Les extensions autorisées sont : jpg, jpeg, gif et png");
    }

    /**
     * Redimentionne une image
     *
     * @param [int] $newWidth
     * @param [int] $newHeight
     * @param string $option (portrait, landcape, crop, exact ou auto par défaut)
     * auto ou vide = redimentionne en gardant les proportions et le ratio largeur/hauteur
     * crop = redimentionne en gardant les proportions mais pas le ration largeur/hauteur
     * portrait = redimentionne en gardant les proportions et le ratio largeur/hauteur en fonction de la hauteur passée en param
     * landscape = redimentionne en gardant les proportions et le ratio largeur/hauteur en fonction de la lageur passée en param
     * exact = redimentionne sans garder les proportions
     * @return void
     */
    public function resizeImage(int $newWidth, int $newHeight, $option='auto'){
        list($width, $height) = $this->getDimensions($newWidth, $newHeight, $option);

        $this->imageResized = imagecreatetruecolor($width, $height);
        imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);

        if ($option == 'crop'){
            $this->crop($width, $height, $newWidth, $newHeight);
        }
    }

    /**
     * Sauvegarde la nouvelle image (dans une qualité à définir)
     *
     * @param [type] $savePath (Chemin + nom du fichier vers le dossier ou stocker l'image redimentionnée)
     * @param string $imageQuality 100 = qualité max, 0 = qualité mini (en dessous de 50 la qualité diminiue très peu)
     * @return void
     */
    public function saveImage($savePath, $imageQuality="100"){
        switch(pathinfo($savePath, PATHINFO_EXTENSION)){
            case 'jpg':
            case 'jpeg':
                if (imagetypes() & IMG_JPG){
                    imagejpeg($this->imageResized, $savePath, $imageQuality);
                }
            break;

            case 'gif':
                if (imagetypes() & IMG_GIF){
                    imagegif($this->imageResized, $savePath);
                }
            break;
            
            case 'png':
                if (imagetypes() & IMG_PNG){
                    // Echelle de qualité de 0-100 à 0-9
                    // Inverser le paramètre de qualité car 0 est le meilleur, pas 9
                    $invertScaleQuality = 9 - round(($imageQuality/100) * 9);
                    imagepng($this->imageResized, $savePath, $invertScaleQuality);
                }
            break;
        }

        imagedestroy($this->imageResized);
    }

    private function getDimensions($width, $height, $option){
        switch ($option){
            case 'portrait':    return array($this->getSizeByFixedHeight($height),  $height);
            case 'landscape':   return array($width, $this->getSizeByFixedWidth($width));
            case 'auto':        return $this->getSizeByAuto($width, $height);
            case 'crop':        return $this->getOptimalCrop($width, $height);
            case 'exact':		
            default:            return array($width, $height);
        }
    }

    private function getSizeByFixedHeight($height){
        return ($this->width / $this->height) * $height;
    }

    private function getSizeByFixedWidth($width){
        return ($this->height / $this->width) * $width;
    }

    private function getSizeByAuto($width, $height){
        if ($this->height < $this->width){
            return array($width, $this->getSizeByFixedWidth($width));
        }

        if ($this->height > $this->width){
            return array($this->getSizeByFixedHeight($height), $height);
        }

        if ($height < $width){
            return array($width, $this->getSizeByFixedWidth($width));
        }

        if ($height > $width){
            return array($this->getSizeByFixedHeight($height), $height);
        }

        return array($width, $height);
    }

    private function getOptimalCrop($width, $height){
        $ratio = min($this->height / $height, $this->width /  $width);
        return array(
            $this->width  / $ratio, 
            $this->height / $ratio
        );
    }

    private function crop($optimalWidth, $optimalHeight, $width, $height){
        $x = ( $optimalWidth  / 2) - ( $width  /2 );
        $y = ( $optimalHeight / 2) - ( $height /2 );

        $crop = $this->imageResized;

        $this->imageResized = imagecreatetruecolor($width , $height);
        imagecopyresampled($this->imageResized, $crop, 0, 0, $x, $y, $width, $height , $width, $height);
    }

    
}