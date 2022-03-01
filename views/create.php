<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/../controllers/AdvertController.php';
$title = "Ajouter une annonce";
$action = "Créer";

if(!empty($_POST)){
    if(!empty($_POST)){
        $ctrl = new AdvertController();
        $article = $ctrl->addAdvert();
        if(!$article){
            $err = $ctrl->getErrors();
        } else {
            $err['Validate'] = 'Votre annonce a bien été enregistrée';
        }
    }
}


require_once __DIR__.'/helpers/header.php';
?>
<?php if(!empty($err['Validate'])): ?>
<p class="h3"><?= $err['Validate'] ?></p>
<hr />
<?php endif; ?>

    <form method="POST" class="ms-5 me-2 my-5 pt-3 rounded half">
        <fieldset class="row ms-5">
            <legend>Le bien</legend>
            <div class="col-2"><label class="form-label" for="title">Titre</label></div>
            <div class="col-6"><input class="ms-2 form-control" type="text" name="title" id="title" /></div>
            <div class="col-12"><span class="ms-2 text-danger"><?= empty($err['title'])?'':$err['title'] ?></span></div>
            <div class="col-2"><label class="ms-2 form-label" for="description">Description</label></div>
            <div class="col-6"><input class="ms-2 form-control" type="text" name="description" id="description" /></div>
            <div class="col-12"><span class="ms-2 text-danger"><?= empty($err['description'])?'':$err['description'] ?></span></div>
        </fieldset>
        <fieldset class="row ms-5">
            <legend>Situation</legend>
            <div class="col-2"><label for="postal_code" class="ms-2 form-label">Code postal</label></div>
            <div class="col-3"><input type="text" class="form-control" id="postal_code" name="postal_code" /></div>
            <div class="col-12"><span class="ms-2 text-danger"><?= empty($err['postal_code'])?'':$err['postal_code'] ?></span></div>
            <div class="col-2"><label for="city" class="ms-2 form-label">Ville</label></div>
            <div class="col-6"><input type="text" class="form-control" id="city" name="city" /></div>
            <div class="col-12"><span class="ms-2 text-danger"><?= empty($err['city'])?'':$err['city'] ?></span></div>
        </fieldset>
        <fieldset class="row ms-5">
            <legend>Type de contrat</legend>
            <div class="col-5">
                <input type="radio" name="type" class="me-1" value="l" />Location
                <input type="radio" name="type" class="ms-2 me-1" value="v" />Vente
            </div>
            <div class="col-12"><span class="ms-2 text-danger"><?= empty($err['type'])?'':$err['type'] ?></span></div>
            <div class="col-2"><label for="price" class="mt-2 col-1 ms-2 form-label">Prix</label></div>
            <div class="col-3"><input type="number" min="0" max="9999999.99" step=".01" name="price" id="price" class="col-2 form-control" placeholder="999 €"/></div>
            <div class="col-12"><span class="ms-2 text-danger"><?= empty($err['price'])?'':$err['price'] ?></span></div>
        </fieldset>
        <fieldset class="ms-5 row">
            <div class="col-1 mb-3"><input type="submit" name="submit" value="Ajouter" class="btn btn-primary mt-3 ms-2"/></div>
        </fieldset>
    </form>
<?php
require_once __DIR__.'/helpers/footer.php';