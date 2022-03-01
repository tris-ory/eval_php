<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/controllers/AdvertController.php';

$title = 'Index';
$action = 'Index';

$ctrl = new AdvertController();
$articles = $ctrl->getNLastMessages(15);
require_once __DIR__.'/views/helpers/header.php';
if($articles):
    foreach($articles as $article):
?>
<article>
    <h2><?= strtoupper($article['title']) ?></h2>
    <p><?= $article['city'].' '.$article['postal_code'].' - '.$article['price'] ?>&nbsp;€</p>
</article>
<?php endforeach;
else: ?>
<article>
    <p>Nous n'avons malheureusement aucune annonce à afficher</p>
</article>
<?php
endif;
require_once __DIR__.'/views/helpers/footer.php';
