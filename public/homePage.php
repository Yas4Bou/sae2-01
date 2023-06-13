<?php

declare(strict_types=1);
require_once '../vendor/autoload.php';

use Database\MyPdo;
use Html\WebPage;
use Entity\homeCollection;

$homePage = new WebPage();
$homePage ->setTitle("Films");
$homePage ->appendContent("<header><h1>Films</h1></header>");
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