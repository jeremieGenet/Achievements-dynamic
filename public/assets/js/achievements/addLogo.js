const buttonAdd = document.getElementById('add_logo'); // Récup du bouton 'Ajouter un logo'
    const divLogos = document.getElementById('divLogos'); // Récup de la div qui contient les logos

    let IDnb = 0; // permet la création d'id pour les éléments à créer

    // EVENT lors du click du botton 'Ajouter un logo'
    buttonAdd.addEventListener("click", function (e) {

        IDnb++;

        // Création d'une div qui va contenir chaque nouveau logo créé (c'est cette div qui est supprimée lorsqu'on click sur le bouton rouge)
        const divFormLogo = document.createElement('div');
            divFormLogo.id = 'logo_' + IDnb;
            divFormLogo.className = "divFormLogo";
        divLogos.insertBefore(divFormLogo, buttonAdd);
        
        // Création de l'input type "file" et de son bouton de suppression
        const input = document.createElement("input");
            input.id = 'input_logo_' + IDnb;
            input.type = 'file';
            input.className = 'form-control-file'
            input.name = 'logo_'+ IDnb; ///////////////////////// NOM DE L'INPUT (qui permet de récup les infos postées) ////////////////////////
        const buttonRemove = document.createElement("button");
            buttonRemove.id = 'remove_logo_' + IDnb;
            buttonRemove.className = "btn btn-danger float-right";
            buttonRemove.textContent = 'X';
            buttonRemove.type = "button";
            buttonRemove.name = "remove_logo"
        divFormLogo.appendChild(input);
        divFormLogo.appendChild(buttonRemove);

        //console.log('IDnb = ' + IDnb);

        
        // BOUCLE SUR TOUT LES BOUTONS NAME 'remove_logo'
        let buttons = document.getElementsByName('remove_logo');
            console.log(buttons);
            //console.log('alors?');
            //console.log(buttons.length + 1); /********************************** NB DE BOUTTON A SUPPRIMER + 1 (celui de départ) ***************************************** */

            nbDivsLogo = document.getElementsByClassName('divFormLogo').length;
            console.log('nombre de div divFormLogo = ' + nbDivsLogo);
            //console.log(IDnb, 'id avant suppression');
            // EVENT lors du click pour supprimer la div qui contient le bouton supprimer
            buttons.forEach(function(button){
                console.log('alors::!!!!');
                button.addEventListener('click', function (e){
                    console.log('alors::!!!!');
                    console.log(button);
                    //IDnb - 1;
                    nbDivsLogo = document.getElementsByClassName('divFormLogo').length;
                    console.log('nombre de div divFormLogo = ' + nbDivsLogo);
                    console.log(button.id);
                    
                    let buttonAsupprimer = button.id.substr(7);
                    //console.log(typeof buttonAsupprimer);

                    divAsupprimer = document.getElementById(buttonAsupprimer); // Récup de la div à supprimée (correspond à l'id du bouton sans le 'remove_' de son id)

                
                    divLogos.removeChild(divAsupprimer);
                })
            })
        
    });
    

    


/************************************************************************************************************************************** */
    // SUPPRESSION DU CONTENU (value) DE L'INPUT DU PREMIER LOGO (id = input_logo_0)
    // Création d'un bouton de suppression du 1er Logo
    var inputMaster = document.getElementById('input_logo_0'); // input dans lequel on veut supprimer la valeur
    const fileHelp = document.getElementById('fileHelpLogo');

    const buttonRemoveMaster = document.createElement("button");
        buttonRemoveMaster.id = 'remove_logo_0';
        buttonRemoveMaster.className = "btn btn-danger float-right";
        buttonRemoveMaster.textContent = 'X';
        buttonRemoveMaster.type = "button";
        buttonRemoveMaster.name = "remove_logo_0"
    divLogos.insertBefore(buttonRemoveMaster, fileHelp);

    // EVENT sur le bouton de suppression du 1er Logo
    buttonRemoveMaster.addEventListener("click", function (e) {
        inputMaster = document.getElementById('input_logo_0'); // input dans lequel on veut supprimer la valeur
        //console.log(inputMaster.value);
        // Si il y a une value, on la supprimer ("")
        if(inputMaster.value){
            inputMaster.value = "";
        }
    });