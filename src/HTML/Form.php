<?php
namespace App\HTML;

// Génére les champs d'un formulaire
class Form{

    private $data;
    private $errors;

    // Signature : $form = new Form($post, $errors);
    public function __construct($data, ?array $errors) // '?array' = array ou null (typage)
    {
        $this->data = $data;
        $this->errors = $errors; // Erreurs de validation sous forme de tableau
    }

    /**
     * Création d'un label + input (HTML dynamique) de formulaire
     * Signature : $form->input('text', 'name', 'Nom', 'Entrez votre nom');
     *
     * @param string $type (représente le type du champ input (text, email...))
     * @param string $name (représente le nom du champ input, mais aussi l'id. Représente aussi l'attribut 'for' de label)
     * @param string $label (représente le nom du label)
     * @return string (retourne un input + label de formulaire)
     */ 
    public function input(string $type, string $name, string $label, string $placeholder=""): string
    {
        // TODO : Ajouter l'attribut "required" au champs input

        $value = $this->getValue($name); // $value représente la valeur postée dans l'input du formulaire
        return <<<HTML
        <div class="form-group">
            <label for="field{$name}">{$label}</label>
            <input type="{$type}" id="field{$name}" class="{$this->getInputClass($name)}" name="{$name}" value="{$value}" placeholder="{$placeholder}">
            <!-- Affichage de l'erreur dans une div class="invalid-feedback"-->
            {$this->getErrorFeedback($name)} 
        </div>
HTML;
    }

    
    // Input type password (confirmation)
    public function inputPasswordConfirm(string $name, string $label): string
    {
        // TODO : Ajouter l'attribut "required" au champs input

        //$value = $this->getValue($name); // $value représente la valeur postée dans l'input du formulaire
        return <<<HTML
        <div class="form-group">
            <label for="field{$name}">{$label}</label>
            <input type="password" id="field{$name}" class="{$this->getInputClass($name)}" name="{$name}">
            <!-- Affichage de l'erreur dans une div class="invalid-feedback"-->
            {$this->getErrorFeedback($name)} 
        </div>
HTML;
    }

    // INPUTS CHECK-BOX (pour les catégories) Retournera les id des catégories à la validation du formulaire: [0 => "1", 1 => "2", ...] 
    public function inputCheckBox(int $id, string $category, string $name, string $checked=""): string
    {
        return <<<HTML
            <input class="{$this->getCheckBoxClass($name)}"  type="checkbox" name='category[]' value="{$id}" id="{$id} {$category}"  $checked >
            <label class="form-check-label mr-5" for="{$id} {$category}">
                {$category}
            </label>
HTML;
    }
        

    // Input pour un champ de type file (images)
    public function inputFile(string $name, string $label, string $helpMessage=""): string
    {
        // TODO : Ajouter l'attribut "required" au champs input
        
        $value = $this->getValue($name); // $value représente la valeur postée dans l'input du formulaire

        return <<<HTML
        <div class="form-group">
            <label for="field{$name}">{$label}</label>
            <input type="file" id="field{$name}" class="{$this->getInputClass($name,'-file')}" name="{$name}" value="{$value}" aria-describedby="fileHelp{$name}">
            <small id="fileHelp{$name}" class="form-text text-muted">{$helpMessage}</small>
            <!-- Affichage de l'erreur dans une div class="invalid-feedback"-->
            {$this->getErrorFeedback($name)} 
        </div>
HTML;
    }

    /**
     * Création d'un champs textarea de formulaire
     * Signature : $form->textarea('content', 'Contenu');
     *
     * @param string $name (représente le nom du champ input, mais aussi l'id. Représente aussi l'attribut 'for' de label)
     * @param string $label (représente le nom du label)
     * @return string (retourne un input + label de formulaire)
     */ 
    public function textarea(string $name, string $label,  string $placeholder=""): string
    {
        $value = $this->getValue($name); // $value représente la valeur entrée dans textarea
        
        return <<<HTML
        <div class="form-group">
            <label for="field{$name}">{$label}</label>                                              <!-- "$value" représente la valeur entrée dans textarea -->
            <textarea type="text" id="field{$name}" class="{$this->getInputClass($name)}" name="{$name}"  placeholder="{$placeholder}">{$value}</textarea>
            <!-- Affichage de l'erreur dans une div -->
            {$this->getErrorFeedback($name)} 
        </div>    
HTML;
    }


