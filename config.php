<?php
// PDO configuration
define('DB_TYPE','mysql');
define('DB_HOST','localhost');
define('DB_PORT',3306);
define('DB_BASE', 'wf3_php_intermediaire_tristan');
define('DB_CHARSET','utf8');
define('DB_USER','root');
define('DB_PASS','');

// For the navbar
$pages=['Index' => '/index.php',
    'Créer' => '/views/create.php',
    'Liste' => '/views/list.php'];