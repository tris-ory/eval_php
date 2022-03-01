<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/../controllers/AdvertController.php';
// If no id, this page return to index
if(empty($_GET['id'])){
    header('Location: /index.php');
}
$id = $_GET['id'];
$ctrl = new AdvertController();
if(!empty($_POST['reservation_message'])){
    // $ctrl->reserveAdvert return true if ok, so error flag negate this result
    $err = !$ctrl->reserveAdvert($id, $_POST['reservation_message']);
}
$advert = $ctrl->getById($id);
$title = 'Annonce - '.$advert['title'];
require_once __DIR__.'/helpers/header.php';
?>
<article class="px-2">
<?php if($advert): ?>
    <?php if (!empty($advert['reservation_message'])): ?>
        <p class="bg-warning">Ce bien a fait l'objet d'une réservation</p>
    <?php endif; ?>
    <h2><?= $advert['title'] ?></h2>
    <p><em class="text-secondary"><?= $advert['city'].' - '.$advert['postal_code'] ?></em></p>
    <p>Prix&nbsp;: <?= $advert['price'] ?>&nbsp;€</p>
    <p><?= strtoupper($advert['type']) === 'L' ? 'Location' : 'Vente' ?></p>
    <p><?= $advert['description'] ?></p>
    <?php if(empty($advert['reservation_message'])): ?>
    <form method="POST">
        <fieldset>
            <legend>Pour réserver, entrez votre message</legend>
            <textarea name="reservation_message" id="reservation_message" class="form-control"></textarea>
            <?php if($err): ?>
            <p class="text-danger my-2">Veuillez entrer votre message avant de valider.</p>
            <?php endif; ?>
            <input type="submit" value="Je réserve" class="btn btn-primary my-2" />
        </fieldset>
    </form>
    <?php else: ?>
    <h3>Message de réservation : </h3>
    <p><?= $advert['reservation_message'] ?></p>
    <?php endif; ?>
<?php else: ?>
    <h2>Bien introuvable</h2>
    <p>Nous sommes au regret de ne pas pouvoir afficher l'annonce que vous nous avez demandé.</p>
<?php endif; ?>
</article>
<?php
require_once __DIR__.'/helpers/footer.php';
