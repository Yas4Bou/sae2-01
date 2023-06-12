<?php

declare(strict_types=1);
require_once '../vendor/autoload.php';

use Database\MyPdo;
use Html\WebPage;

$homePage = new WebPage();
$homePage ->setTitle("Films");
$homePage ->appendContent("<h1>Films</h1>");
$requete = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT title
    FROM movie
    ORDER BY title; 
SQL
);

$requete->execute();

while (($ligne = $requete->fetch()) !== false) {
    $l = $homePage->escapeString($ligne['title']);
    $homePage->appendContent("$l\n<br>");
}

echo $homePage->TOHTML();
