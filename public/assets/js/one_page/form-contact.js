/*
    GESTION DU FORMULAIRE DE CONTACT de la page d'accueil one-page (Vérification des champs et affichage d'un message)
*/

// Création d'un message (utilisé lorsque la validation du formulaire est ok)
function toastMessage() {
 
    var myToast = document.querySelector('#myToast');
    var html = document.querySelector('html');

    // 
    var panel = document.createElement('div');
    panel.setAttribute('class', 'msgBox');
    myToast.appendChild(panel);

    var msg = document.createElement('p');
    msg.textContent = 'Le formulaire a bien été envoyé';
    panel.appendChild(msg);

    html.onclick = function() {
    panel.parentNode.removeChild(panel);
    }

}

// Fonction de désactivation de l'affichage des "tooltips" (qui affichent les bulle d'aide pour que l'utilisateur sache quoi entrer comme contenu)
function deactivateTooltips() {
    const tooltips = document.querySelectorAll('.__tooltip'),
        tooltipsLength = tooltips.length;

    for (let i = 0; i < tooltipsLength; i++) {
        tooltips[i].style.display = 'none'; // On cache les elements qui ont la class tooltip
    }
}
// La fonction ci-dessous permet de récupérer la "tooltip" qui correspond à un input
function getTooltip(elements) {
    while (elements = elements.nextSibling) {
        if (elements.className === '__tooltip') {
            return elements;
        }
    }
    return false;
}
// Notre fonction prend en argument l'<input> actuellement en cours de traitement. Notre boucle while se charge alors de vérifier tous les éléments suivants notre <input> (d'où l'utilisation du nextSibling). Une fois qu'un élément avec la classe .tooltip a été trouvé, il ne reste plus qu'à le retourner.



// Fonctions de vérification du formulaire, elles renvoient "true" si tout est ok
var check = {}; // On met toutes nos fonctions dans un objet littéral

// Vérification du champ 'name'
check['name'] = function(id) {

    const limitMin = 4;
    const limitMax = 40;
    const name = document.getElementById(id);
    const tooltipStyle = getTooltip(name).style;
    const tooltip = getTooltip(name);

    // Vérif si le champ est vide
    console.log(name.value);
    if (name.value === '') {
        tooltipStyle.display = 'flex';
        tooltip.innerText = 'Le Nom est obligatoire.'
        return false;
    }
    // Vérif si la taille du nom ne dépasse pas la limite
    if (name.value.length < limitMin) {
        tooltipStyle.display = 'flex';
        tooltip.innerText = 'Le Nom doit comporter au moins ' + limitMin + ' cararctères.'
        return false;
    }
    // Vérif si la taille du nom ne dépasse pas la limite
    if (name.value.length >= limitMax) {
        tooltipStyle.display = 'flex';
        tooltip.innerText = 'Le Nom doit comporter maximum ' + limitMax + ' cararctères.'
        return false;
    }
    name.className = 'correct';
    tooltipStyle.display = 'none';

    return true;
};
// Vérification du champ 'email'
check['email'] = function(id) {

    const name = document.getElementById(id);
    const tooltipStyle = getTooltip(name).style;
    const tooltip = getTooltip(name);

    // Vérif si le champ est vide
    console.log(name.value);
    if (name.value === '') {
        tooltipStyle.display = 'flex';
        tooltip.innerText = 'L\'adresse Email est obligatoire.'
        return false;
    }
    // Vérif du format de l'adresse email (regex contrôlée avec la fonction 'exec()' qui retourne null si la correspondance est fausse)
    const verifEmail = /^([a-zA-Z0-9_-])+([.]?[a-zA-Z0-9_-]{1,})*@([a-zA-Z0-9_-]{2,}[.])+[a-zA-Z]{2,3}$/
    if(verifEmail.exec(name.value) === null){
        tooltipStyle.display = 'flex';
        tooltip.innerText = 'L\'adresse email est invalide.';
        return false;
    }
    
    name.className = 'correct';
    tooltipStyle.display = 'none';
    
    return true;
};
// Vérification du champ 'subject'
check['subject'] = function(id) {

    const limitMin = 4;
    const limitMax = 60;
    const name = document.getElementById(id);
    const tooltipStyle = getTooltip(name).style;
    const tooltip = getTooltip(name);


    // Vérif si le champ est vide
    console.log(name.value);
    if (name.value === '') {
        tooltipStyle.display = 'flex';
        tooltip.innerText = 'L\'objet est obligatoire.'
        return false;
    }
    // Vérif si la taille du nom ne dépasse pas la limite
    if (name.value.length < limitMin) {
        tooltipStyle.display = 'flex';
        tooltip.innerText = 'L\'objet doit comporter au moins ' + limitMin + ' cararctères.'
        return false;
    }
    // Vérif si la taille du nom ne dépasse pas la limite
    if (name.value.length >= limitMax) {
        tooltipStyle.display = 'flex';
        tooltip.innerText = 'L\'objet doit comporter maximum ' + limitMax + ' cararctères.'
        return false;
    }
    name.className = 'correct';
    tooltipStyle.display = 'none';

    return true;
};
// Vérification du champ 'message'
check['message'] = function(id) {

    const limitMin = 10;
    const limitMax = 3000;
    const name = document.getElementById(id);
    const tooltipStyle = getTooltip(name).style;
    const tooltip = getTooltip(name);


    // Vérif si le champ est vide
    console.log(name.value);
    if (name.value === '') {
        tooltipStyle.display = 'flex';
        tooltip.innerText = 'Le message est obligatoire.'
        return false;
    }
    // Vérif si la taille du nom ne dépasse pas la limite
    if (name.value.length < limitMin) {
        tooltipStyle.display = 'flex';
        tooltip.innerText = 'Le message doit comporter au moins ' + limitMin + ' cararctères.'
        return false;
    }
    // Vérif si la taille du nom ne dépasse pas la limite
    if (name.value.length >= limitMax) {
        tooltipStyle.display = 'flex';
        tooltip.innerText = 'Le message doit comporter au maximum ' + limitMax + ' cararctères.'
        return false;
    }
    name.className = 'correct';
    tooltipStyle.display = 'none';

    return true;
};

// Mise en place des événements

(function() { // Utilisation d'une IIFE pour éviter les variables globales.

    const myForm = document.getElementById('myForm');
    const inputs = document.querySelectorAll('input[type=text], input[type=password], textarea');
    const inputsLength = inputs.length;

    for (let i = 0; i < inputsLength; i++) {
        inputs[i].addEventListener('keyup', function(e) { // keyup focusout
            check[e.target.id](e.target.id); // "e.target" représente l'input actuellement modifié
            //console.log(check[e.target.id](e.target.id))
        });
    }

    myForm.addEventListener('submit', function(e) {

        let result = true;

        //console.log(check);
        for (let i in check) {
            result = check[i](i) && result;
            
        }
        //console.log(result);
        // Si les vérifications des champs renvoi 'true' (result = true) alors...
        if (result) {
            
            console.log('Go vers le traitement des données en back')
            //alert('Le formulaire est bien rempli.');
            toastMessage();
            
        // Sinon 
        }else{
            e.preventDefault(); // On empêche l'envoi du formulaire
        }

    });

    myForm.addEventListener('reset', function() {

        for (let i = 0; i < inputsLength; i++) {
            inputs[i].className = '';
        }

        deactivateTooltips();

    });

})();

// Maintenant que tout est initialisé, on peut désactiver les "tooltips"
deactivateTooltips();


