<?php

declare(strict_types=1);
require_once '../vendor/autoload.php';

use Database\MyPdo;
use Css\AppWebPage;
use Entity\homeCollection;

$homePage = new AppWebPage('Film');
$requete = new homeCollection();
$tableau = $requete ->findAll();

foreach ($tableau  as $key => $value) {
    $l = $homePage->escapeString($value ->getTitle());
    $id = $value ->getId(); 
    $homePage->appendContent("<a href='http://localhost:8000/moviePage.php?nombre=$id '>$l</a><br>");
}

$date = $homePage ->getLastModification();
$homePage ->appendContent("<footer>$date</footer>");

echo $homePage->TOHTML();