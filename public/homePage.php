<?php

declare(strict_types=1);
require_once '../vendor/autoload.php';

use Css\AppWebPage;
use Entity\homeCollection;

$homePage = new AppWebPage('Film');
$requete = new homeCollection();
$tableau = $requete ->findAll();

$homePage->appendContent("<div class='movie'>");

foreach ($tableau  as $key => $value) {
    $l = $homePage->escapeString($value ->getTitle());
    $id = $value ->getId();
    $posterId = $value->getPosterId();
    $homePage->appendContent("<div class='movie-items'><a href='http://localhost:8000/moviePage.php?nombre=$id'><img src= 'image.php?imageID=$posterId' width='100px' height='150px'> <br>$l</a></div>");
}

$homePage->appendContent("</div>");
$date = $homePage ->getLastModification();
$homePage ->appendContent("<footer>$date</footer>");

$homePage->appendCssUrl("css/HomeCss.css");


echo $homePage->TOHTML();