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
    $homePage->appendContent("<div class='movie-items'><a href='http://localhost:8000/moviePage.php?nombre=$id'>$l</a></div>");
}

$homePage->appendContent("</div>");
$date = $homePage ->getLastModification();
$homePage ->appendContent("<footer>$date</footer>");

$css = "
body {
  display: flex;
  flex-direction: column;
  justify-content: stretch;
  gap: 0.5em 2em;
  background-color: black;
  color:white;
}

.movie {
    display: flex;
    flex-flow: row wrap;
    justify-content: space-between;
    align-content: space-around;
    border: 1px solid white;
    padding: 10px;
    gap: 1em;
}

.movie-items {
    display: flex;
    align-items: center;
    width: 6em;
    flex-shrink: 0;
    border: 1px solid white;
    padding: 10px;
}

header {
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid white;
    padding: 10px;
    margin-bottom: 20px;
    color: red;
}

footer {
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid white;
    padding: 10px;
    

}
";
$homePage -> appendCss($css);


echo $homePage->TOHTML();