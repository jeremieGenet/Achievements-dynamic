<!-- BASE DU FORMULAIRE DE CALENDRIER (inclu dans les formulaire de création et modification d'évènement) -->
<!-- 2 Variables utilisées dans cette base de formulaire : $data (donnée des champs) et $errors -->

<!-- CHAMPS TITRE ET DATE DU FORMULAIRE -->
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Titre de l'évènement</label>
            <input id="name" type="text" class="form-control" name="name" value="<?= isset($data['name']) ? ($data['name']) : '' ?>" required>
            <!-- Affichage de l'erreur du champ -->
            <?php if(isset($errors['name'])): ?>
                <small class="text-muted"><?= $errors['name'] ?></small>
            <?php endif; ?>

        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="date">Date</label>

            <?php
            //dd($todaysDay, $dayEvent);
            //dd($dateEvent);
            ?>

            <input id="date" type="date" class="form-control" name="date" value="<?= isset($dayEvent) ? $dayEvent : $data['date'] ?>" required>
            <!-- Affichage de l'erreur du champ -->
            <?php if(isset($errors['date'])): ?>
                <small class="text-muted"><?= $errors['date'] ?></small>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- CHAMPS DEBUT ET FIN DU FORMULAIRE -->
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="start">Début</label>
            <input id="start" type="time" class="form-control" name="start" placeholder="HH:MM" value="<?= isset($data['start']) ? ($data['start']) : '' ?>" required>
            <!-- Affichage de l'erreur du champ -->
            <?php if(isset($errors['start'])): ?>
                <small class="text-muted"><?= $errors['start'] ?></small>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="end">Fin</label>
            <input id="end" type="time" class="form-control" name="end" placeholder="HH:MM" value="<?= isset($data['end']) ? ($data['end']) : '' ?>" required>
            
        </div>
    </div>
</div>

<!-- CHAMP DESCRIPTION DU FORMULAIRE -->
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control"><?= isset($data['description']) ? ($data['description']) : '' ?></textarea>
</div>