    // Traite les données reçues (type et format) de l'attribut "value" d'un input/textarea, et renvoie la valeur 
    private function getValue(string $name)
    {
        //dd($this->data);
        // Si les données reçues à l'instanciation de la class Form sont de type tableau alors on en retourne la valeur sinon...
        // (Si l'instanciation est sous la forme d'un tableau, exemple : "$form = new Form(['name' = 'Contenu de la donnée'], $errors);" alors...)

        if(is_array($this->data)){
            return $this->data[$name] ?? null; // On Retourne la valeur donnée dans le tableau ou null
            //dd($this->data[$name]); // Affiche "Contenu de la donnée" si l'instanciation a cette signature : "$form = new Form(['name' = 'Contenu de la donnée'], $errors)

        // Sinon ... (on considère ici qu'il s'agit d'un objet et on paramètre le retour pour qu'il puisse recevoir les méthodes des objets)
        }else{
            // "$method" va stocker le nom de la méthode utilisée (ex : getName() ou getSlug() ... )
            $method = 'get' . ucfirst($name); // ucfirst() permet de mettre la 1ere lettre d'une chaîne de caractère en majuscule
            //dd($method); // Affiche le nom de la méthode utilisée
            //dd($this->data);
            $value = $this->data->$method(); // Revient à écrire par exemple : $value = $this->post->getName() pour l'input "nom" du formulaire de modif d'un post
            // Si la donnée reçue est de type DateTime... (condition utile lors de la création d'un input de type date)
            if($value instanceof \DateTimeInterface){
                return $value->format('Y-m-d H:i:s'); // On formate au format date de MySQL (celui de notre bdd)
            }
            //dd($value); // null
            return $value;
        }
    }

    // Permet de générer la classe bootstrap d'un input en fonction de son nom (utilisé dans la création d'un input)
    // Signature sur input type file : class="{$this->getInputClass($name,'-file')}"   (class="form-control-file is-invalid")
    // Signature sur input text : class="{$this->getInputClass($name)}"   (class="form-control is-invalid")
    private function getInputClass(string $name, ?string $addFile = ""): string
    {
        $inputClass = 'form-control' . $addFile;
        // Si il y a une erreur de validation alors...
        if(isset($this->errors[$name])){
            $inputClass .= ' is-invalid'; // On ajoute à notre input la classe ' is-invalid' pour afficher l'erreur
            //$invalidFeedback = '<div class="invalid-feedback">' . implode('<br>', $this->errors[$name]) . '</div>'; // On affiche le détail de l'erreur
        }
        return $inputClass;
    }

    private function getCheckBoxClass(string $name, ?string $addFile = ""): string
    {
        $inputClass = 'form-check-input' . $addFile;
        // Si il y a une erreur de validation alors...
        //dd($this->errors[$name]);
        if(isset($this->errors[$name])){
            $inputClass .= ' is-invalid'; // On ajoute à notre input la classe ' is-invalid' pour afficher l'erreur
            //$invalidFeedback = '<div class="invalid-feedback">' . implode('<br>', $this->errors[$name]) . '</div>'; // On affiche le détail de l'erreur
        }
        return $inputClass;
    }

    // Permet de générer l'affichage des erreurs (sous le champ,) (utilisé dans la création d'un textarea)
    private function getErrorFeedback($name)
    {
        // Si il y a une erreur de validation alors...
        if(isset($this->errors[$name])){
            // Si les erreurs sont sous forme de tableau
            if(is_array($this->errors[$name])){
                $error = implode('<br>', $this->errors[$name]); // Affichage des erreurs avec un saut de ligne (<br>)
            }else{
                $error = $this->errors[$name]; // Affichage simple de l'erreur
            }
            //dd($name, $this->errors[$name]); //retourne : "name"   "Le champ 'name' ne doit pas être vide"
            return '<div class="invalid-feedback">' . $error . '</div>'; // On affiche le détail de l'erreur
        }
        return ''; // Sinon on retourne un chaine vide
    }

}