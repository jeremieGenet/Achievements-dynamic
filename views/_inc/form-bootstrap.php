<!-- FORMULAIRE (via la classe Form.php) -->

<form action="">

    <div class="row">
        <div class="col-md-6 p-0">

            <?= $form->input('text', 'name', 'Nom & prénom', 'Entrer nom & prénom'); ?>
            <?= $form->input('email', 'email', 'Email', 'Entrer email'); ?>
            
        </div>
        <div class="col-md-6">
            <?= $form->input('tel', 'tel', 'Téléphone', 'Entrer votre téléphone'); ?>
            <?= $form->textarea('message', 'Message', 'Entrer votre message'); ?>
        </div>
        <button type="submit" class="btn btn-info">Me contacter</button>
    </div>

</form>