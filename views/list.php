<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/../controllers/AdvertController.php';

$title = "Liste des annonces";
$action = "Liste";

$ctrl = new AdvertController();
$list = $ctrl->getAll();

require_once __DIR__.'/helpers/header.php';
if($list):
    foreach ($list as $advert):
?>
        <article>
            <?php if (!empty($advert['reservation_message'])): ?>
            <p class="bg-warning">Ce bien a fait l'objet d'une réservation</p>
            <?php endif; ?>
            <a href="/views/read.php?id=<?= $advert['id'] ?>"><?= $advert['title'] ?></a>
            <p><?= $advert['city'].' '.$advert['postal_code'].' - '.$advert['price'] ?>&nbsp;€</p>
        </article>
<?php endforeach;
else: ?>
    <article>
        <p>Nous n'avons malheureusement aucune annonce à afficher</p>
    </article>
<?php
endif;
require_once __DIR__.'/helpers/footer.php';