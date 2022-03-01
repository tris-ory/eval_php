<?php
    if(empty($action)){
        $action = 'nawak';
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link href="/assets/css/styles.css" rel="stylesheet" />

    <title><?= empty($title)?'Document':$title ?></title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav nav-tabs me-auto mb-2 mb-lg-0">
                    <?php foreach ($pages as $label => $link): ?>
                        <li class="nav-item">
                            <a href="<?= $link ?>" <?= $label == $action ? 'aria-current="page" ' : '' ?>
                            class="text-secondary nav-link<?= $label == $action ? ' active-link':'' ?>"><?= $label ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main class="container-fluid">