<?php

declare(strict_types=1);
require_once '../vendor/autoload.php';

use Database\MyPdo;
use Html\WebPage;

$homePage = new WebPage();
$homePage ->setTitle("Films");
$homePage ->appendContent("<header><h1>Films</h1></header>");
$requete = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT id, title
    FROM movie
    ORDER BY title; 
SQL
);

$requete->execute();

while (($ligne = $requete->fetch()) !== false) {
    $l = $homePage->escapeString($ligne['title']);
    $homePage->appendContent("<a href='http://localhost:8000/moviePage.php?nombre=$ligne[id]'>$l<br>");
}

$date = $homePage ->getLastModification();
$homePage ->appendContent("<footer>$date</footer>");

echo $homePage->TOHTML();